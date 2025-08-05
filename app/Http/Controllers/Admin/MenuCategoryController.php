<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\MenuCategory\MenuCategoryRequest;
use App\Http\Requests\MenuCategory\UpdateMenuCategoryRequest;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class MenuCategoryController extends Controller
{

    protected CloudinaryService $cloudinaryService;
    protected SlugService $slugService;
    protected RankService $rankService;

    public function __construct(
        CloudinaryService $cloudinaryService, 
        SlugService $slugService, 
        RankService $rankService
    ) {
        $this->cloudinaryService = $cloudinaryService;
        $this->slugService = $slugService;
        $this->rankService = $rankService;
    }

    public function index(Request $request)
    {
        $query = MenuCategory::translatedIn(app()->getLocale())
            ->with([
                'parent' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'restaurant.translations'
            ]);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('translations', function($translationQuery) use ($search) {
                    $translationQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('description', 'like', "%{$search}%");
                })
                ->orWhereHas('restaurant.translations', function($restaurantQuery) use ($search) {
                    $restaurantQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Filter by restaurant
        if ($request->filled('restaurant_id')) {
            $query->where('restaurant_id', $request->restaurant_id);
        }

        $menuCategories = $query->orderBy('parent_id', 'ASC') // ჯერ მშობელი კატეგორიები
            ->orderBy('rank', 'ASC')
            ->paginate(12) // 12 კატეგორია თითო გვერდზე (3x4 grid)
            ->withQueryString(); // შეინარჩუნოს search parameters

        // Get all restaurants for the filter dropdown
        $restaurants = Restaurant::with('translations')->orderBy('id')->get();

        return view('admin.restaurants.menu.categories.index', compact('menuCategories', 'restaurants'));
    }

    public function create()
    {
        return view('admin.restaurants.menu.categories.create');
    }

    public function store(MenuCategoryRequest $request)
    {
        $data = $request->validatedData(); 

        // Auto-assign rank if not provided using RankService
        if (empty($data['rank'])) {
            $data['rank'] = $this->rankService->getNextRank(MenuCategory::class, [
                'restaurant_id' => $data['restaurant_id'],
                'parent_id' => $data['parent_id'] ?? null
            ]);
        }

        // Generate slug using SlugService if not provided
        if (empty($data['slug'])) {
            // Get name from default locale for slug generation
            $defaultLocale = config('app.locale', 'en');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? 'category';
            $data['slug'] = $this->slugService->generate(new MenuCategory(), $slugName);
        }

        // Handle image upload
        if (request()->hasFile('image')) {
            $data['image'] = $this->cloudinaryService->upload(request()->file('image'), 'foodly/menu_categories');
        }

        // Extract translations and remove from main data
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // Create category without translations first
        $category = MenuCategory::create($data);
        
        // Now manually add only the translations that have non-empty names
        foreach ($translations as $locale => $translation) {
            if (!empty($translation['name'])) {
                $category->translateOrNew($locale)->fill($translation);
            }
        }
        
        // Save the translations
        $category->save();

        return redirect()
            ->route('admin.menu.categories.index')
            ->with('success', 'კატეგორია წარმატებით დაემატა ✅');
    }


    public function edit(MenuCategory $menuCategory) 
    {
        return view('admin.restaurants.menu.categories.edit', compact('menuCategory'));
    }




public function update(UpdateMenuCategoryRequest $request, MenuCategory $menuCategory) // Route Model Binding
    {
        $data = $request->validatedData(); // Use validatedData() like DishController
        Log::info('CONTROLLER (update): Validated Data for MenuCategory ID ' . $menuCategory->id . ':', $data);

        // 🧠 **Slug Generation Logic for Update**
        if (empty($data['slug'])) {
            // Generate slug from default locale
            $defaultLocale = config('app.locale');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? '';
            $data['slug'] = $this->slugService->generateForUpdate(
                new MenuCategory(), 
                $slugName, 
                $menuCategory->id
            );
        }

        // Extract translations and remove from main data
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // Handle image update/deletion
        if (request()->hasFile('image')) {
            // Delete old image if exists
            if ($menuCategory->image) {
                $this->cloudinaryService->deleteImageFromUrl($menuCategory->image, 'foodly/menu_categories');
            }
            // Upload new image
            $data['image'] = $this->cloudinaryService->upload(request()->file('image'), 'foodly/menu_categories');
        } elseif (!empty($data['image']) && $data['image'] !== $menuCategory->image) {
            // Delete old Cloudinary image if switching to external link
            if ($menuCategory->image) {
                $this->cloudinaryService->deleteImageFromUrl($menuCategory->image, 'foodly/menu_categories');
            }
        }

        Log::info('CONTROLLER (update): Data prepared for MenuCategory ID ' . $menuCategory->id . ' update:', [
            'data' => $data,
            'translations' => $translations
        ]);

        try {
            // Update category without translations first
            $menuCategory->update($data);

            // Update only provided translations, leave others unchanged (SpotController style)
            foreach ($translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $menuCategory->translateOrNew($locale)->fill($translation);
                }
            }
            $menuCategory->save();
            $menuCategory->refresh();
        } catch (\Exception $e) {
            Log::error('CONTROLLER (update): Error updating MenuCategory ID ' . $menuCategory->id . ':', [
                'message' => $e->getMessage(),
                'data_passed' => $data,
                'translations_passed' => $translations,
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'კატეგორიის განახლებისას დაფიქსირდა შეცდომა.');
        }

        return redirect()
            ->route('admin.menu.categories.index')
            ->with('success', 'კატეგორია წარმატებით განახლდა 🔄');
    }


    public function destroy(MenuCategory $menuCategory)
    {
        try {
            // Delete associated image
            if ($menuCategory->image) {
                $this->cloudinaryService->deleteImageFromUrl($menuCategory->image, 'foodly/menu_categories');
            }

            $menuCategory->delete();

            return redirect()
                ->route('admin.menu.categories.index')
                ->with('success', 'კატეგორია წარმატებით წაიშალა 🗑️');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'კატეგორიის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }


    /**
     * Get parent categories for a specific restaurant (AJAX endpoint)
     */
    public function getRestaurantParentCategories(Restaurant $restaurant): \Illuminate\Http\JsonResponse
    {
        $currentCategoryId = request()->get('current_category_id'); // Optional parameter to exclude current category
        
        $query = MenuCategory::where('restaurant_id', $restaurant->id)
            ->whereNull('parent_id') // მხოლოდ მშობელი კატეგორიები
            ->with('translations');
            
        // Exclude current category to prevent circular references
        if ($currentCategoryId) {
            $query->where('id', '!=', $currentCategoryId);
        }
        
        $parentCategories = $query->orderBy('rank')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name ?? 'Category #' . $category->id,
                ];
            });

        return response()->json([
            'categories' => $parentCategories
        ]);
    }

    // Restaurant-specific methods
    public function indexByRestaurant(Request $request, Restaurant $restaurant)
    {
        $query = MenuCategory::translatedIn(app()->getLocale())
            ->where('restaurant_id', $restaurant->id)
            ->with([
                'parent' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'restaurant.translations',
                'children' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'menuItems' // Load menu items for counting
            ]);

        // Handle parent filtering - if parent is specified, show subcategories, else show main categories
        if ($request->filled('parent')) {
            $query->where('parent_id', $request->parent);
            $parentCategory = MenuCategory::translatedIn(app()->getLocale())->find($request->parent);
        } else {
            $query->whereNull('parent_id'); // Only show main categories (no parent)
            $parentCategory = null;
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('translations', function($translationQuery) use ($search) {
                    $translationQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('description', 'like', "%{$search}%");
                });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by restaurant
        if ($request->filled('restaurant_id')) {
            $query->where('restaurant_id', $request->restaurant_id);
        }

        $menuCategories = $query->orderBy('rank')->paginate(12)->withQueryString(); // 12 კატეგორია გვერდზე

        // Use the index view for restaurant categories
        return view('admin.restaurants.menu.categories.index', compact('menuCategories', 'restaurant'));
    }

    public function createForRestaurant(Restaurant $restaurant)
    {
        return view('admin.restaurants.menu.categories.create', compact('restaurant'));
    }

    public function storeForRestaurant(Request $request, Restaurant $restaurant)
    {
        // Validate using the MenuCategoryRequest rules
        $menuCategoryRequest = new MenuCategoryRequest();
        $validated = $request->validate($menuCategoryRequest->rules());
        
        // Set restaurant context
        $validated['restaurant_id'] = $restaurant->id;
        
        // Generate slug from primary language name if not provided
        if (empty($validated['slug']) && !empty($validated['translations']['en']['name'])) {
            $validated['slug'] = $this->slugService->generate(
                new MenuCategory, 
                $validated['translations']['en']['name']
            );
        }
        
        // Auto-assign rank if not provided, scoped to restaurant
        $validated = $this->rankService->assignRankIfEmpty(
            $validated, 
            MenuCategory::class, 
            ['restaurant_id' => $restaurant->id]
        );

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->cloudinaryService->upload(
                $request->file('image'), 
                'foodly/menu_categories'
            );
        }

        // Extract translations and remove from main data
        $translations = $validated['translations'] ?? [];
        unset($validated['translations']);

        // Create category without translations first
        $menuCategory = MenuCategory::create($validated);
        
        // Now manually add only the translations that have non-empty names
        foreach ($translations as $locale => $translation) {
            if (!empty($translation['name'])) {
                $menuCategory->translateOrNew($locale)->fill($translation);
            }
        }
        
        // Save the translations
        $menuCategory->save();

        return redirect()
            ->route('admin.restaurants.menu.categories.index', $restaurant)
            ->with('success', 'Menu category created successfully.');
    }

    public function showForRestaurant(Restaurant $restaurant, MenuCategory $menuCategory)
    {
        $menuCategory->load([
            'translations',
            'parent.translations',
            'restaurant.translations',
            'menuItems.translations',
            'children.translations'
        ]);

        return view('admin.restaurants.menu.categories.show', compact('menuCategory', 'restaurant'));
    }

    public function editForRestaurant(Restaurant $restaurant, MenuCategory $menuCategory)
    {
        $menuCategory->load(['translations', 'parent.translations']);
        
        return view('admin.restaurants.menu.categories.edit', compact('menuCategory', 'restaurant'));
    }

    public function updateForRestaurant(UpdateMenuCategoryRequest $request, Restaurant $restaurant, MenuCategory $menuCategory)
    {
        $validated = $request->validatedData();
        $validated['restaurant_id'] = $restaurant->id;

        // Generate slug from primary language name if not provided or changed
        if (empty($validated['slug']) && !empty($validated['translations']['en']['name'])) {
            $validated['slug'] = $this->slugService->generateForUpdate(
                new MenuCategory,
                $validated['translations']['en']['name'],
                $menuCategory->id
            );
        }

        // Keep existing rank if not provided
        if (empty($validated['rank'])) {
            $validated['rank'] = $menuCategory->rank;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menuCategory->image) {
                $this->cloudinaryService->deleteImage($menuCategory->image);
            }
            $validated['image'] = $this->cloudinaryService->upload(
                $request->file('image'),
                'foodly/menu_categories'
            );
        }

        $translations = $validated['translations'] ?? [];
        unset($validated['translations']);

        try {
            // Update category without translations first
            $menuCategory->update($validated);

            // Update only provided translations, leave others unchanged
            foreach ($translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $menuCategory->translateOrNew($locale)->fill($translation);
                }
            }
            $menuCategory->save();
            $menuCategory->refresh();
        } catch (\Exception $e) {
            Log::error('Error updating MenuCategory:', [
                'id' => $menuCategory->id,
                'message' => $e->getMessage(),
                'data' => $validated
            ]);
            return back()->withInput()->with('error', 'კატეგორიის განახლებისას დაფიქსირდა შეცდომა.');
        }

        return redirect()
            ->route('admin.restaurants.menu.categories.index', $restaurant)
            ->with('success', 'Menu category updated successfully.');
    }

    public function destroyForRestaurant(Restaurant $restaurant, MenuCategory $menuCategory)
    {
        if ($menuCategory->image) {
            $this->cloudinaryService->deleteImage($menuCategory->image);
        }

        $menuCategory->delete();

        return redirect()
            ->route('admin.restaurants.menu.categories.index', $restaurant)
            ->with('success', 'Menu category deleted successfully.');
    }

    /**
     * Show children categories for a specific parent category
     */
    public function showParents(Request $request, Restaurant $restaurant, MenuCategory $menuCategory)
    {
        $query = MenuCategory::translatedIn(app()->getLocale())
            ->where('restaurant_id', $restaurant->id)
            ->where('parent_id', $menuCategory->id) // Show children of this category
            ->with([
                'parent' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'restaurant.translations',
                'children' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'menuItems' // Load menu items for counting
            ]);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('translations', function($translationQuery) use ($search) {
                    $translationQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('description', 'like', "%{$search}%");
                });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $menuCategories = $query->orderBy('rank')->paginate(15);

        return view('admin.restaurants.menu.categories.parent-categories', compact('menuCategories', 'restaurant', 'menuCategory'));
    }

    /**
     * Show children categories (Level 2) for a specific parent
     */
    public function showChildren(Request $request, Restaurant $restaurant, MenuCategory $parent)
    {
        $query = MenuCategory::translatedIn(app()->getLocale())
            ->where('restaurant_id', $restaurant->id)
            ->where('parent_id', $parent->id)
            ->with([
                'parent' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'restaurant.translations',
                'children' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'menuItems'
            ]);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('translations', function($translationQuery) use ($search) {
                    $translationQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('description', 'like', "%{$search}%");
                });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $menuCategories = $query->orderBy('rank')->paginate(15);

        return view('admin.restaurants.menu.categories.children', compact('menuCategories', 'restaurant', 'parent'));
    }

    /**
     * Create child category for a specific parent (Level 2)
     */
    public function createChildForParent(Restaurant $restaurant, MenuCategory $parent)
    {
        return view('admin.restaurants.menu.categories.create-child', compact('restaurant', 'parent'));
    }

    /**
     * Store child category for a specific parent (Level 2)
     */
    public function storeChildForParent(Request $request, Restaurant $restaurant, MenuCategory $parent)
    {
        $validated = $request->validate([
            'name_ka' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ka' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = $this->slugService->generate(new MenuCategory(), $validated['name_en']);
        $rank = $this->rankService->getNextRank(MenuCategory::class, ['restaurant_id' => $restaurant->id, 'parent_id' => $parent->id]);

        $data = [
            'restaurant_id' => $restaurant->id,
            'parent_id' => $parent->id,
            'slug' => $slug,
            'rank' => $rank,
            'status' => $validated['status'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageUrl = $this->cloudinaryService->uploadImage($request->file('image'), 'menu-categories');
            $data['image_url'] = $imageUrl;
        }

        $menuCategory = MenuCategory::create($data);

        // Create translations
        $menuCategory->translateOrNew('ka')->name = $validated['name_ka'];
        $menuCategory->translateOrNew('ka')->description = $validated['description_ka'] ?? '';
        $menuCategory->translateOrNew('en')->name = $validated['name_en'];
        $menuCategory->translateOrNew('en')->description = $validated['description_en'] ?? '';
        $menuCategory->save();

        return redirect()
            ->route('admin.restaurants.menu.categories.children', [$restaurant, $parent])
            ->with('success', 'ქვეკატეგორია წარმატებით შეიქმნა!');
    }

    /**
     * Show sub-children categories (Level 3) for a specific parent and child
     */
    public function showSubChildren(Request $request, Restaurant $restaurant, MenuCategory $parent, MenuCategory $child)
    {
        $query = MenuCategory::translatedIn(app()->getLocale())
            ->where('restaurant_id', $restaurant->id)
            ->where('parent_id', $child->id)
            ->with([
                'parent' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'restaurant.translations',
                'children' => function($query) {
                    $query->translatedIn(app()->getLocale());
                },
                'menuItems'
            ]);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('translations', function($translationQuery) use ($search) {
                    $translationQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('description', 'like', "%{$search}%");
                });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $menuCategories = $query->orderBy('rank')->paginate(15);

        return view('admin.restaurants.menu.categories.subchildren', compact('menuCategories', 'restaurant', 'parent', 'child'));
    }

    /**
     * Create sub-child category for a specific parent and child (Level 3)
     */
    public function createSubChildForChild(Restaurant $restaurant, MenuCategory $parent, MenuCategory $child)
    {
        return view('admin.restaurants.menu.categories.create-subchild', compact('restaurant', 'parent', 'child'));
    }

    /**
     * Store sub-child category for a specific parent and child (Level 3)
     */
    public function storeSubChildForChild(Request $request, Restaurant $restaurant, MenuCategory $parent, MenuCategory $child)
    {
        $validated = $request->validate([
            'name_ka' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ka' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = $this->slugService->generate(new MenuCategory(), $validated['name_en']);
        $rank = $this->rankService->getNextRank(MenuCategory::class, ['restaurant_id' => $restaurant->id, 'parent_id' => $child->id]);

        $data = [
            'restaurant_id' => $restaurant->id,
            'parent_id' => $child->id,
            'slug' => $slug,
            'rank' => $rank,
            'status' => $validated['status'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageUrl = $this->cloudinaryService->uploadImage($request->file('image'), 'menu-categories');
            $data['image_url'] = $imageUrl;
        }

        $menuCategory = MenuCategory::create($data);

        // Create translations
        $menuCategory->translateOrNew('ka')->name = $validated['name_ka'];
        $menuCategory->translateOrNew('ka')->description = $validated['description_ka'] ?? '';
        $menuCategory->translateOrNew('en')->name = $validated['name_en'];
        $menuCategory->translateOrNew('en')->description = $validated['description_en'] ?? '';
        $menuCategory->save();

        return redirect()
            ->route('admin.restaurants.menu.categories.subchildren', [$restaurant, $parent, $child])
            ->with('success', 'მესამე დონის კატეგორია წარმატებით შეიქმნა!');
    }
}
