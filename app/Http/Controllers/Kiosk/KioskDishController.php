<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dish\DishResource;
use App\Http\Resources\Dish\DishShortResource;
use App\Http\Resources\RestaurantShortResource;
use App\Http\Resources\Menu\RestaurantCategoryItemsResource;
use App\Http\Resources\CategoryResource;
use App\Models\Dish;
use App\Models\MenuCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class KioskDishController extends Controller
{
    // 1. Get all Dishes
    public function index()
    {
        try {
            $dishes = Dish::with(['menuCategories.translations'])->get();
            // ->where('status', 1)
            // ->orderBy('rank', 'asc')
            // ->paginate(12);

            if ($dishes->isEmpty()) {
                return response()->json(['error' => 'No Dish found'], 404);
            }

            return DishShortResource::collection($dishes);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Dishes',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // 2. Get a single Dish by slug
    public function showBySlug($slug)
    {
        try {
            $dish = Dish::with(['menuCategories.translations'])->where('slug', $slug)->firstOrFail();
            return new DishResource($dish);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Dish not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Dish',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // 3. Get restaurants by dish
    public function restaurantsByDish($slug)
    {
        try {
            $dish = Dish::where('slug', $slug)->firstOrFail();

            $restaurants = $dish->restaurants()
                ->where('restaurants.status', 'active')
                ->orderBy('restaurant_dish.rank', 'asc')
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this dish'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Dish not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    // 4. Get top 10 restaurants by Dish
    public function top10RestaurantsByDish($slug)
    {
        try {
            $dish = Dish::where('slug', $slug)->firstOrFail();

            $restaurants = $dish->restaurants()
                ->where('restaurants.status', 'active')
                ->orderBy('restaurant_dish.rank', 'asc')
                ->take(10)
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this dish'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Dish not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 5. Get restaurants with category items
    public function restaurantsWithCategoryItems($categorySlug)
    {
        try {
            // მოიძებნოს კატეგორია
            $category = MenuCategory::where('slug', $categorySlug)->firstOrFail();

            // მოიძებნოს ყველა რესტორანი, რომელსაც ამ კატეგორიის პროდუქტები აქვს
            $restaurants = Restaurant::whereHas('menuItems', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })
                ->with(['menuItems' => function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                }])
                ->where('status', 'active')
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this category'], 404);
            }

            return RestaurantCategoryItemsResource::collection($restaurants)
                ->additional(['category' => new CategoryResource($category)]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
