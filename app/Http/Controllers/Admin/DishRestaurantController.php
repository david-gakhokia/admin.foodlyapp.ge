<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class DishRestaurantController extends Controller
{
    /**
     * 📋 Dish-ის ყველა restaurant-ის ჩვენება (Admin View)
     */
    public function index(Dish $dish)
    {
        $restaurants = $dish->restaurants()
            ->withPivot('rank', 'status', 'created_at')
            ->orderBy('pivot_rank', 'asc')
            ->get();

        $availableRestaurants = Restaurant::whereNotIn('id', $restaurants->pluck('id'))
            ->where('status', 'active')
            ->orderBy('rank', 'asc')
            ->get();

        return view('admin.dishes.restaurants.index', compact(
            'dish', 
            'restaurants', 
            'availableRestaurants'
        ));
    }

    /**
     * 📝 Restaurant დამატების ფორმა
     */
    public function create(Dish $dish)
    {
        $restaurants = Restaurant::whereNotIn('id', 
            $dish->restaurants()->pluck('restaurant_id')
        )
        ->where('status', 'active')
        ->orderBy('rank', 'asc')
        ->get();

        return view('admin.dishes.restaurants.create', compact('dish', 'restaurants'));
    }

    /**
     * 💾 ახალი Dish-Restaurant კავშირის შენახვა
     */
    public function store(Request $request, Dish $dish)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // შეამოწმე თუ კავშირი არ არსებობს
        if ($dish->restaurants()->where('restaurant_id', $request->restaurant_id)->exists()) {
            return redirect()->back()->withErrors([
                'restaurant_id' => 'ეს restaurant უკვე დამატებულია ამ dish-ში.'
            ]);
        }

        try {
            DB::transaction(function () use ($request, $dish) {
                $dish->restaurants()->attach($request->restaurant_id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.dishes.restaurants.index', $dish)
                ->with('success', 'Restaurant წარმატებით დაემატა dish-ს!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ✏️ Dish-Restaurant კავშირის რედაქტირების ფორმა
     */
    public function edit(Dish $dish, Restaurant $restaurant)
    {
        $restaurantWithPivot = $dish->restaurants()
            ->where('restaurant_id', $restaurant->id)
            ->withPivot('rank', 'status', 'created_at')
            ->first();

        if (!$restaurantWithPivot) {
            return redirect()
                ->route('admin.dishes.restaurants.index', $dish)
                ->withErrors(['error' => 'ეს restaurant არ არის დაკავშირებული ამ dish-თან.']);
        }

        return view('admin.dishes.restaurants.edit', [
            'dish' => $dish,
            'restaurant' => $restaurantWithPivot
        ]);
    }

    /**
     * 🔄 Dish-ის restaurant კავშირის განახლება
     */
    public function update(Request $request, Dish $dish, Restaurant $restaurant)
    {
        $request->validate([
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // შეამოწმე თუ კავშირი არსებობს
        if (!$dish->restaurants()->where('restaurant_id', $restaurant->id)->exists()) {
            return redirect()
                ->route('admin.dishes.restaurants.index', $dish)
                ->withErrors(['error' => 'ეს restaurant არ არის დაკავშირებული ამ dish-თან.']);
        }

        try {
            DB::transaction(function () use ($request, $dish, $restaurant) {
                $dish->restaurants()->updateExistingPivot($restaurant->id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.dishes.restaurants.index', $dish)
                ->with('success', 'Restaurant კავშირი წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ❌ Dish-დან restaurant-ის წაშლა
     */
    public function destroy(Dish $dish, Restaurant $restaurant)
    {
        try {
            DB::transaction(function () use ($dish, $restaurant) {
                $dish->restaurants()->detach($restaurant->id);
            });

            return redirect()
                ->route('admin.dishes.restaurants.index', $dish)
                ->with('success', 'Restaurant წარმატებით ამოიშალა dish-იდან!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * 🔄 მრავალი კავშირის ერთდროული განახლება
     */
    public function bulkUpdate(Request $request, Dish $dish)
    {
        $request->validate([
            'restaurants' => 'required|array',
            'restaurants.*.restaurant_id' => 'required|exists:restaurants,id',
            'restaurants.*.rank' => 'nullable|integer|min:0',
            'restaurants.*.status' => 'required|in:active,inactive,pending',
        ]);

        try {
            DB::transaction(function () use ($request, $dish) {
                foreach ($request->restaurants as $restaurantData) {
                    $dish->restaurants()->updateExistingPivot($restaurantData['restaurant_id'], [
                        'rank' => $restaurantData['rank'] ?? 0,
                        'status' => $restaurantData['status'],
                    ]);
                }
            });

            return redirect()
                ->route('admin.dishes.restaurants.index', $dish)
                ->with('success', 'Restaurants წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }
}
