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

    /**
     * Show menu items for a specific category
     */
    public function indexByCategory(Request $request, Restaurant $restaurant, MenuCategory $category): View
    {
        // Verify category belongs to restaurant
        if ($category->restaurant_id !== $restaurant->id) {
            abort(404);
        }

        $query = MenuItem::where('restaurant_id', $restaurant->id)
            ->where('menu_category_id', $category->id)
            ->with(['translations', 'menuCategory.translations', 'restaurant.translations']);

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

        return view('admin.restaurants.menu.items.index', compact(
            'menuItems', 
            'restaurant', 
            'category'
        ));
    }

    /**
     * Show form for creating a menu item in a specific category
     */
    public function createForCategory(Restaurant $restaurant, MenuCategory $category): View
    {
        // Verify category belongs to restaurant
        if ($category->restaurant_id !== $restaurant->id) {
            abort(404);
        }

        return view('admin.restaurants.menu.items.create', compact('restaurant', 'category'));
    }

    /**
     * Store a new menu item in a specific category
     */
    public function storeForCategory(StoreMenuItemRequest $request, Restaurant $restaurant, MenuCategory $category): RedirectResponse
    {
        // Verify category belongs to restaurant
        if ($category->restaurant_id !== $restaurant->id) {
            abort(404);
        }

        $rank = $this->rankService->getNextRank(MenuItem::class, [
            'restaurant_id' => $restaurant->id,
            'menu_category_id' => $category->id
        ]);

        $data = $request->validated();
        
        // Get name from translations for slug generation
        $translations = $data['translations'] ?? [];
        $nameForSlug = $translations['en']['name'] ?? $translations['ka']['name'] ?? 'menu-item';
        
        $slug = $this->slugService->generate(new MenuItem(), $nameForSlug);

        $data = array_merge($data, [
            'restaurant_id' => $restaurant->id,
            'menu_category_id' => $category->id,
            'slug' => $slug,
            'rank' => $rank,
        ]);

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

        return redirect()
            ->route('admin.restaurants.menu.categories.items.index', [$restaurant, $category])
            ->with('success', 'მენიუს ელემენტი წარმატებით შეიქმნა!');
    }

    /**
     * Show a specific menu item in a category
     */
    public function showForCategory(Restaurant $restaurant, MenuCategory $category, MenuItem $item): View
    {
        // Verify relationships
        if ($category->restaurant_id !== $restaurant->id || $item->restaurant_id !== $restaurant->id || $item->menu_category_id !== $category->id) {
            abort(404);
        }

        return view('admin.restaurants.menu.items.show', compact('restaurant', 'category', 'item'));
    }

    /**
     * Show form for editing a menu item in a category
     */
    public function editForCategory(Restaurant $restaurant, MenuCategory $category, MenuItem $item): View
    {
        // Verify relationships
        if ($category->restaurant_id !== $restaurant->id || $item->restaurant_id !== $restaurant->id || $item->menu_category_id !== $category->id) {
            abort(404);
        }

        // Load relationships
        $item->load(['restaurant', 'menuCategory']);

        return view('admin.restaurants.menu.items.edit', compact('restaurant', 'category', 'item'));
    }

    /**
     * Update a menu item in a category
     */
    public function updateForCategory(UpdateMenuItemRequest $request, Restaurant $restaurant, MenuCategory $category, MenuItem $item): RedirectResponse
    {
        // Verify relationships
        if ($category->restaurant_id !== $restaurant->id || $item->restaurant_id !== $restaurant->id || $item->menu_category_id !== $category->id) {
            abort(404);
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image) {
                $publicId = $this->cloudinaryService->extractPublicIdFromUrl($item->image, 'foodly/menu_items');
                $this->cloudinaryService->deleteImage($publicId);
            }
            
            $data['image'] = $this->cloudinaryService->upload($request->file('image'), 'foodly/menu_items');
        }

        // Extract translations and remove from main data
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // Update menu item without translations first
        $item->update($data);

        // Clear existing translations that are not in the new data
        $item->translations()->delete();

        // Now manually add only the translations that have non-empty names
        foreach ($translations as $locale => $translation) {
            if (!empty($translation['name'])) {
                $item->translateOrNew($locale)->fill($translation);
            }
        }
        
        // Save the translations
        $item->save();

        return redirect()
            ->route('admin.restaurants.menu.categories.items.index', [$restaurant, $category])
            ->with('success', 'მენიუს ელემენტი წარმატებით განახლდა!');
    }

    /**
     * Delete a menu item from a category
     */
    public function destroyForCategory(Restaurant $restaurant, MenuCategory $category, MenuItem $item): RedirectResponse
    {
        // Verify relationships
        if ($category->restaurant_id !== $restaurant->id || $item->restaurant_id !== $restaurant->id || $item->menu_category_id !== $category->id) {
            abort(404);
        }

        // Delete image if exists
        if ($item->image) {
            $publicId = $this->cloudinaryService->extractPublicIdFromUrl($item->image, 'foodly/menu_items');
            $this->cloudinaryService->deleteImage($publicId);
        }

        $item->delete();

        return redirect()
            ->route('admin.restaurants.menu.categories.items.index', [$restaurant, $category])
            ->with('success', 'მენიუს ელემენტი წარმატებით წაიშალა!');
    }

    /**
     * Delete image for a menu item in a category
     */
    public function deleteImageForCategory(Restaurant $restaurant, MenuCategory $category, MenuItem $item): \Illuminate\Http\JsonResponse
    {
        // Verify relationships
        if ($category->restaurant_id !== $restaurant->id || $item->restaurant_id !== $restaurant->id || $item->menu_category_id !== $category->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            if ($item->image) {
                $publicId = $this->cloudinaryService->extractPublicIdFromUrl($item->image, 'foodly/menu_items');
                $this->cloudinaryService->deleteImage($publicId);
                $item->update(['image' => null]);
            }

            return response()->json(['success' => true, 'message' => 'სურათი წარმატებით წაიშალა']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'სურათის წაშლისას მოხდა შეცდომა']);
        }
    }

    /**
     * Sort menu items within a category
     */
    public function sortForCategory(Request $request, Restaurant $restaurant, MenuCategory $category): \Illuminate\Http\JsonResponse
    {
        // Verify category belongs to restaurant
        if ($category->restaurant_id !== $restaurant->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $itemIds = $request->input('item_ids', []);
        
        foreach ($itemIds as $index => $itemId) {
            MenuItem::where('id', $itemId)
                ->where('restaurant_id', $restaurant->id)
                ->where('menu_category_id', $category->id)
                ->update(['rank' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }
}
