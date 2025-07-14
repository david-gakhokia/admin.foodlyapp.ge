<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuisine;
use App\Models\Restaurant;

class CuisineRestaurantController extends Controller
{
    // ➕ დაამატე რესტორანი cuisine-ს
    public function attach(Request $request, Cuisine $cuisine)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'rank' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $cuisine->restaurants()->syncWithoutDetaching([
            $request->restaurant_id => [
                'rank' => $request->rank ?? 0,
                'status' => $request->status ?? true,
            ]
        ]);

        return response()->json(['message' => 'Restaurant linked']);
    }

    // ✏️ განაახლე რელაცია
    public function updatePivot(Request $request, Cuisine $cuisine, $restaurantId)
    {
        $request->validate([
            'rank' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $cuisine->restaurants()->updateExistingPivot($restaurantId, $request->only('rank', 'status'));

        return response()->json(['message' => 'Link updated']);
    }

    // ❌ წაშლა
    public function detach(Cuisine $cuisine, $restaurantId)
    {
        $cuisine->restaurants()->detach($restaurantId);

        return response()->json(['message' => 'Link removed']);
    }
}
