<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantDetailsResource;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantShortResource;
use App\Http\Resources\Place\PlaceResource;
use App\Http\Resources\Table\TableResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RestaurantController extends Controller
{
    // Get all restaurants with pagination
    public function index()
    {
        try {
            $restaurants = Restaurant::where('status', 'active')
                ->orderBy('rank', 'asc')
                ->paginate(12);

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No Restaurants found'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Get restaurant details by slug
    public function show(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
            return RestaurantResource::make($restaurant);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Restaurant', 'message' => $e->getMessage()], 500);
        }
    }


    public function showByPlaces(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->with('places')
                ->firstOrFail();

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantResource::make($restaurant),
                    'places' => PlaceResource::collection($restaurant->places)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Restaurant', 'message' => $e->getMessage()], 500);
        }
    }

    // Get restaurant details by slug with places
    public function showByTables(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->with('tables')
                ->firstOrFail();

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantResource::make($restaurant),
                    'tables' => TableResource::collection($restaurant->tables)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Restaurant', 'message' => $e->getMessage()], 500);
        }
    }


    // Get restaurant details by slug with places and tables
    public function showDetails(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->with(['places.tables', 'tables'])
                ->firstOrFail();

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantResource::make($restaurant),
                    'places' => PlaceResource::collection($restaurant->places),
                    'tables' => TableResource::collection($restaurant->tables),
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Restaurant', 'message' => $e->getMessage()], 500);
        }
    }
}
