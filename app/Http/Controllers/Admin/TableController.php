<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Table\StoreTableRequest;
use App\Http\Requests\Table\UpdateTableRequest;
use App\Models\Table;
use App\Models\Restaurant;
use App\Models\Place;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Throwable;

class TableController extends Controller
{
    protected CloudinaryService $cloudinaryService;
    protected SlugService $slugService;
    protected RankService $rankService;
    protected QrCodeService $qrCodeService;

    public function __construct(
        CloudinaryService $cloudinaryService, 
        SlugService $slugService,
        RankService $rankService,
        QrCodeService $qrCodeService
    ) {
        $this->cloudinaryService = $cloudinaryService;
        $this->slugService = $slugService;
        $this->rankService = $rankService;
        $this->qrCodeService = $qrCodeService;
    }
    public function index(Request $request)
    {
        $query = Table::with(['restaurant.translations', 'place.translations']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                // Search in table translations
                $q->whereHas('translations', function ($subQ) use ($search) {
                    $subQ->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('description', 'LIKE', "%{$search}%");
                })
                // Search in restaurant translations
                ->orWhereHas('restaurant.translations', function ($subQ) use ($search) {
                    $subQ->where('name', 'LIKE', "%{$search}%");
                })
                // Search in place translations
                ->orWhereHas('place.translations', function ($subQ) use ($search) {
                    $subQ->where('name', 'LIKE', "%{$search}%");
                })
                // Search by capacity/seats
                ->orWhere('seats', 'LIKE', "%{$search}%")
                ->orWhere('capacity', 'LIKE', "%{$search}%");
            });
        }

        $tables = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.restaurants.tables.index', compact('tables'));
    }

    public function show(Table $table)
    {
        $table->load(['restaurant', 'place', 'createdBy.roles', 'updatedBy.roles', 'reservationSlots']);
        return view('admin.restaurants.tables.show', compact('table'));
    }

    public function create(Request $request)
    {
        $restaurants = Restaurant::with('translations')->get();
        $places = collect();
        
        Log::info('Table create page loaded:', [
            'restaurant_count' => $restaurants->count(),
            'query_params' => $request->all()
        ]);
        
        // If restaurant_id is provided in query, preselect and load places
        $selectedRestaurant = null;
        if ($request->has('restaurant_id')) {
            $selectedRestaurant = $request->restaurant_id;
            $places = Place::where('restaurant_id', $selectedRestaurant)
                          ->with('translations')
                          ->get();
        }
        
        return view('admin.restaurants.tables.create', compact('restaurants', 'places', 'selectedRestaurant'));
    }

    public function store(StoreTableRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validatedData();

            // Auto-assign rank if not provided
            $data = $this->rankService->assignRankIfEmpty($data, Table::class);

            // Set created_by field
            $data['created_by'] = Auth::id();

            // Generate slug from default locale
            $defaultLocale = config('app.locale');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
            $data['slug'] = $this->slugService->generate(new Table(), $slugName);

            // Handle image upload
            Log::info('TableController: Checking for image upload', [
                'has_image_file' => request()->hasFile('image_file'),
                'image_type' => request('image_type'),
                'files' => request()->allFiles()
            ]);
            
            if (request()->hasFile('image_file')) {
                Log::info('TableController: Processing image upload');
                try {
                    $data['image_link'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/tables');
                    Log::info('TableController: Image uploaded successfully', ['image_link' => $data['image_link']]);
                } catch (\Exception $e) {
                    Log::error('TableController: Image upload failed', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw $e;
                }
            } else {
                Log::info('TableController: No image file uploaded');
            }

            // Extract translations and remove from main data
            $translations = $data['translations'] ?? [];
            unset($data['translations']);

            // Create table without translations first
            $table = Table::create($data);

            // Now manually add only the translations that have non-empty names
            foreach ($translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $table->translateOrNew($locale)->fill($translation);
                }
            }
            
            // Save the translations
            $table->save();

            // Generate QR code after table is created and saved
            try {
                // Get restaurant and place to access their slugs
                $restaurant = $table->restaurant;
                $place = $table->place;
                $tableName = $table->translations->first()->name ?? 'Table';
                
                $qrData = $this->qrCodeService->generateForTable(
                    $table->id,
                    $tableName,
                    $restaurant->slug,
                    $place ? $place->slug : null,
                    $table->slug
                );

                // Update table with QR code data
                $table->update([
                    'qr_code_image' => $qrData['qr_code_image'],
                    'qr_code_link' => $qrData['qr_code_link']
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to generate QR code for table: ' . $e->getMessage());
            }

            DB::commit();

            // Check if table belongs to a specific place and redirect accordingly
            if ($table->place_id && $table->restaurant_id) {
                return redirect()
                    ->route('admin.restaurants.places.tables.index', [$table->restaurant_id, $table->place_id])
                    ->with('success', 'მაგიდა წარმატებით შეიქმნა.');
            }

            return redirect()->route('admin.tables.index')
                           ->with('success', 'მაგიდა წარმატებით შეიქმნა.');
        } catch (Throwable $e) {
            DB::rollBack();
            
            Log::error('Table creation error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // If error occurs, return to create form with data
            $restaurants = Restaurant::with('translations')->get();
            $places = collect();
            $selectedRestaurant = request('restaurant_id');
            
            if ($selectedRestaurant) {
                $places = Place::where('restaurant_id', $selectedRestaurant)
                              ->with('translations')
                              ->get();
            }
            
            return back()->withInput()
                        ->withErrors(['error' => 'მაგიდის შექმნა ვერ მოხერხდა: ' . $e->getMessage()]);
        }
    }

    public function edit(Table $table)
    {
        $table->load(['createdBy', 'updatedBy']);
        $restaurants = Restaurant::with('translations')->get();
        $places = Place::where('restaurant_id', $table->restaurant_id)
                      ->with('translations')
                      ->get();
        
        return view('admin.restaurants.tables.edit', compact('table', 'restaurants', 'places'));
    }

    public function update(UpdateTableRequest $request, Table $table)
    {
        try {
            DB::beginTransaction();

            // Debug: Log original request first
            Log::info('Table update - original request:', request()->all());
            
            $data = $request->validatedData();
            
            // Debug: Log processed data
            Log::info('Table update - validated data:', $data);

            // Generate new slug
            $defaultLocale = config('app.locale');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
            $data['slug'] = $this->slugService->generateForUpdate($table, $slugName, $table->id);

            // Set updated_by field
            $data['updated_by'] = Auth::id();

            // Handle image upload/deletion
            Log::info('TableController: Checking for image upload in update', [
                'has_image_file' => request()->hasFile('image_file'),
                'image_type' => request('image_type'),
                'files' => request()->allFiles()
            ]);
            
            if (request()->hasFile('image_file')) {
                Log::info('TableController: Processing image upload in update');
                try {
                    // Delete old image if exists
                    if ($table->image_link) {
                        $this->cloudinaryService->deleteImageFromUrl($table->image_link, 'foodly/tables');
                    }
                    // Upload new image
                    $data['image_link'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/tables');
                    Log::info('TableController: Image updated successfully', ['image_link' => $data['image_link']]);
                } catch (\Exception $e) {
                    Log::error('TableController: Image upload failed in update', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw $e;
                }
            } elseif (!empty($data['image_link']) && $data['image_link'] !== $table->image_link) {
                Log::info('TableController: Switching to external link, deleting old Cloudinary image');
                // Delete old Cloudinary image if switching to external link
                if ($table->image_link) {
                    $this->cloudinaryService->deleteImageFromUrl($table->image_link, 'foodly/tables');
                }
            } else {
                Log::info('TableController: No image changes in update');
            }

            // Extract translations and remove from main data
            $translations = $data['translations'] ?? [];
            unset($data['translations']);

            // Update table without translations first
            $table->update($data);

            // Clear existing translations that are not in the new data
            $table->translations()->delete();

            // Now manually add only the translations that have non-empty names
            foreach ($translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $table->translateOrNew($locale)->fill($translation);
                }
            }
            
            // Save the translations
            $table->save();

            // Regenerate QR code if slug or name changed
            try {
                $restaurant = $table->restaurant;
                $place = $table->place;
                $tableName = $table->translations->first()->name ?? 'Table';
                
                $qrData = $this->qrCodeService->regenerateForTable(
                    $table->id,
                    $tableName,
                    $restaurant->slug,
                    $place ? $place->slug : null,
                    $table->slug,
                    $table->qr_code_image
                );

                // Update table with new QR code data
                $table->update([
                    'qr_code_image' => $qrData['qr_code_image'],
                    'qr_code_link' => $qrData['qr_code_link']
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to regenerate QR code for table: ' . $e->getMessage());
            }

            DB::commit();

            // Check if table belongs to a specific place and redirect accordingly
            if ($table->place_id && $table->restaurant_id) {
                return redirect()
                    ->route('admin.restaurants.places.tables.index', [$table->restaurant_id, $table->place_id])
                    ->with('success', 'მაგიდა წარმატებით განახლდა.');
            }

            return redirect()->route('admin.tables.index')
                           ->with('success', 'მაგიდა წარმატებით განახლდა.');
        } catch (Throwable $e) {
            DB::rollBack();
            
            // Debug: Log the error
            Log::error('Table update error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'მაგიდის განახლებისას დაფიქსირდა შეცდომა: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Table $table)
    {
        try {
            DB::beginTransaction();

            // Delete associated image
            if ($table->image_link) {
                $this->cloudinaryService->deleteImageFromUrl($table->image_link, 'foodly/tables');
            }

            // Delete associated QR code
            if ($table->qr_code_image) {
                $this->qrCodeService->deleteQRCode($table->qr_code_image);
            }

            $table->delete();

            DB::commit();

            return redirect()->route('admin.tables.index')
                           ->with('success', 'მაგიდა წარმატებით წაიშალა.');
        } catch (Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'მაგიდის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }

    /**
     * Get places for a specific restaurant (AJAX endpoint)
     */
    public function getRestaurantPlaces(Request $request, $restaurantId)
    {
        $places = Place::where('restaurant_id', $restaurantId)
                      ->with('translations')
                      ->get()
                      ->map(function ($place) {
                          return [
                              'id' => $place->id,
                              'name' => $place->name
                          ];
                      });

        return response()->json($places);
    }

    /**
     * Delete only the image of a table
     */
    public function deleteOnlyImage(Table $table)
    {
        try {
            if ($table->image_link) {
                $this->cloudinaryService->deleteImageFromUrl($table->image_link, 'foodly/tables');

                $table->update(['image_link' => null]);

                return back()->with('success', 'სურათი წარმატებით წაიშალა');
            }

            return back()->with('info', 'სურათი არ არის დამატებული');
        } catch (Throwable $e) {
            return back()->withErrors(['error' => 'სურათის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }

    /**
     * Display tables for a specific place within a restaurant
     */
    public function indexByPlace(Request $request, Restaurant $restaurant, Place $place)
    {
        // Verify that the place belongs to the restaurant
        if ($place->restaurant_id !== $restaurant->id) {
            abort(404, 'Place not found in this restaurant');
        }

        $query = Table::with(['restaurant.translations', 'place.translations'])
                     ->where('restaurant_id', $restaurant->id)
                     ->where('place_id', $place->id);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                // Search in table translations
                $q->whereHas('translations', function ($subQ) use ($search) {
                    $subQ->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('description', 'LIKE', "%{$search}%");
                })
                // Search by capacity/seats
                ->orWhere('seats', 'LIKE', "%{$search}%")
                ->orWhere('capacity', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $tables = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.restaurants.places.tables.index', compact('tables', 'restaurant', 'place'));
    }

    /**
     * Show form for creating a new table for a specific place
     */
    public function createForPlace(Restaurant $restaurant, Place $place)
    {
        // Verify that the place belongs to the restaurant
        if ($place->restaurant_id !== $restaurant->id) {
            abort(404, 'Place not found in this restaurant');
        }

        return view('admin.restaurants.places.tables.create', compact('restaurant', 'place'));
    }

    /**
     * Store a new table for a specific place
     */
    public function storeForPlace(StoreTableRequest $request, Restaurant $restaurant, Place $place)
    {
        // Verify that the place belongs to the restaurant
        if ($place->restaurant_id !== $restaurant->id) {
            abort(404, 'Place not found in this restaurant');
        }

        try {
            DB::beginTransaction();

            // Get validated data with proper formatting
            $data = $request->validatedData();
            
            // Force the restaurant and place IDs to match the route parameters
            $data['restaurant_id'] = $restaurant->id;
            $data['place_id'] = $place->id;

            // Auto-assign rank if not provided
            $data = $this->rankService->assignRankIfEmpty($data, Table::class, [
                'restaurant_id' => $restaurant->id,
                'place_id' => $place->id
            ]);

            // Set created_by field
            $data['created_by'] = Auth::id();

            // Generate slug from first available translation name
            $defaultLocale = config('app.locale');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
            if (empty($slugName) && !empty($data['translations'])) {
                $firstTranslation = reset($data['translations']);
                $slugName = $firstTranslation['name'] ?? '';
            }
            $data['slug'] = $this->slugService->generate(new Table(), $slugName);

            // Handle image upload using the same pattern as store method
            if (request()->hasFile('image')) {
                try {
                    $data['image_link'] = $this->cloudinaryService->upload(request()->file('image'), 'foodly/tables');
                } catch (\Exception $e) {
                    Log::error('TableController: Image upload failed', [
                        'error' => $e->getMessage(),
                        'restaurant_id' => $restaurant->id,
                        'place_id' => $place->id
                    ]);
                    throw $e;
                }
            }

            // Extract translations and remove from main data
            $translations = $data['translations'] ?? [];
            unset($data['translations']);

            // Create table without translations first
            $table = Table::create($data);

            // Now manually add only the translations that have non-empty names
            foreach ($translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $table->translateOrNew($locale)->fill($translation);
                }
            }

            // Save the table with all translations
            $table->save();

            // Generate QR code after table is created and saved
            try {
                // Get restaurant and place to access their slugs
                $restaurant = $table->restaurant;
                $place = $table->place;
                $tableName = $table->translations->first()->name ?? 'Table';
                
                $qrData = $this->qrCodeService->generateForTable(
                    $table->id,
                    $tableName,
                    $restaurant->slug,
                    $place ? $place->slug : null,
                    $table->slug
                );

                // Update table with QR code data
                $table->update([
                    'qr_code_image' => $qrData['qr_code_image'],
                    'qr_code_link' => $qrData['qr_code_link']
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to generate QR code for table: ' . $e->getMessage());
            }

            DB::commit();

            return redirect()
                ->route('admin.restaurants.places.tables.index', [$restaurant, $place])
                ->with('success', 'მაგიდა წარმატებით შეიქმნა!');

        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Table creation failed:', [
                'error' => $e->getMessage(),
                'restaurant_id' => $restaurant->id,
                'place_id' => $place->id,
                'data' => $request->validated()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'მაგიდის შექმნა ვერ მოხერხდა. გთხოვთ, სცადოთ თავიდან.']);
        }
    }
    
    /**
     * Show table for a specific place
     */
    public function showForPlace(Restaurant $restaurant, Place $place, Table $table)
    {
        // Ensure table belongs to the correct place
        if ($table->place_id !== $place->id) {
            abort(404);
        }
        
        $table->load(['restaurant.translations', 'place.translations', 'translations', 'reservationSlots']);
        
        return view('admin.restaurants.places.tables.show', compact('restaurant', 'place', 'table'));
    }
    
    /**
     * Edit table for a specific place
     */
    public function editForPlace(Restaurant $restaurant, Place $place, Table $table)
    {
        // Ensure table belongs to the correct place
        if ($table->place_id !== $place->id) {
            abort(404);
        }
        
        $table->load(['restaurant.translations', 'place.translations', 'translations']);
        
        return view('admin.restaurants.places.tables.edit', compact('restaurant', 'place', 'table'));
    }
    
    /**
     * Update table for a specific place
     */
    public function updateForPlace(UpdateTableRequest $request, Restaurant $restaurant, Place $place, Table $table)
    {
        // Ensure table belongs to the correct place
        if ($table->place_id !== $place->id) {
            abort(404);
        }
        
        return $this->update($request, $table);
    }
    
    /**
     * Delete table for a specific place
     */
    public function destroyForPlace(Restaurant $restaurant, Place $place, Table $table)
    {
        // Ensure table belongs to the correct place
        if ($table->place_id !== $place->id) {
            abort(404);
        }
        
        try {
            // Delete from Cloudinary if has image
            if ($table->cloudinary_public_id) {
                $this->cloudinaryService->deleteImage($table->cloudinary_public_id);
            }
            
            $table->delete();
            
            return redirect()->route('admin.restaurants.places.tables.index', [$restaurant, $place])
                ->with('success', 'მაგიდა წარმატებით წაიშალა!');
                
        } catch (Throwable $e) {
            Log::error('Table deletion failed:', [
                'error' => $e->getMessage(),
                'table_id' => $table->id
            ]);
            
            return back()->withErrors(['error' => 'მაგიდის წაშლა ვერ მოხერხდა.']);
        }
    }
    
    /**
     * Delete only image for table in a specific place
     */
    public function deleteOnlyImageForPlace(Restaurant $restaurant, Place $place, Table $table)
    {
        // Ensure table belongs to the correct place
        if ($table->place_id !== $place->id) {
            abort(404);
        }
        
        return $this->deleteOnlyImage($table);
    }
}
