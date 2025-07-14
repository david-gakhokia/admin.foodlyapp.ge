<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItem\StoreMenuItemRequest;
use App\Http\Requests\MenuItem\UpdateMenuItemRequest;
use App\Models\MenuItem;
use App\Models\MenuCategory;
use Illuminate\Support\Str;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Restaurant;

class MenuItemController extends Controller
{
    public function __construct(
        protected CloudinaryService $cloudinaryService,
        protected SlugService $slugService,
        protected RankService $rankService
    ) {}

    public function index(Request $request): View
    {
        $query = MenuItem::with(['translations', 'menuCategory.translations', 'restaurant.translations']);

        // Filter by restaurant if provided
        if ($restaurantId = $request->get('restaurant_id')) {
            $query->where('restaurant_id', $restaurantId);
        }

        // Filter by category if provided
        if ($categoryId = $request->get('category_id')) {
            $query->where('menu_category_id', $categoryId);
        }

        // Search functionality
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('slug', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('price', 'like', "%{$search}%")
                  ->orWhere('unit', 'like', "%{$search}%")
                  ->orWhereHas('translations', function ($translationQuery) use ($search) {
                      $translationQuery->where('name', 'like', "%{$search}%")
                                      ->orWhere('description', 'like', "%{$search}%")
                                      ->orWhere('ingredients', 'like', "%{$search}%");
                  });
            });
        }

        // Status filter
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $menuItems = $query->orderBy('rank')->get();
        $restaurants = Restaurant::with('translations')->get();
        $menuCategories = MenuCategory::with('translations')->get();
        
        // Get selected category info for display
        $selectedCategory = null;
        if ($categoryId = $request->get('category_id')) {
            $selectedCategory = MenuCategory::with('translations')->find($categoryId);
        }

        // Get selected restaurant info for display
        $selectedRestaurant = null;
        if ($restaurantId = $request->get('restaurant_id')) {
            $selectedRestaurant = Restaurant::with('translations')->find($restaurantId);
        }

        return view('admin.restaurants.menu.items.index', compact(
            'menuItems', 
            'restaurants', 
            'menuCategories', 
            'selectedCategory', 
            'selectedRestaurant'
        ));
    }

    public function create(Request $request): View
    {
        $restaurants = Restaurant::with('translations')->get();
        $selectedRestaurantId = $request->get('restaurant_id');
        $selectedCategoryId = $request->get('category_id');
        $menuCategories = null;
        
        // If restaurant_id is provided, load its categories
        if ($selectedRestaurantId) {
            $menuCategories = MenuCategory::where('restaurant_id', $selectedRestaurantId)
                ->with('translations')
                ->orderBy('rank')
                ->get();
        }
        
        return view('admin.restaurants.menu.items.create', compact('restaurants', 'selectedRestaurantId', 'selectedCategoryId', 'menuCategories'));
    }

    public function store(StoreMenuItemRequest $request): RedirectResponse
    {
        $data = $request->validatedData();
        
        // Auto-assign rank if not provided using RankService
        if (empty($data['rank'])) {
            $data['rank'] = $this->rankService->getNextRank(MenuItem::class, [
                'restaurant_id' => $data['restaurant_id'],
                'menu_category_id' => $data['menu_category_id']
            ]);
        }
        
        // Generate slug from the name in the default locale
        if (empty($data['slug'])) {
            // Generate slug from default locale
            $defaultLocale = config('app.locale');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
            $data['slug'] = $this->slugService->generate(new MenuItem(), $slugName);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $this->cloudinaryService->upload($request->file('image'), 'foodly/menu_items');
        }

        // Extract translations and remove from main data
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // Create menu item without translations first
        $menuItem = MenuItem::create($data);

        // Now manually add only the translations that have non-empty names
        foreach ($translations as $locale => $translation) {
            if (!empty($translation['name'])) {
                $menuItem->translateOrNew($locale)->fill($translation);
            }
        }
        
        // Save the translations
        $menuItem->save();

        return redirect()->route('admin.menu.items.index', ['restaurant_id' => $data['restaurant_id']])->with('success', 'Menu Item created successfully.');
    }

    public function edit(MenuItem $menuItem): View
    {
        $restaurants = Restaurant::with('translations')->get();
        // Load categories only for the current menu item's restaurant
        $menuCategories = MenuCategory::where('restaurant_id', $menuItem->restaurant_id)
            ->whereNotNull('parent_id') // Only child categories
            ->with('translations')
            ->orderBy('rank')
            ->get();
        return view('admin.restaurants.menu.items.edit', compact('menuItem', 'restaurants', 'menuCategories'));
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem): RedirectResponse
    {
        $data = $request->validatedData();

        if ($request->hasFile('image')) {
            if ($menuItem->image) {
                $publicId = $this->cloudinaryService->extractPublicIdFromUrl($menuItem->image, 'foodly/menu_items');
                $this->cloudinaryService->deleteImage($publicId);
            }

            $data['image'] = $this->cloudinaryService->upload($request->file('image'), 'foodly/menu_items');
        }

        // Extract translations and remove from main data
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // Update menu item without translations first
        $menuItem->update($data);

        // Clear existing translations that are not in the new data
        $menuItem->translations()->delete();

        // Now manually add only the translations that have non-empty names
        foreach ($translations as $locale => $translation) {
            if (!empty($translation['name'])) {
                $menuItem->translateOrNew($locale)->fill($translation);
            }
        }
        
        // Save the translations
        $menuItem->save();

        return redirect()->route('admin.menu.items.index')->with('success', 'Menu Item updated successfully.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        if ($menuItem->image) {
            $publicId = $this->cloudinaryService->extractPublicIdFromUrl($menuItem->image, 'foodly/menu_items');
            $this->cloudinaryService->deleteImage($publicId);
        }

        $menuItem->delete();

        return redirect()->route('admin.menu.items.index')->with('success', 'Menu Item deleted.');
    }

    public function deleteImage(MenuItem $menuItem): \Illuminate\Http\JsonResponse
    {
        if ($menuItem->image) {
            $publicId = $this->cloudinaryService->extractPublicIdFromUrl($menuItem->image, 'foodly/menu_items');
            $this->cloudinaryService->deleteImage($publicId);

            $menuItem->update(['image' => null]);
        }

        return response()->json(['status' => 'success']);
    }

    public function sort(Request $request): \Illuminate\Http\JsonResponse
    {
        foreach ($request->order as $item) {
            MenuItem::where('id', $item['id'])->update(['rank' => $item['rank']]);
        }

        return response()->json(['status' => 'success']);
    }

    public function getRestaurantCategories(Restaurant $restaurant): \Illuminate\Http\JsonResponse
    {
        $categories = MenuCategory::where('restaurant_id', $restaurant->id)
            ->whereNotNull('parent_id') // Only child categories
            ->with('translations')
            ->orderBy('rank')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name ?? 'Category #' . $category->id,
                ];
            });

        return response()->json([
            'categories' => $categories
        ]);
    }
}
