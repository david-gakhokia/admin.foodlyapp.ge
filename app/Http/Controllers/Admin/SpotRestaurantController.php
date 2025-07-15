<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spot;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class SpotRestaurantController extends Controller
{
    /**
     * 📋 Spot-ის ყველა restaurant-ის ჩვენება (Admin View)
     */
    public function index(Spot $spot)
    {
        $restaurants = $spot->restaurants()
            ->withPivot('rank', 'status', 'created_at')
            ->orderBy('pivot_rank', 'asc')
            ->get();

        $availableRestaurants = Restaurant::whereNotIn('id', $restaurants->pluck('id'))
            ->where('status', 'active')
            ->orderBy('rank', 'asc')
            ->get();

        return view('admin.spots.restaurants.index', compact(
            'spot', 
            'restaurants', 
            'availableRestaurants'
        ));
    }

    /**
     * 🆕 რესტორნის დამატების ფორმის ჩვენება
     */
    public function create(Spot $spot)
    {
        $availableRestaurants = Restaurant::whereNotIn('id', $spot->restaurants()->pluck('restaurants.id'))
            ->where('status', 'active')
            ->orderBy('rank', 'asc')
            ->get();

        $totalRestaurants = Restaurant::count();

        return view('admin.spots.restaurants.create', compact('spot', 'availableRestaurants', 'totalRestaurants'));
    }

    /**
     * ✅ რესტორნის დამატება Spot-თან
     */
    public function store(Request $request, Spot $spot)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'rank' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean'
        ]);

        // Check if already exists
        if ($spot->restaurants()->where('restaurant_id', $request->restaurant_id)->exists()) {
            return redirect()->back()->with('error', 'Restaurant is already linked to this spot.');
        }

        $spot->restaurants()->attach($request->restaurant_id, [
            'rank' => $request->rank ?? 0,
            'status' => $request->status ?? true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $restaurant = Restaurant::find($request->restaurant_id);

        return redirect()->route('admin.spots.restaurants.index', $spot)
            ->with('success', "Restaurant '{$restaurant->name}' successfully linked to spot '{$spot->name}'.");
    }

    /**
     * ✏️ რესტორნის რედაქტირების ფორმის ჩვენება
     */
    public function edit(Spot $spot, Restaurant $restaurant)
    {
        $pivotData = $spot->restaurants()->where('restaurant_id', $restaurant->id)->first()->pivot;
        
        // Get other restaurants' ranks in this spot for context
        $otherRanks = $spot->restaurants()
            ->where('restaurant_id', '!=', $restaurant->id)
            ->pluck('pivot_rank')
            ->filter()
            ->sort();

        return view('admin.spots.restaurants.edit', compact('spot', 'restaurant', 'pivotData', 'otherRanks'));
    }

    /**
     * 🔄 რესტორნის მონაცემების განახლება
     */
    public function update(Request $request, Spot $spot, Restaurant $restaurant)
    {
        $request->validate([
            'rank' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean'
        ]);

        $spot->restaurants()->updateExistingPivot($restaurant->id, [
            'rank' => $request->rank ?? 0,
            'status' => $request->status ?? true,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.spots.restaurants.index', $spot)
            ->with('success', "Restaurant '{$restaurant->name}' successfully updated.");
    }

    /**
     * 🗑️ რესტორნის წაშლა Spot-დან
     */
    public function destroy(Spot $spot, Restaurant $restaurant)
    {
        $spot->restaurants()->detach($restaurant->id);

        return redirect()->route('admin.spots.restaurants.index', $spot)
            ->with('success', "Restaurant '{$restaurant->name}' successfully removed from spot '{$spot->name}'.");
    }

    /**
     * 🔄 ყველა რესტორნის bulk განახლება
     */
    public function bulkUpdate(Request $request, Spot $spot)
    {
        $request->validate([
            'restaurants' => 'required|array',
            'restaurants.*.id' => 'required|exists:restaurants,id',
            'restaurants.*.rank' => 'nullable|integer|min:0',
            'restaurants.*.status' => 'nullable|boolean'
        ]);

        DB::transaction(function () use ($request, $spot) {
            foreach ($request->restaurants as $restaurantData) {
                $spot->restaurants()->updateExistingPivot($restaurantData['id'], [
                    'rank' => $restaurantData['rank'] ?? 0,
                    'status' => $restaurantData['status'] ?? true,
                    'updated_at' => now()
                ]);
            }
        });

        return redirect()->route('admin.spots.restaurants.index', $spot)
            ->with('success', 'All restaurants successfully updated.');
    }
}
