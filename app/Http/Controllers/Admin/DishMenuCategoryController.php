<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\MenuCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DishMenuCategoryController extends Controller
{
    /**
     * Display a listing of menu categories for a specific dish.
     */
    public function index(Dish $dish)
    {
        $menuCategories = $dish->menuCategories()
            ->with(['restaurant.translations', 'translations'])
            ->orderBy('id')
            ->paginate(15);

        return view('admin.dishes.menu-categories.index', compact('dish', 'menuCategories'));
    }

    /**
     * Show the form for creating a new dish-menu category relationship.
     */
    public function create(Dish $dish)
    {
        // Get menu categories that are not yet associated with this dish
        $availableMenuCategories = MenuCategory::with(['restaurant.translations', 'translations'])
            ->whereNull('dish_id')
            ->orWhere('dish_id', '!=', $dish->id)
            ->orderBy('restaurant_id')
            ->get()
            ->groupBy('restaurant_id');

        $restaurants = Restaurant::with('translations')->get()->keyBy('id');

        return view('admin.dishes.menu-categories.create', compact(
            'dish', 
            'availableMenuCategories', 
            'restaurants'
        ));
    }

    /**
     * Store newly created dish-menu category relationships.
     */
    public function store(Request $request, Dish $dish)
    {
        $request->validate([
            'menu_category_ids' => 'required|array|min:1',
            'menu_category_ids.*' => 'exists:menu_categories,id',
        ]);

        $assignedCount = 0;
        $errors = [];

        foreach ($request->menu_category_ids as $menuCategoryId) {
            $menuCategory = MenuCategory::find($menuCategoryId);
            
            if ($menuCategory && !$menuCategory->dish_id) {
                $menuCategory->update(['dish_id' => $dish->id]);
                $assignedCount++;
            } else {
                $categoryName = $menuCategory ? 
                    ($menuCategory->translate('ka')->name ?? $menuCategory->translate('en')->name) : 
                    "ID: {$menuCategoryId}";
                $errors[] = "Category '{$categoryName}' is already assigned to another dish";
            }
        }

        if ($assignedCount > 0) {
            $message = "Successfully assigned {$assignedCount} menu categories to dish '{$dish->translate('ka')->name}'";
            if (!empty($errors)) {
                $message .= '. ' . implode(', ', $errors);
            }
            return redirect()
                ->route('admin.dishes.menu-categories.index', $dish)
                ->with('success', $message);
        }

        return redirect()
            ->back()
            ->withErrors(['menu_category_ids' => implode(', ', $errors)])
            ->withInput();
    }

    /**
     * Show the form for editing dish-menu category relationship.
     */
    public function edit(Dish $dish, MenuCategory $menuCategory)
    {
        // Ensure this menu category belongs to this dish
        if ($menuCategory->dish_id !== $dish->id) {
            return redirect()
                ->route('admin.dishes.menu-categories.index', $dish)
                ->withErrors(['error' => 'This menu category does not belong to the selected dish.']);
        }

        return view('admin.dishes.menu-categories.edit', compact('dish', 'menuCategory'));
    }

    /**
     * Update the specified dish-menu category relationship.
     */
    public function update(Request $request, Dish $dish, MenuCategory $menuCategory)
    {
        // For now, we'll just allow removing the relationship
        // In the future, you could add more editable fields here
        
        return redirect()
            ->route('admin.dishes.menu-categories.index', $dish)
            ->with('info', 'No updates were made. Use the remove button to unassign categories.');
    }

    /**
     * Remove the specified dish-menu category relationship.
     */
    public function destroy(Dish $dish, MenuCategory $menuCategory)
    {
        if ($menuCategory->dish_id === $dish->id) {
            $categoryName = $menuCategory->translate('ka')->name ?? $menuCategory->translate('en')->name;
            $menuCategory->update(['dish_id' => null]);
            
            return redirect()
                ->route('admin.dishes.menu-categories.index', $dish)
                ->with('success', "Successfully removed '{$categoryName}' from dish '{$dish->translate('ka')->name}'");
        }

        return redirect()
            ->route('admin.dishes.menu-categories.index', $dish)
            ->withErrors(['error' => 'Menu category does not belong to this dish.']);
    }

    /**
     * Bulk update menu category assignments
     */
    public function bulkUpdate(Request $request, Dish $dish)
    {
        $request->validate([
            'action' => 'required|in:remove_all,assign_new',
            'menu_category_ids' => 'sometimes|array',
            'menu_category_ids.*' => 'exists:menu_categories,id',
        ]);

        if ($request->action === 'remove_all') {
            $removedCount = MenuCategory::where('dish_id', $dish->id)->update(['dish_id' => null]);
            
            return redirect()
                ->route('admin.dishes.menu-categories.index', $dish)
                ->with('success', "Removed {$removedCount} menu categories from dish '{$dish->translate('ka')->name}'");
        }

        if ($request->action === 'assign_new' && $request->has('menu_category_ids')) {
            return $this->store($request, $dish);
        }

        return redirect()
            ->route('admin.dishes.menu-categories.index', $dish)
            ->withErrors(['action' => 'Invalid bulk action selected.']);
    }

    /**
     * Show overview of all dish-menu category relationships
     */
    public function overview()
    {
        $dishes = Dish::with(['translations', 'menuCategories.restaurant.translations', 'menuCategories.translations'])
            ->withCount('menuCategories')
            ->orderBy('rank')
            ->paginate(20);

        return view('admin.dishes.menu-categories.overview', compact('dishes'));
    }
}
