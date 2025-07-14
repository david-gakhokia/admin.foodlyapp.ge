<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\City\CityResource;
use App\Http\Resources\City\CityShortResource;
use App\Http\Resources\RestaurantShortResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CityController extends Controller
{
    // 1. Get all cities
    public function index()
    {
        try {
            $cities = City::where('status', '1')
                ->orderBy('rank', 'asc')
                ->paginate(12);

            if ($cities->isEmpty()) {
                return response()->json(['error' => 'No cities found'], 404);
            }

            return CityShortResource::collection($cities);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch cities',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 2. Get a single city by slug
    public function showBySlug($slug)
    {
        try {
            $city = City::where('slug', $slug)->firstOrFail();
            return CityResource::make($city);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'City not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch city',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 3. Get restaurants by city slug
    public function restaurantsByCity($slug)
    {
        try {
            $city = City::where('slug', $slug)->firstOrFail();

            $restaurants = $city->restaurants()
                ->where('status', '1')
                ->orderBy('rank', 'asc')
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this city'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'City not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 4. Get top 10 restaurants by city slug
    public function top10RestaurantsByCity($slug)
    {
        try {
            $city = City::where('slug', $slug)->firstOrFail();

            $restaurants = $city->restaurants()
                ->where('status', '1')
                ->orderBy('rank', 'asc')
                ->take(10)
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this city'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'City not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
