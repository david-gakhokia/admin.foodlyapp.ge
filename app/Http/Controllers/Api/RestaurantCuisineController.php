<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Cuisine;
use App\Http\Resources\Cuisine\CuisineResource;

class RestaurantCuisineController extends Controller
{
    /**
     * 📋 რესტორნის ყველა cuisine-ის ჩვენება
     */
    public function index(Restaurant $restaurant)
    {
        try {
            $cuisines = $restaurant->cuisines()
                ->withPivot('rank', 'status')
                ->orderBy('pivot_rank', 'asc')
                ->get();

            return CuisineResource::collection($cuisines);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch restaurant cuisines',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ➕ რესტორნისთვის cuisine-ის დამატება
     */
    public function attach(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'cuisine_id' => 'required|exists:cuisines,id',
            'rank' => 'nullable|integer|min:0',
            'status' => 'nullable|in:active,inactive',
        ]);

        // შეამოწმე თუ უკვე არსებობს ეს კავშირი
        if ($restaurant->cuisines()->where('cuisine_id', $request->cuisine_id)->exists()) {
            return response()->json([
                'error' => 'This cuisine is already linked to this restaurant'
            ], 422);
        }

        $restaurant->cuisines()->attach($request->cuisine_id, [
            'rank' => $request->rank ?? 0,
            'status' => $request->status ?? 'active',
        ]);

        return response()->json([
            'message' => 'Cuisine successfully linked to restaurant',
            'data' => [
                'restaurant_id' => $restaurant->id,
                'cuisine_id' => $request->cuisine_id,
                'rank' => $request->rank ?? 0,
                'status' => $request->status ?? 'active'
            ]
        ], 201);
    }

    /**
     * ✏️ რესტორნის cuisine კავშირის განახლება
     */
    public function update(Request $request, Restaurant $restaurant, Cuisine $cuisine)
    {
        $request->validate([
            'rank' => 'nullable|integer|min:0',
            'status' => 'nullable|in:active,inactive',
        ]);

        // შეამოწმე თუ კავშირი არსებობს
        if (!$restaurant->cuisines()->where('cuisine_id', $cuisine->id)->exists()) {
            return response()->json([
                'error' => 'This cuisine is not linked to this restaurant'
            ], 404);
        }

        $restaurant->cuisines()->updateExistingPivot($cuisine->id, [
            'rank' => $request->rank,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Restaurant-cuisine link updated successfully',
            'data' => [
                'restaurant_id' => $restaurant->id,
                'cuisine_id' => $cuisine->id,
                'rank' => $request->rank,
                'status' => $request->status
            ]
        ]);
    }

    /**
     * ❌ რესტორნიდან cuisine-ის წაშლა
     */
    public function detach(Restaurant $restaurant, Cuisine $cuisine)
    {
        if (!$restaurant->cuisines()->where('cuisine_id', $cuisine->id)->exists()) {
            return response()->json([
                'error' => 'This cuisine is not linked to this restaurant'
            ], 404);
        }

        $restaurant->cuisines()->detach($cuisine->id);

        return response()->json([
            'message' => 'Cuisine successfully unlinked from restaurant'
        ]);
    }

    /**
     * 🔄 რესტორნის cuisine-ების bulk update
     */
    public function sync(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'cuisines' => 'required|array',
            'cuisines.*.cuisine_id' => 'required|exists:cuisines,id',
            'cuisines.*.rank' => 'nullable|integer|min:0',
            'cuisines.*.status' => 'nullable|in:active,inactive',
        ]);

        $syncData = [];
        foreach ($request->cuisines as $cuisine) {
            $syncData[$cuisine['cuisine_id']] = [
                'rank' => $cuisine['rank'] ?? 0,
                'status' => $cuisine['status'] ?? 'active',
            ];
        }

        $restaurant->cuisines()->sync($syncData);

        return response()->json([
            'message' => 'Restaurant cuisines synchronized successfully',
            'data' => $syncData
        ]);
    }
}
