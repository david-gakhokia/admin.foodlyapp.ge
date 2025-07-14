<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\StorePlaceRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;
use App\Models\Place;
use App\Models\Restaurant;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class PlaceController extends Controller
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
        $query = Place::with(['restaurant.translations', 'translations']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                // Search in place translations
                $q->whereHas('translations', function ($translationQuery) use ($searchTerm) {
                    $translationQuery->where('name', 'LIKE', "%{$searchTerm}%")
                                   ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                })
                // Search in restaurant name
                ->orWhereHas('restaurant.translations', function ($restaurantQuery) use ($searchTerm) {
                    $restaurantQuery->where('name', 'LIKE', "%{$searchTerm}%");
                })
                // Search by place ID
                ->orWhere('id', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $places = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Preserve query parameters in pagination links
        $places->appends($request->query());
        
        return view('admin.restaurants.places.index', compact('places'));
    }

    public function indexByRestaurant(Request $request, Restaurant $restaurant)
    {
        $query = Place::with(['restaurant.translations', 'translations'])
                     ->where('restaurant_id', $restaurant->id);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                // Search in place translations
                $q->whereHas('translations', function ($translationQuery) use ($searchTerm) {
                    $translationQuery->where('name', 'LIKE', "%{$searchTerm}%")
                                   ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                })
                // Search by place ID
                ->orWhere('id', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $places = $query->orderBy('rank')->orderBy('created_at', 'desc')->paginate(10);
        
        // Preserve query parameters in pagination links
        $places->appends($request->query());
        
        return view('admin.restaurants.places.index', compact('places', 'restaurant'));
    }

    public function show(Place $place)
    {
        $place->load(['restaurant.translations', 'translations', 'tables.translations']);
        $restaurant = $place->restaurant;
        return view('admin.restaurants.places.show', compact('place', 'restaurant'));
    }

    public function create(Request $request)
    {
        $restaurants = Restaurant::with('translations')->get();

        // If restaurant_id is provided in query, preselect it
        $selectedRestaurant = null;
        if ($request->has('restaurant_id')) {
            $selectedRestaurant = $request->restaurant_id;
        }

        return view('admin.restaurants.places.create', compact('restaurants', 'selectedRestaurant'));
    }

    public function store(StorePlaceRequest $request)
    {
        $data = $request->validatedData(); // Use validatedData() instead of validated()

        // Auto-assign rank if not provided
        $data = $this->rankService->assignRankIfEmpty($data, Place::class);

        // Generate slug from default locale
        $defaultLocale = config('app.locale');
        $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
        $data['slug'] = $this->slugService->generate(new Place(), $slugName);

        // Handle image upload
        if (request()->hasFile('image_file')) {
            $data['image_link'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/places');
        }

        // Extract translations and remove from main data
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // Create place without translations first
        $place = Place::create($data);

        // Now manually add only the translations that have non-empty names
        foreach ($translations as $locale => $translation) {
            if (!empty($translation['name'])) {
                $place->translateOrNew($locale)->fill($translation);
            }
        }
        
        // Save the translations
        $place->save();

        // Generate QR code after place is created and saved
        try {
            // Get restaurant to access its slug
            $restaurant = $place->restaurant;
            $placeName = $place->translations->first()->name ?? 'Place';
            
            $qrData = $this->qrCodeService->generateForPlace(
                $place->id,
                $placeName,
                $restaurant->slug,
                $place->slug
            );

            // Update place with QR code data
            $place->update([
                'qr_code_image' => $qrData['qr_code_image'],
                'qr_code_link' => $qrData['qr_code_link']
            ]);
        } catch (\Exception $e) {
            Log::warning('Failed to generate QR code for place: ' . $e->getMessage());
        }

        return redirect()->route('admin.places.index')->with('success', 'ადგილი წარმატებით შეიქმნა');
    }

    public function edit(Place $place)
    {
        $restaurants = Restaurant::with('translations')->get();
        return view('admin.restaurants.places.edit', compact('place', 'restaurants'));
    }

    public function update(UpdatePlaceRequest $request, Place $place)
    {
        try {
            DB::beginTransaction();

            // Debug: Log original request first
            Log::info('Place update - original request:', request()->all());
            
            $data = $request->validatedData();
            
            // Debug: Log processed data
            Log::info('Place update - validated data:', $data);

            // Generate new slug
            $defaultLocale = config('app.locale');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
            $data['slug'] = $this->slugService->generateForUpdate($place, $slugName, $place->id);

            // Handle image upload/deletion
            if (request()->hasFile('image_file')) {
                // Delete old image if exists
                if ($place->image_link) {
                    $this->cloudinaryService->deleteImageFromUrl($place->image_link, 'foodly/places');
                }
                // Upload new image
                $data['image_link'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/places');
            } elseif (!empty($data['image_link']) && $data['image_link'] !== $place->image_link) {
                // Delete old Cloudinary image if switching to external link
                if ($place->image_link) {
                    $this->cloudinaryService->deleteImageFromUrl($place->image_link, 'foodly/places');
                }
            }

            // Extract translations and remove from main data
            $translations = $data['translations'] ?? [];
            unset($data['translations']);

            // Update place without translations first
            $place->update($data);

            // Clear existing translations that are not in the new data
            $place->translations()->delete();

            // Now manually add only the translations that have non-empty names
            foreach ($translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $place->translateOrNew($locale)->fill($translation);
                }
            }
            
            // Save the translations
            $place->save();

            // Regenerate QR code if slug or name changed
            try {
                $restaurant = $place->restaurant;
                $placeName = $place->translations->first()->name ?? 'Place';
                
                $qrData = $this->qrCodeService->regenerateForPlace(
                    $place->id,
                    $placeName,
                    $restaurant->slug,
                    $place->slug,
                    $place->qr_code_url
                );

                // Update place with new QR code data
                $place->update([
                    'qr_code_url' => $qrData['qr_code_url'],
                    'qr_code_link' => $qrData['qr_code_link']
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to regenerate QR code for place: ' . $e->getMessage());
            }

            DB::commit();

            return redirect()
                ->route('admin.places.index')
                ->with('success', 'ადგილი წარმატებით განახლდა');
        } catch (Throwable $e) {
            DB::rollBack();
            
            // Debug: Log the error
            Log::error('Place update error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'ადგილის განახლებისას დაფიქსირდა შეცდომა: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Place $place)
    {
        try {
            DB::beginTransaction();

            // Delete associated image
            if ($place->image_link) {
                $this->cloudinaryService->deleteImageFromUrl($place->image_link, 'foodly/places');
            }

            // Delete associated QR code
            if ($place->qr_code_url) {
                $this->qrCodeService->deleteQRCode($place->qr_code_url);
            }

            $place->delete();

            DB::commit();

            return redirect()
                ->route('admin.restaurants.places.index')
                ->with('success', 'ადგილი წარმატებით წაიშალა');
        } catch (Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'ადგილის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }

    /**
     * Bulk delete places
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'place_ids' => 'required|json'
        ]);

        try {
            DB::beginTransaction();

            $placeIds = json_decode($request->place_ids, true);
            
            if (empty($placeIds) || !is_array($placeIds)) {
                return back()->withErrors(['error' => 'არასწორი მონაცემები']);
            }

            $places = Place::whereIn('id', $placeIds)->get();
            
            if ($places->isEmpty()) {
                return back()->withErrors(['error' => 'ადგილები ვერ მოიძებნა']);
            }

            foreach ($places as $place) {
                // Delete associated image
                if ($place->image_link) {
                    $this->cloudinaryService->deleteImageFromUrl($place->image_link, 'foodly/places');
                }

                // Delete associated QR code
                if ($place->qr_code_url) {
                    $this->qrCodeService->deleteQRCode($place->qr_code_url);
                }

                $place->delete();
            }

            DB::commit();

            $deletedCount = $places->count();
            return redirect()
                ->route('admin.restaurants.places.index')
                ->with('success', "წარმატებით წაიშალა {$deletedCount} ადგილი");

        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Bulk delete places error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'ადგილების წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete only the image of a place
     */
    public function deleteOnlyImage(Place $place)
    {
        try {
            if ($place->image_link) {
                $this->cloudinaryService->deleteImageFromUrl($place->image_link, 'foodly/places');

                $place->update(['image_link' => null]);

                return back()->with('success', 'სურათი წარმატებით წაიშალა');
            }

            return back()->with('info', 'სურათი არ არის დამატებული');
        } catch (Throwable $e) {
            return back()->withErrors(['error' => 'სურათის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }


    // Restaurant-specific methods for nested routes

    public function createForRestaurant(Restaurant $restaurant)
    {
        $restaurants = Restaurant::with('translations')->get();
        $selectedRestaurant = $restaurant->id;
        
        return view('admin.restaurants.places.create', compact('restaurants', 'selectedRestaurant', 'restaurant'));
    }

    public function storeForRestaurant(StorePlaceRequest $request, Restaurant $restaurant)
    {
        $data = $request->validatedData();

        // Force the restaurant_id to match the route parameter
        $data['restaurant_id'] = $restaurant->id;

        // Auto-assign rank if not provided
        $data = $this->rankService->assignRankIfEmpty($data, Place::class);

        // Generate slug from default locale
        $defaultLocale = config('app.locale');
        $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
        $data['slug'] = $this->slugService->generate(new Place(), $slugName);

        // Handle image upload
        if (request()->hasFile('image_file')) {
            $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/places');
        }

        // Extract translations and remove from main data
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // Create place without translations first
        $place = Place::create($data);

        // Now manually add only the translations that have non-empty names
        foreach ($translations as $locale => $translation) {
            if (!empty($translation['name'])) {
                $place->translateOrNew($locale)->fill($translation);
            }
        }
        
        // Save the translations
        $place->save();

        // Generate QR code after place is created and saved
        try {
            $placeName = $place->translations->first()->name ?? 'Place';
            
            $qrData = $this->qrCodeService->generateForPlace(
                $place->id,
                $placeName,
                $restaurant->slug,
                $place->slug
            );

            // Update place with QR code data
            $place->update([
                'qr_code_image' => $qrData['qr_code_image'],
                'qr_code_link' => $qrData['qr_code_link']
            ]);
        } catch (\Exception $e) {
            Log::warning('Failed to generate QR code for place: ' . $e->getMessage());
        }

        return redirect()->route('admin.restaurants.places.index', $restaurant)->with('success', 'ადგილი წარმატებით შეიქმნა');
    }

    public function showForRestaurant(Restaurant $restaurant, Place $place)
    {
        // Ensure the place belongs to the restaurant
        if ($place->restaurant_id !== $restaurant->id) {
            abort(404);
        }

        $place->load(['restaurant.translations', 'translations', 'tables.translations']);
        return view('admin.restaurants.places.show', compact('place', 'restaurant'));
    }

    public function editForRestaurant(Restaurant $restaurant, Place $place)
    {
        // Ensure the place belongs to the restaurant
        if ($place->restaurant_id !== $restaurant->id) {
            abort(404);
        }

        $restaurants = Restaurant::with('translations')->get();
        return view('admin.restaurants.places.edit', compact('place', 'restaurants', 'restaurant'));
    }

    public function updateForRestaurant(UpdatePlaceRequest $request, Restaurant $restaurant, Place $place)
    {
        // Ensure the place belongs to the restaurant
        if ($place->restaurant_id !== $restaurant->id) {
            abort(404);
        }

        try {
            DB::beginTransaction();

            $data = $request->validatedData();
            
            // Force the restaurant_id to match the route parameter
            $data['restaurant_id'] = $restaurant->id;

            // Generate new slug
            $defaultLocale = config('app.locale');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
            $data['slug'] = $this->slugService->generateForUpdate($place, $slugName, $place->id);

            // Handle image upload/deletion
            if (request()->hasFile('image_file')) {
                // Delete old image if exists
                if ($place->image_link) {
                    $this->cloudinaryService->deleteImageFromUrl($place->image_link, 'foodly/places');
                }
                // Upload new image
                $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/places');
            } elseif (!empty($data['image']) && $data['image'] !== $place->image) {
                // Delete old Cloudinary image if switching to external link
                if ($place->image) {
                    $this->cloudinaryService->deleteImageFromUrl($place->image, 'foodly/places');
                }
            }

            // Extract translations and remove from main data
            $translations = $data['translations'] ?? [];
            unset($data['translations']);

            // Update place without translations first
            $place->update($data);

            // Clear existing translations that are not in the new data
            $place->translations()->delete();

            // Now manually add only the translations that have non-empty names
            foreach ($translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $place->translateOrNew($locale)->fill($translation);
                }
            }
            
            // Save the translations
            $place->save();

            // Regenerate QR code if slug or name changed
            try {
                $placeName = $place->translations->first()->name ?? 'Place';
                
                $qrData = $this->qrCodeService->regenerateForPlace(
                    $place->id,
                    $placeName,
                    $restaurant->slug,
                    $place->slug,
                    $place->qr_code_url
                );

                // Update place with new QR code data
                $place->update([
                    'qr_code_url' => $qrData['qr_code_url'],
                    'qr_code_link' => $qrData['qr_code_link']
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to regenerate QR code for place: ' . $e->getMessage());
            }

            DB::commit();

            return redirect()
                ->route('admin.restaurants.places.index', $restaurant)
                ->with('success', 'ადგილი წარმატებით განახლდა');
        } catch (Throwable $e) {
            DB::rollBack();
            
            Log::error('Place update error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'ადგილის განახლებისას დაფიქსირდა შეცდომა: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroyForRestaurant(Restaurant $restaurant, Place $place)
    {
        // Ensure the place belongs to the restaurant
        if ($place->restaurant_id !== $restaurant->id) {
            abort(404);
        }

        try {
            DB::beginTransaction();

            // Delete associated image
            if ($place->image_link) {
                $this->cloudinaryService->deleteImageFromUrl($place->image_link, 'foodly/places');
            }

            // Delete associated QR code
            if ($place->qr_code_url) {
                $this->qrCodeService->deleteQRCode($place->qr_code_url);
            }

            $place->delete();

            DB::commit();

            return redirect()
                ->route('admin.restaurants.places.index', $restaurant)
                ->with('success', 'ადგილი წარმატებით წაიშალა');
        } catch (Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'ადგილის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }

    public function deleteOnlyImageForRestaurant(Restaurant $restaurant, Place $place)
    {
        // Ensure the place belongs to the restaurant
        if ($place->restaurant_id !== $restaurant->id) {
            abort(404);
        }

        try {
            if ($place->image_link) {
                $this->cloudinaryService->deleteImageFromUrl($place->image_link, 'foodly/places');

                $place->update(['image_link' => null]);

                return back()->with('success', 'სურათი წარმატებით წაიშალა');
            }

            return back()->with('info', 'სურათი არ არის დამატებული');
        } catch (Throwable $e) {
            return back()->withErrors(['error' => 'სურათის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }
}
