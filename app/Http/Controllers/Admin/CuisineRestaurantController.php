<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuisine;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class CuisineRestaurantController extends Controller
{
    /**
     * 📋 Cuisine-ის ყველა restaurant-ის ჩვენება (Admin View)
     */
    public function index(Cuisine $cuisine)
    {
        $restaurants = $cuisine->restaurants()
            ->withPivot('rank', 'status', 'created_at')
            ->orderBy('pivot_rank', 'asc')
            ->get();

        $availableRestaurants = Restaurant::whereNotIn('id', $restaurants->pluck('id'))
            ->where('status', 'active')
            ->orderBy('rank', 'asc')
            ->get();

        return view('admin.cuisines.restaurants.index', compact(
            'cuisine', 
            'restaurants', 
            'availableRestaurants'
        ));
    }

    /**
     * 📝 Restaurant დამატების ფორმა
     */
    public function create(Cuisine $cuisine)
    {
        $restaurants = Restaurant::whereNotIn('id', 
            $cuisine->restaurants()->pluck('restaurant_id')
        )
        ->where('status', 'active')
        ->orderBy('rank', 'asc')
        ->get();

        return view('admin.cuisines.restaurants.create', compact('cuisine', 'restaurants'));
    }

    /**
     * ➕ Cuisine-ისთვის restaurant-ის დამატება
     */
    public function store(Request $request, Cuisine $cuisine)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // შეამოწმე თუ უკვე არსებობს ეს კავშირი
        if ($cuisine->restaurants()->where('restaurant_id', $request->restaurant_id)->exists()) {
            return redirect()->back()->withErrors([
                'restaurant_id' => 'ეს restaurant უკვე დამატებულია ამ cuisine-ისთვის.'
            ]);
        }

        try {
            DB::transaction(function () use ($request, $cuisine) {
                $cuisine->restaurants()->attach($request->restaurant_id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.cuisines.restaurants.index', $cuisine)
                ->with('success', 'Restaurant წარმატებით დაემატა cuisine-ს!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ✏️ Cuisine-Restaurant კავშირის რედაქტირების ფორმა
     */
    public function edit(Cuisine $cuisine, Restaurant $restaurant)
    {
        $restaurantWithPivot = $cuisine->restaurants()
            ->where('restaurant_id', $restaurant->id)
            ->withPivot('rank', 'status', 'created_at')
            ->first();

        if (!$restaurantWithPivot) {
            return redirect()
                ->route('admin.cuisines.restaurants.index', $cuisine)
                ->withErrors(['error' => 'ეს restaurant არ არის დაკავშირებული ამ cuisine-თან.']);
        }

        return view('admin.cuisines.restaurants.edit', [
            'cuisine' => $cuisine,
            'restaurant' => $restaurantWithPivot
        ]);
    }

    /**
     * 🔄 Cuisine-ის restaurant კავშირის განახლება
     */
    public function update(Request $request, Cuisine $cuisine, Restaurant $restaurant)
    {
        $request->validate([
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // შეამოწმე თუ კავშირი არსებობს
        if (!$cuisine->restaurants()->where('restaurant_id', $restaurant->id)->exists()) {
            return redirect()
                ->route('admin.cuisines.restaurants.index', $cuisine)
                ->withErrors(['error' => 'ეს restaurant არ არის დაკავშირებული ამ cuisine-თან.']);
        }

        try {
            DB::transaction(function () use ($request, $cuisine, $restaurant) {
                $cuisine->restaurants()->updateExistingPivot($restaurant->id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.cuisines.restaurants.index', $cuisine)
                ->with('success', 'Restaurant კავშირი წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ❌ Cuisine-დან restaurant-ის წაშლა
     */
    public function destroy(Cuisine $cuisine, Restaurant $restaurant)
    {
        if (!$cuisine->restaurants()->where('restaurant_id', $restaurant->id)->exists()) {
            return redirect()
                ->route('admin.cuisines.restaurants.index', $cuisine)
                ->withErrors(['error' => 'ეს restaurant არ არის დაკავშირებული ამ cuisine-თან.']);
        }

        try {
            DB::transaction(function () use ($cuisine, $restaurant) {
                $cuisine->restaurants()->detach($restaurant->id);
            });

            return redirect()
                ->route('admin.cuisines.restaurants.index', $cuisine)
                ->with('success', 'Restaurant წარმატებით წაიშალა cuisine-დან!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * 🔄 Multiple restaurants-ების bulk management
     */
    public function bulkUpdate(Request $request, Cuisine $cuisine)
    {
        $request->validate([
            'restaurants' => 'required|array',
            'restaurants.*.restaurant_id' => 'required|exists:restaurants,id',
            'restaurants.*.rank' => 'nullable|integer|min:0',
            'restaurants.*.status' => 'required|in:active,inactive',
        ]);

        try {
            DB::transaction(function () use ($request, $cuisine) {
                $syncData = [];
                foreach ($request->restaurants as $restaurant) {
                    $syncData[$restaurant['restaurant_id']] = [
                        'rank' => $restaurant['rank'] ?? 0,
                        'status' => $restaurant['status'],
                    ];
                }
                $cuisine->restaurants()->sync($syncData);
            });

            return redirect()
                ->route('admin.cuisines.restaurants.index', $cuisine)
                ->with('success', 'Restaurants წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }
}
