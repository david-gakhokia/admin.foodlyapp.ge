<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Cuisine;
use Illuminate\Support\Facades\DB;

class RestaurantCuisineController extends Controller
{
    /**
     * 📋 რესტორნის ყველა cuisine-ის ჩვენება (Admin View)
     */
    public function index(Restaurant $restaurant)
    {
        $restaurantCuisines = $restaurant->cuisines()
            ->withPivot('rank', 'status', 'created_at')
            ->orderBy('pivot_rank', 'asc')
            ->get();

        $availableCuisines = Cuisine::whereNotIn('id', $restaurantCuisines->pluck('id'))
            ->where('status', 'active')
            ->orderBy('rank', 'asc')
            ->get();

        return view('admin.restaurants.cuisines.index', compact(
            'restaurant', 
            'restaurantCuisines', 
            'availableCuisines'
        ));
    }

    /**
     * 📝 Cuisine დამატების ფორმა
     */
    public function create(Restaurant $restaurant)
    {
        $availableCuisines = Cuisine::whereNotIn('id', 
            $restaurant->cuisines()->pluck('cuisine_id')
        )
        ->where('status', 'active')
        ->orderBy('rank', 'asc')
        ->get();

        return view('admin.restaurants.cuisines.create', compact('restaurant', 'availableCuisines'));
    }

    /**
     * ➕ რესტორნისთვის cuisine-ის დამატება
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'cuisine_id' => 'required|exists:cuisines,id',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // შეამოწმე თუ უკვე არსებობს ეს კავშირი
        if ($restaurant->cuisines()->where('cuisine_id', $request->cuisine_id)->exists()) {
            return redirect()->back()->withErrors([
                'cuisine_id' => 'ეს cuisine უკვე დამატებულია ამ რესტორნისთვის.'
            ]);
        }

        try {
            DB::transaction(function () use ($request, $restaurant) {
                $restaurant->cuisines()->attach($request->cuisine_id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.restaurants.cuisines.index', $restaurant)
                ->with('success', 'Cuisine წარმატებით დაემატა რესტორანს!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ✏️ Cuisine-Restaurant კავშირის რედაქტირების ფორმა
     */
    public function edit(Restaurant $restaurant, Cuisine $cuisine)
    {
        $pivotData = $restaurant->cuisines()
            ->where('cuisine_id', $cuisine->id)
            ->withPivot('rank', 'status')
            ->first();

        if (!$pivotData) {
            return redirect()
                ->route('admin.restaurants.cuisines.index', $restaurant)
                ->withErrors(['error' => 'ეს cuisine არ არის დაკავშირებული ამ რესტორანთან.']);
        }

        return view('admin.restaurants.cuisines.edit', compact(
            'restaurant', 
            'cuisine', 
            'pivotData'
        ));
    }

    /**
     * 🔄 რესტორნის cuisine კავშირის განახლება
     */
    public function update(Request $request, Restaurant $restaurant, Cuisine $cuisine)
    {
        $request->validate([
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // შეამოწმე თუ კავშირი არსებობს
        if (!$restaurant->cuisines()->where('cuisine_id', $cuisine->id)->exists()) {
            return redirect()
                ->route('admin.restaurants.cuisines.index', $restaurant)
                ->withErrors(['error' => 'ეს cuisine არ არის დაკავშირებული ამ რესტორანთან.']);
        }

        try {
            DB::transaction(function () use ($request, $restaurant, $cuisine) {
                $restaurant->cuisines()->updateExistingPivot($cuisine->id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.restaurants.cuisines.index', $restaurant)
                ->with('success', 'Cuisine კავშირი წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ❌ რესტორნიდან cuisine-ის წაშლა
     */
    public function destroy(Restaurant $restaurant, Cuisine $cuisine)
    {
        if (!$restaurant->cuisines()->where('cuisine_id', $cuisine->id)->exists()) {
            return redirect()
                ->route('admin.restaurants.cuisines.index', $restaurant)
                ->withErrors(['error' => 'ეს cuisine არ არის დაკავშირებული ამ რესტორანთან.']);
        }

        try {
            DB::transaction(function () use ($restaurant, $cuisine) {
                $restaurant->cuisines()->detach($cuisine->id);
            });

            return redirect()
                ->route('admin.restaurants.cuisines.index', $restaurant)
                ->with('success', 'Cuisine წარმატებით წაიშალა რესტორნიდან!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * 🔄 Multiple cuisines-ების bulk management
     */
    public function bulkUpdate(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'cuisines' => 'required|array',
            'cuisines.*.cuisine_id' => 'required|exists:cuisines,id',
            'cuisines.*.rank' => 'nullable|integer|min:0',
            'cuisines.*.status' => 'required|in:active,inactive',
        ]);

        try {
            DB::transaction(function () use ($request, $restaurant) {
                $syncData = [];
                foreach ($request->cuisines as $cuisine) {
                    $syncData[$cuisine['cuisine_id']] = [
                        'rank' => $cuisine['rank'] ?? 0,
                        'status' => $cuisine['status'],
                    ];
                }
                $restaurant->cuisines()->sync($syncData);
            });

            return redirect()
                ->route('admin.restaurants.cuisines.index', $restaurant)
                ->with('success', 'Cuisines წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }
}
