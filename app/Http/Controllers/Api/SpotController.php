<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Spot\SpotResource;
use App\Http\Resources\RestaurantShortResource;
use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SpotController extends Controller
{
    /**
     * Get all active spots with pagination
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12);
            $perPage = min($perPage, 100); // Max 100 per page
            
            $spots = Spot::where('status', 'active')
                ->with('translations')
                ->orderBy('rank', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            if ($spots->isEmpty()) {
                return response()->json([
                    'message' => 'No spots found',
                    'data' => []
                ], 404);
            }

            return SpotResource::collection($spots);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch spots',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all spots without pagination (for dropdowns, etc.)
     */
    public function all()
    {
        try {
            $spots = Spot::where('status', 'active')
                ->with('translations')
                ->orderBy('rank', 'asc')
                ->get();

            return SpotResource::collection($spots);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch spots',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single spot by ID
     */
    public function show(Spot $spot)
    {
        try {
            if ($spot->status !== 'active') {
                return response()->json(['error' => 'Spot not available'], 404);
            }

            $spot->load('translations');
            return new SpotResource($spot);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch spot',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single spot by slug
     */
    public function showBySlug($slug)
    {
        try {
            $spot = Spot::where('slug', $slug)
                ->where('status', 'active')
                ->with('translations')
                ->firstOrFail();

            return new SpotResource($spot);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Spot not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch spot',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get restaurants by spot ID
     */
    public function restaurants(Spot $spot, Request $request)
    {
        try {
            if ($spot->status !== 'active') {
                return response()->json(['error' => 'Spot not available'], 404);
            }

            $perPage = $request->get('per_page', 12);
            $perPage = min($perPage, 100);

            $restaurants = $spot->restaurants()
                ->wherePivot('status', 'active')
                ->where('restaurants.status', 'active')
                ->with('translations')
                ->orderBy('restaurant_spot.rank', 'asc')
                ->paginate($perPage);

            if ($restaurants->isEmpty()) {
                return response()->json([
                    'message' => 'No restaurants found for this spot',
                    'data' => []
                ], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get restaurants by spot slug
     */
    public function restaurantsBySlug($slug, Request $request)
    {
        try {
            $spot = Spot::where('slug', $slug)
                ->where('status', 'active')
                ->firstOrFail();

            $perPage = $request->get('per_page', 12);
            $perPage = min($perPage, 100);

            $restaurants = $spot->restaurants()
                ->wherePivot('status', 'active')
                ->where('restaurants.status', 'active')
                ->with('translations')
                ->orderBy('restaurant_spot.rank', 'asc')
                ->paginate($perPage);

            if ($restaurants->isEmpty()) {
                return response()->json([
                    'message' => 'No restaurants found for this spot',
                    'data' => []
                ], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Spot not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get top restaurants by spot ID (limit 10)
     */
    public function topRestaurants(Spot $spot)
    {
        try {
            if ($spot->status !== 'active') {
                return response()->json(['error' => 'Spot not available'], 404);
            }

            $restaurants = $spot->restaurants()
                ->wherePivot('status', 'active')
                ->where('restaurants.status', 'active')
                ->with('translations')
                ->orderBy('restaurant_spot.rank', 'asc')
                ->limit(10)
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json([
                    'message' => 'No restaurants found for this spot',
                    'data' => []
                ], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch top restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get top restaurants by spot slug (limit 10)
     */
    public function topRestaurantsBySlug($slug)
    {
        try {
            $spot = Spot::where('slug', $slug)
                ->where('status', 'active')
                ->firstOrFail();

            $restaurants = $spot->restaurants()
                ->wherePivot('status', 'active')
                ->where('restaurants.status', 'active')
                ->with('translations')
                ->orderBy('restaurant_spot.rank', 'asc')
                ->limit(10)
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json([
                    'message' => 'No restaurants found for this spot',
                    'data' => []
                ], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Spot not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch top restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search spots by name
     */
    public function search(Request $request)
    {
        try {
            $query = $request->get('q', '');
            $perPage = $request->get('per_page', 12);
            $perPage = min($perPage, 100);

            if (empty($query)) {
                return response()->json([
                    'error' => 'Search query is required',
                    'message' => 'Please provide a search term'
                ], 400);
            }

            $spots = Spot::where('status', 'active')
                ->whereHas('translations', function($translationQuery) use ($query) {
                    $translationQuery->where('name', 'like', "%{$query}%");
                })
                ->with('translations')
                ->orderBy('rank', 'asc')
                ->paginate($perPage);

            if ($spots->isEmpty()) {
                return response()->json([
                    'message' => 'No spots found matching your search',
                    'data' => []
                ], 404);
            }

            return SpotResource::collection($spots);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Search failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
