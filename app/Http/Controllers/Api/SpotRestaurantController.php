<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spot;
use App\Models\Restaurant;

class SpotRestaurantController extends Controller
{
    // ➕ დაამატე რესტორანი spot-ს
    public function attach(Request $request, Spot $spot)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'rank' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $spot->restaurants()->syncWithoutDetaching([
            $request->restaurant_id => [
                'rank' => $request->rank ?? 0,
                'status' => $request->status ?? true,
            ]
        ]);

        return response()->json(['message' => 'Restaurant linked to spot']);
    }

    // ✏️ განაახლე რელაცია
    public function updatePivot(Request $request, Spot $spot, $restaurantId)
    {
        $request->validate([
            'rank' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $spot->restaurants()->updateExistingPivot($restaurantId, $request->only('rank', 'status'));

        return response()->json(['message' => 'Spot-restaurant link updated']);
    }

    // ❌ წაშლა
    public function detach(Spot $spot, $restaurantId)
    {
        $spot->restaurants()->detach($restaurantId);

        return response()->json(['message' => 'Restaurant removed from spot']);
    }
}
