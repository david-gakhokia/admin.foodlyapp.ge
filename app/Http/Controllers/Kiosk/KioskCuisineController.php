<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cuisine\CuisineResource;
use App\Http\Resources\Cuisine\CuisineShortResource;
use App\Http\Resources\RestaurantShortResource;
use App\Models\Cuisine;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KioskCuisineController extends Controller
{
    // 1. Get all cuisines
    public function index()
    {
        try {
            $cuisines = Cuisine::get();
                // ->where('status', 1)
                // ->orderBy('rank', 'asc')
                // ->paginate(12);

            if ($cuisines->isEmpty()) {
                return response()->json(['error' => 'No cuisines found'], 404);
            }

            return CuisineShortResource::collection($cuisines);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch cuisines',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 2. Get a single cuisine by slug
    public function showBySlug($slug)
    {
        try {
            $cuisine = Cuisine::where('slug', $slug)->firstOrFail();
            return new CuisineResource($cuisine);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cuisine not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch cuisine',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 3. Get restaurants by cuisine
    public function restaurantsByCuisine($slug)
    {
        try {
            $cuisine = Cuisine::where('slug', $slug)->firstOrFail();

            $restaurants = $cuisine->restaurants()   
                // ->orderBy('rank', 'asc')
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this cuisine'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cuisine not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 4. Get top 10 restaurants by cuisine
    public function top10RestaurantsByCuisine($slug)
    {
        try {
            $cuisine = Cuisine::where('slug', $slug)->firstOrFail();

            $restaurants = $cuisine->restaurants()
                // ->where('status', 1)
                // ->orderBy('rank', 'asc')
                ->take(10)
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this cuisine'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cuisine not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
