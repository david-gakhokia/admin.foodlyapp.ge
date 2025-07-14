<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DishRestaurantApiController extends Controller
{
    /**
     * Get restaurants that have menu categories for a specific dish
     */
    public function getRestaurantsByDish(Dish $dish)
    {
        try {
            // Get all menu categories that belong to this dish
            $menuCategories = $dish->menuCategories()
                ->with(['restaurant.translations', 'translations'])
                ->whereHas('restaurant') // Only categories that have a restaurant
                ->get();

            // Group by restaurant to avoid duplicates
            $restaurants = $menuCategories->groupBy('restaurant_id')->map(function ($categories, $restaurantId) {
                $restaurant = $categories->first()->restaurant;
                $menuCategoryNames = $categories->map(function ($category) {
                    return $category->translate('ka')->name ?? $category->translate('en')->name ?? 'Unknown Category';
                })->unique()->values();

                return [
                    'id' => $restaurant->id,
                    'name' => $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Unknown Restaurant',
                    'slug' => $restaurant->slug,
                    'logo' => $restaurant->logo,
                    'status' => $restaurant->status,
                    'address' => $restaurant->translate('ka')->address ?? $restaurant->translate('en')->address,
                    'phone' => $restaurant->phone,
                    'email' => $restaurant->email,
                    'menu_categories' => $menuCategoryNames->toArray(),
                    'menu_categories_count' => $menuCategoryNames->count(),
                ];
            })->values();

            $dishName = $dish->translate('ka')->name ?? $dish->translate('en')->name ?? 'Unknown Dish';

            return response()->json([
                'success' => true,
                'dish' => [
                    'id' => $dish->id,
                    'name' => $dishName,
                    'slug' => $dish->slug,
                    'image' => $dish->image,
                ],
                'restaurants' => $restaurants,
                'total_restaurants' => $restaurants->count(),
                'message' => "Found {$restaurants->count()} restaurants with {$dishName} categories"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching restaurants for dish',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all dishes with their restaurant counts
     */
    public function getDishesWithRestaurantCounts()
    {
        try {
            $dishes = Dish::with('translations')
                ->withCount(['menuCategories as restaurants_count' => function ($query) {
                    $query->whereHas('restaurant'); // Only count categories that have restaurants
                }])
                ->get()
                ->map(function ($dish) {
                    return [
                        'id' => $dish->id,
                        'name' => $dish->translate('ka')->name ?? $dish->translate('en')->name ?? 'Unknown Dish',
                        'slug' => $dish->slug,
                        'image' => $dish->image,
                        'restaurants_count' => $dish->restaurants_count ?? 0,
                    ];
                });

            return response()->json([
                'success' => true,
                'dishes' => $dishes,
                'total_dishes' => $dishes->count(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching dishes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search restaurants by dish name
     */
    public function searchRestaurantsByDishName(Request $request)
    {
        $request->validate([
            'dish_name' => 'required|string|min:1',
        ]);

        try {
            $dishName = $request->get('dish_name');

            // Find dishes that match the search term
            $dishes = Dish::with('translations')
                ->whereHas('translations', function ($query) use ($dishName) {
                    $query->where('name', 'like', "%{$dishName}%");
                })
                ->get();

            if ($dishes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => "No dishes found matching '{$dishName}'",
                    'dishes' => [],
                    'restaurants' => [],
                ]);
            }

            // Get all restaurants from all matching dishes
            $allRestaurants = collect();
            $dishesData = [];

            foreach ($dishes as $dish) {
                $menuCategories = $dish->menuCategories()
                    ->with(['restaurant.translations', 'translations'])
                    ->whereHas('restaurant')
                    ->get();

                $restaurants = $menuCategories->groupBy('restaurant_id')->map(function ($categories, $restaurantId) {
                    $restaurant = $categories->first()->restaurant;
                    $menuCategoryNames = $categories->map(function ($category) {
                        return $category->translate('ka')->name ?? $category->translate('en')->name ?? 'Unknown Category';
                    })->unique()->values();

                    return [
                        'id' => $restaurant->id,
                        'name' => $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Unknown Restaurant',
                        'slug' => $restaurant->slug,
                        'logo' => $restaurant->logo,
                        'status' => $restaurant->status,
                        'address' => $restaurant->translate('ka')->address ?? $restaurant->translate('en')->address,
                        'phone' => $restaurant->phone,
                        'email' => $restaurant->email,
                        'menu_categories' => $menuCategoryNames->toArray(),
                        'menu_categories_count' => $menuCategoryNames->count(),
                    ];
                });

                $allRestaurants = $allRestaurants->merge($restaurants);

                $dishesData[] = [
                    'id' => $dish->id,
                    'name' => $dish->translate('ka')->name ?? $dish->translate('en')->name ?? 'Unknown Dish',
                    'slug' => $dish->slug,
                    'image' => $dish->image,
                    'restaurants_count' => $restaurants->count(),
                ];
            }

            // Remove duplicate restaurants
            $uniqueRestaurants = $allRestaurants->unique('id')->values();

            return response()->json([
                'success' => true,
                'search_term' => $dishName,
                'dishes' => $dishesData,
                'restaurants' => $uniqueRestaurants,
                'total_dishes' => count($dishesData),
                'total_restaurants' => $uniqueRestaurants->count(),
                'message' => "Found {$uniqueRestaurants->count()} restaurants across " . count($dishesData) . " dish categories matching '{$dishName}'"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error searching restaurants by dish name',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
