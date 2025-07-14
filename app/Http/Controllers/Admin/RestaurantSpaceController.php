<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Space;
use Illuminate\Support\Facades\DB;

class RestaurantSpaceController extends Controller
{
    /**
     * 📋 Restaurant-ის ყველა space-ის ჩვენება (Admin View)
     */
    public function index(Restaurant $restaurant)
    {
        $spaces = $restaurant->spaces()
            ->withPivot('rank', 'status', 'created_at')
            ->orderBy('pivot_rank', 'asc')
            ->get();

        $availableSpaces = Space::whereNotIn('id', $spaces->pluck('id'))
            ->where('status', 'active')
            ->orderBy('rank', 'asc')
            ->get();

        return view('admin.restaurants.spaces.index', compact(
            'restaurant', 
            'spaces', 
            'availableSpaces'
        ));
    }

    /**
     * 📝 Space დამატების ფორმა
     */
    public function create(Restaurant $restaurant)
    {
        $spaces = Space::whereNotIn('id', 
            $restaurant->spaces()->pluck('space_id')
        )
        ->where('status', 'active')
        ->orderBy('rank', 'asc')
        ->get();

        return view('admin.restaurants.spaces.create', compact('restaurant', 'spaces'));
    }

    /**
     * 💾 ახალი Restaurant-Space კავშირის შენახვა
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'space_id' => 'required|exists:spaces,id',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // შეამოწმე თუ კავშირი არ არსებობს
        if ($restaurant->spaces()->where('space_id', $request->space_id)->exists()) {
            return redirect()->back()->withErrors([
                'space_id' => 'ეს space უკვე დამატებულია ამ restaurant-ში.'
            ]);
        }

        try {
            DB::transaction(function () use ($request, $restaurant) {
                $restaurant->spaces()->attach($request->space_id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.restaurants.spaces.index', $restaurant)
                ->with('success', 'Space წარმატებით დაემატა restaurant-ს!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ✏️ Restaurant-Space კავშირის რედაქტირების ფორმა
     */
    public function edit(Restaurant $restaurant, Space $space)
    {
        $spaceWithPivot = $restaurant->spaces()
            ->where('space_id', $space->id)
            ->withPivot('rank', 'status', 'created_at')
            ->first();

        if (!$spaceWithPivot) {
            return redirect()
                ->route('admin.restaurants.spaces.index', $restaurant)
                ->withErrors(['error' => 'ეს space არ არის დაკავშირებული ამ restaurant-თან.']);
        }

        return view('admin.restaurants.spaces.edit', [
            'restaurant' => $restaurant,
            'space' => $spaceWithPivot
        ]);
    }

    /**
     * 🔄 Restaurant-ის space კავშირის განახლება
     */
    public function update(Request $request, Restaurant $restaurant, Space $space)
    {
        $request->validate([
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // შეამოწმე თუ კავშირი არსებობს
        if (!$restaurant->spaces()->where('space_id', $space->id)->exists()) {
            return redirect()
                ->route('admin.restaurants.spaces.index', $restaurant)
                ->withErrors(['error' => 'ეს space არ არის დაკავშირებული ამ restaurant-თან.']);
        }

        try {
            DB::transaction(function () use ($request, $restaurant, $space) {
                $restaurant->spaces()->updateExistingPivot($space->id, [
                    'rank' => $request->rank ?? 0,
                    'status' => $request->status,
                ]);
            });

            return redirect()
                ->route('admin.restaurants.spaces.index', $restaurant)
                ->with('success', 'Space კავშირი წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * ❌ Restaurant-დან space-ის წაშლა
     */
    public function destroy(Restaurant $restaurant, Space $space)
    {
        try {
            DB::transaction(function () use ($restaurant, $space) {
                $restaurant->spaces()->detach($space->id);
            });

            return redirect()
                ->route('admin.restaurants.spaces.index', $restaurant)
                ->with('success', 'Space წარმატებით ამოიშალა restaurant-იდან!');

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
            'spaces' => 'required|array',
            'spaces.*.space_id' => 'required|exists:spaces,id',
            'spaces.*.rank' => 'nullable|integer|min:0',
            'spaces.*.status' => 'required|in:active,inactive,pending',
        ]);

        try {
            DB::transaction(function () use ($request, $restaurant) {
                foreach ($request->spaces as $spaceData) {
                    $restaurant->spaces()->updateExistingPivot($spaceData['space_id'], [
                        'rank' => $spaceData['rank'] ?? 0,
                        'status' => $spaceData['status'],
                    ]);
                }
            });

            return redirect()
                ->route('admin.restaurants.spaces.index', $restaurant)
                ->with('success', 'Spaces წარმატებით განახლდა!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'შეცდომა: ' . $e->getMessage()
            ]);
        }
    }
}
