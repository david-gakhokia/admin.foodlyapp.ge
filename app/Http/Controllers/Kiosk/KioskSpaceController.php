<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Space\StoreSpaceRequest;
use App\Http\Requests\Space\UpdateSpaceRequest;
use App\Models\Space;
use App\Models\Restaurant;
use App\Services\SpaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\RestaurantShortResource;
use App\Http\Resources\Space\SpaceResource;
use App\Http\Resources\Space\SpaceShortResource;

class KioskSpaceController extends Controller
{

    // Get all Spaces with pagination
    public function index()
    {
        try {
            $spaces = Space::where('status', 'active')
                ->orderBy('rank', 'asc')
                ->paginate(12);

            if ($spaces->isEmpty()) {
                return response()->json(['error' => 'No Space found'], 404);
            }

            return SpaceShortResource::collection($spaces);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // 2. Get a single cuisine by slug
    public function showBySlug($slug)
    {
        try {
            $space = Space::where('slug', $slug)->firstOrFail();
            return new SpaceResource($space);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cuisine not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch cuisine',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Get restaurants by Space slug
    public function restaurantsBySpace($slug)
    {
        try {
            $space = Space::where('slug', $slug)->firstOrFail();

            $restaurants = $space->restaurants()
                ->where('restaurants.status', 'active')
                ->orderBy('restaurant_space.rank', 'asc')
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this space'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Space not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function store(StoreSpaceRequest $request, SpaceService $spaceService): JsonResponse
    {
        try {
            // Process the validated data
            $space = $spaceService->create($request->validatedData());

            // Return a successful response
            return response()->json($space, 201);
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json([
                'error' => 'Failed to create space',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public function update(UpdateSpaceRequest $request, string $slug, SpaceService $spaceService): JsonResponse
    {
        $space = Space::where('slug', $slug)->firstOrFail();

        $space = $spaceService->update($space, $request->validatedData());

        return response()->json($space->refresh(), 200);
    }


    public function destroy(string $slug): JsonResponse
    {
        $space = Space::where('slug', $slug)->firstOrFail();
        $space->delete();

        return response()->json(['message' => 'Space deleted successfully'], 200);
    }




    // Get top 10 restaurants by Space slug
    public function top10RestaurantsBySpace($slug)
    {
        try {
            $space = Space::where('slug', $slug)->firstOrFail();

            $restaurants = $space->restaurants()
                ->where('restaurants.status', 'active')
                ->orderBy('restaurant_space.rank', 'asc')
                ->take(10)
                ->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found for this space'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Space not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurants',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
