<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Support\Facades\DB;

class RestaurantDishController extends Controller
{
    /**
     * 📋 Restaurant-ის ყველა dish-ის ჩვენება (Admin View)
     */
    public function index(Restaurant $restaurant)
    {
        $dishes = $restaurant->dishes()
            ->withPivot('rank', 'status', 'created_at')
            ->orderBy('pivot_rank', 'asc')
            ->get();

        $availableDishes = Dish::whereNotIn('id', $dishes->pluck('id'))
            ->where('status', 'active')
            ->orderBy('rank', 'asc')
            ->get();

        return view('admin.restaurants.dishes.index', compact(
            'restaurant', 
            'dishes', 
            'availableDishes'
        ));
    }

    /**
     * 📝 Dish დამატების ფორმა
     */
    public function create(Restaurant $restaurant)
    {
        $dishes = Dish::whereNotIn('id', 
            $restaurant->dishes()->pluck('dish_id')
        )
        ->where('status', 'active')
        ->orderBy('rank', 'asc')
        ->get();

        return view('admin.restaurants.dishes.create', compact('restaurant', 'dishes'));
    }

    /**
     * 💾 ახალი Restaurant-Dish კავშირის შენახვა
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'dish_id' => 'required|exists:dishes,id',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // შეამოწმე თუ კავშირი არ არსებობს
        if ($restaurant->dishes()->where('dish_id', $request->dish_id)->exists()) {
            return redirect()->back()->withErrors([
                'dish_id' => 'ეს dish უკვე დამატებულია ამ restaurant-ში.'
            ]);
        }

        try {
            DB::transaction(function () use ($request, $restaurant) {
                $restaurant->dishes()->attach($request->dish_id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.restaurants.dishes.index', $restaurant)
                ->with('success', 'Dish წარმატებით დაემატა restaurant-ს!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ✏️ Restaurant-Dish კავშირის რედაქტირების ფორმა
     */
    public function edit(Restaurant $restaurant, Dish $dish)
    {
        $dishWithPivot = $restaurant->dishes()
            ->where('dish_id', $dish->id)
            ->withPivot('rank', 'status', 'created_at')
            ->first();

        if (!$dishWithPivot) {
            return redirect()
                ->route('admin.restaurants.dishes.index', $restaurant)
                ->withErrors(['error' => 'ეს dish არ არის დაკავშირებული ამ restaurant-თან.']);
        }

        return view('admin.restaurants.dishes.edit', [
            'restaurant' => $restaurant,
            'dish' => $dishWithPivot
        ]);
    }

    /**
     * 🔄 Restaurant-ის dish კავშირის განახლება
     */
    public function update(Request $request, Restaurant $restaurant, Dish $dish)
    {
        $request->validate([
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // შეამოწმე თუ კავშირი არსებობს
        if (!$restaurant->dishes()->where('dish_id', $dish->id)->exists()) {
            return redirect()
                ->route('admin.restaurants.dishes.index', $restaurant)
                ->withErrors(['error' => 'ეს dish არ არის დაკავშირებული ამ restaurant-თან.']);
        }

        try {
            DB::transaction(function () use ($request, $restaurant, $dish) {
                $restaurant->dishes()->updateExistingPivot($dish->id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.restaurants.dishes.index', $restaurant)
                ->with('success', 'Dish კავშირი წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ❌ Restaurant-დან dish-ის წაშლა
     */
    public function destroy(Restaurant $restaurant, Dish $dish)
    {
        try {
            DB::transaction(function () use ($restaurant, $dish) {
                $restaurant->dishes()->detach($dish->id);
            });

            return redirect()
                ->route('admin.restaurants.dishes.index', $restaurant)
                ->with('success', 'Dish წარმატებით ამოიშალა restaurant-იდან!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * 🔄 მრავალი კავშირის ერთდროული განახლება
     */
    public function bulkUpdate(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'dishes' => 'required|array',
            'dishes.*.dish_id' => 'required|exists:dishes,id',
            'dishes.*.rank' => 'nullable|integer|min:0',
            'dishes.*.status' => 'required|in:active,inactive,pending',
        ]);

        try {
            DB::transaction(function () use ($request, $restaurant) {
                foreach ($request->dishes as $dishData) {
                    $restaurant->dishes()->updateExistingPivot($dishData['dish_id'], [
                        'rank' => $dishData['rank'] ?? 0,
                        'status' => $dishData['status'],
                    ]);
                }
            });

            return redirect()
                ->route('admin.restaurants.dishes.index', $restaurant)
                ->with('success', 'Dishes წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }
}
