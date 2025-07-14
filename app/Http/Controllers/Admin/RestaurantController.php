<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\QrCodeService;
use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Services\RankService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    public function __construct(
        protected CloudinaryService $cloudinaryService,
        protected SlugService $slugService,
        protected QrCodeService $qrCodeService,
        protected RankService $rankService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Restaurant::with('translations')->withCount(['dishes', 'spaces']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('slug', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('translations', function ($translation) use ($searchTerm) {
                        $translation->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('address', 'like', '%' . $searchTerm . '%')
                            ->orWhere('description', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Status filter functionality
        if ($request->filled('status')) {
            $status = $request->get('status');
            if (in_array($status, ['active', 'inactive'])) {
                $query->where('status', $status);
            }
        }

        $restaurants = $query->orderBy('rank', 'ASC')->paginate(20);

        // Preserve query parameters in pagination links
        $restaurants->appends($request->query());

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $locales = config('translatable.locales');
        return view('admin.restaurants.create', compact('locales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request): RedirectResponse
    {
        $data = $request->validatedData();

        // Map 'timezone' from request to 'time_zone' in DB
        if (isset($data['timezone'])) {
            $data['time_zone'] = $data['timezone'];
            unset($data['timezone']);
        }

        // Auto-assign rank if not provided
        if (empty($data['rank'])) {
            $data = $this->rankService->assignRankIfEmpty($data, Restaurant::class);
        }

        // Handle file uploads
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->cloudinaryService->upload($request->file('logo'), 'foodly/restaurants/logos');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $this->cloudinaryService->upload($request->file('image'), 'foodly/restaurants/images');
        }

        // Extract translations and find default locale name for slug
        $defaultLocale = config('app.locale', 'ka');
        $defaultName = '';
        
        if (isset($data[$defaultLocale]['name'])) {
            $defaultName = $data[$defaultLocale]['name'];
        } else {
            // Fallback to first available translation name
            foreach (config('translatable.locales') as $locale) {
                if (isset($data[$locale]['name']) && !empty($data[$locale]['name'])) {
                    $defaultName = $data[$locale]['name'];
                    break;
                }
            }
        }

        // Generate slug from the default name
        if ($defaultName) {
            $data['slug'] = $this->slugService->generate(new Restaurant, $defaultName);
        }

        // Set user tracking
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        // Create restaurant
        $restaurant = Restaurant::create($data);

        // Generate QR code for the restaurant
        if ($restaurant->slug) {
            try {
                $qrCodeData = $this->qrCodeService->generateForRestaurant(
                    $restaurant->id,
                    $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Restaurant',
                    $restaurant->slug
                );
                
                // Update restaurant with QR code data
                $restaurant->update([
                    'qr_code_image' => $qrCodeData['qr_code_image'],
                    'qr_code_link' => $qrCodeData['qr_code_link']
                ]);
                
            } catch (\Exception $e) {
                // Log error but don't fail the restaurant creation
                Log::error('Failed to generate QR code for restaurant: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', 'რესტორანი წარმატებით დაემატა ✅');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant): View
    {
        $restaurant->load([
            'translations',
            'creator',
            'updater',
            'places.translations',
            'tables.translations',
            'tables.place.translations',
            'menuCategories.translations',
            'menuItems.translations',
            'reservationSlots'
        ]);
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant): View
    {
        $locales = config('translatable.locales');
        return view('admin.restaurants.edit', compact('restaurant', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): RedirectResponse
    {

        $validatedData = $request->validatedData();

        // Map 'timezone' from request to 'time_zone' in DB
        if (isset($validatedData['timezone'])) {
            $validatedData['time_zone'] = $validatedData['timezone'];
            unset($validatedData['timezone']);
        }

        // Handle file uploads only if new files are uploaded
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($restaurant->logo) {
                $publicId = $this->cloudinaryService->extractPublicIdFromUrl($restaurant->logo, 'foodly/restaurants/logos');
                if ($publicId) {
                    $this->cloudinaryService->deleteImage($publicId);
                }
            }
            $validatedData['logo'] = $this->cloudinaryService->upload($request->file('logo'), 'foodly/restaurants/logos');
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($restaurant->image) {
                $publicId = $this->cloudinaryService->extractPublicIdFromUrl($restaurant->image, 'foodly/restaurants/images');
                if ($publicId) {
                    $this->cloudinaryService->deleteImage($publicId);
                }
            }
            $validatedData['image'] = $this->cloudinaryService->upload($request->file('image'), 'foodly/restaurants/images');
        }

        // Extract translations using configured locales
        $translations = [];
        $availableLocales = config('translatable.locales');
        
        foreach ($availableLocales as $locale) {
            if (isset($validatedData[$locale])) {
                // Only add translation if the name field is not empty
                if (!empty($validatedData[$locale]['name']) && trim($validatedData[$locale]['name']) !== '') {
                    $translations[$locale] = $validatedData[$locale];
                }
                unset($validatedData[$locale]);
            }
        }

        // Set user tracking for updates
        $validatedData['updated_by'] = auth()->id();

        // Update restaurant
        $restaurant->update($validatedData);

        // Clear existing translations first to prevent SQL constraint errors
        $restaurant->translations()->delete();

        // Update translations - only save translations that have a name
        foreach ($translations as $locale => $data) {
            if (!empty($data['name']) && trim($data['name']) !== '') {
                $restaurant->translateOrNew($locale)->fill($data);
            }
        }
        $restaurant->save();

        // Regenerate QR code if restaurant has a slug but no QR code yet, or if we want to update it
        if ($restaurant->slug && !$restaurant->qr_code_image) {
            try {
                $qrCodeData = $this->qrCodeService->generateForRestaurant(
                    $restaurant->id,
                    $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Restaurant',
                    $restaurant->slug
                );
                
                // Update restaurant with QR code data
                $restaurant->update([
                    'qr_code_image' => $qrCodeData['qr_code_image'],
                    'qr_code_link' => $qrCodeData['qr_code_link']
                ]);
                
            } catch (\Exception $e) {
                // Log error but don't fail the restaurant update
                Log::error('Failed to generate QR code for restaurant during update: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', 'რესტორანი წარმატებით განახლდა 🔄');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant): RedirectResponse
    {
        // Delete images from Cloudinary
        if ($restaurant->logo) {
            $publicId = $this->cloudinaryService->extractPublicIdFromUrl($restaurant->logo, 'foodly/restaurants/logos');
            if ($publicId) {
                $this->cloudinaryService->deleteImage($publicId);
            }
        }

        if ($restaurant->image) {
            $publicId = $this->cloudinaryService->extractPublicIdFromUrl($restaurant->image, 'foodly/restaurants/images');
            if ($publicId) {
                $this->cloudinaryService->deleteImage($publicId);
            }
        }

        // Delete QR code from Cloudinary
        if ($restaurant->qr_code_image) {
            try {
                $this->qrCodeService->deleteQRCode($restaurant->qr_code_image);
            } catch (\Exception $e) {
                Log::error('Failed to delete QR code for restaurant: ' . $e->getMessage());
            }
        }

        $restaurant->delete();

        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', 'რესტორანი წარმატებით წაიშალა 🗑️');
    }
}
