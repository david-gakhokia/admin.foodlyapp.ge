<?php

namespace App\Http\Controllers\Api;

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

class SpaceController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $query = Space::query()->with('translations');

        // Filtering
        if ($status = $request->input('filter.status')) {
            $query->where('status', $status);
        }

        // Searching
        if ($search = $request->input('search')) {
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Sorting
        if ($sort = $request->input('sort')) {
            $direction = 'asc';
            if (str_starts_with($sort, '-')) {
                $direction = 'desc';
                $sort = ltrim($sort, '-');
            }
            if (in_array($sort, ['slug', 'status', 'rank'])) {
                $query->orderBy($sort, $direction);
            }
        }

        // Pagination
        $spaces = $query->paginate(
            $request->input('per_page', 15)
        );

        return response()->json($spaces);
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



    // Get restaurants by Space slug
    public function restaurantsBySpace($slug)
    {
        try {
            $space = Space::where('slug', $slug)->firstOrFail();

            $restaurants = $space->restaurants()
                ->where('status', 1)
                ->orderBy('rank', 'asc')
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

    // Get top 10 restaurants by Space slug
    public function top10RestaurantsBySpace($slug)
    {
        try {
            $space = Space::where('slug', $slug)->firstOrFail();

            $restaurants = $space->restaurants()
                ->where('status', 1)
                ->orderBy('rank', 'asc')
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
