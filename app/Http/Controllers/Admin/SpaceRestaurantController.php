<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Space;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpaceRestaurantController extends Controller
{
    public function index(Space $space)
    {
        // Load space with restaurants and their pivot data
        $space->load(['restaurants' => function($query) {
            $query->withPivot(['rank', 'status'])
                  ->withTimestamps()
                  ->orderBy('pivot_rank', 'ASC');
        }]);

        // Get available restaurants that are not attached to this space
        $attachedRestaurantIds = $space->restaurants->pluck('id')->toArray();
        $availableRestaurants = Restaurant::whereNotIn('id', $attachedRestaurantIds)
                                        ->with('translations')
                                        ->where('status', 'active')
                                        ->orderBy('rank', 'ASC')
                                        ->get();

        $statistics = [
            'total_restaurants' => $space->restaurants->count(),
            'active_restaurants' => $space->restaurants->where('pivot.status', 'active')->count(),
            'inactive_restaurants' => $space->restaurants->where('pivot.status', 'inactive')->count(),
            'pending_restaurants' => $space->restaurants->where('pivot.status', 'pending')->count(),
        ];

        return view('admin.spaces.restaurants.index', compact('space', 'availableRestaurants', 'statistics'));
    }

    public function create(Space $space)
    {
        // Get available restaurants
        $attachedRestaurantIds = $space->restaurants->pluck('id')->toArray();
        $availableRestaurants = Restaurant::whereNotIn('id', $attachedRestaurantIds)
                                        ->with('translations')
                                        ->where('status', 'active')
                                        ->orderBy('rank', 'ASC')
                                        ->get();

        if ($availableRestaurants->isEmpty()) {
            return redirect()->route('admin.spaces.restaurants.index', $space)
                           ->with('error', 'No available restaurants to add. All active restaurants are already attached to this space.');
        }

        return view('admin.spaces.restaurants.create', compact('space', 'availableRestaurants'));
    }

    public function store(Request $request, Space $space)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive,pending'
        ]);

        try {
            DB::beginTransaction();

            // Check if restaurant is already attached
            if ($space->restaurants()->where('restaurant_id', $validated['restaurant_id'])->exists()) {
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'This restaurant is already attached to this space.');
            }

            // Auto-assign rank if not provided
            if (empty($validated['rank'])) {
                $maxRank = $space->restaurants()->max('rank') ?? 0;
                $validated['rank'] = $maxRank + 1;
            }

            // Attach restaurant with pivot data
            $space->restaurants()->attach($validated['restaurant_id'], [
                'rank' => $validated['rank'],
                'status' => $validated['status'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::commit();

            $restaurant = Restaurant::find($validated['restaurant_id']);
            $restaurantName = $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Unknown Restaurant';

            return redirect()->route('admin.spaces.restaurants.index', $space)
                           ->with('success', "Restaurant \"{$restaurantName}\" has been successfully attached to the space.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error attaching restaurant to space: ' . $e->getMessage());
            
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'An error occurred while attaching the restaurant. Please try again.');
        }
    }

    public function edit(Space $space, Restaurant $restaurant)
    {
        // Check if the restaurant is attached to this space
        $pivot = $space->restaurants()->where('restaurant_id', $restaurant->id)->first();
        
        if (!$pivot) {
            return redirect()->route('admin.spaces.restaurants.index', $space)
                           ->with('error', 'This restaurant is not attached to this space.');
        }

        // Get pivot data
        $pivotData = $pivot->pivot;

        return view('admin.spaces.restaurants.edit', compact('space', 'restaurant', 'pivotData'));
    }

    public function update(Request $request, Space $space, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'rank' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive,pending'
        ]);

        try {
            DB::beginTransaction();

            // Check if the restaurant is attached to this space
            if (!$space->restaurants()->where('restaurant_id', $restaurant->id)->exists()) {
                return redirect()->route('admin.spaces.restaurants.index', $space)
                               ->with('error', 'This restaurant is not attached to this space.');
            }

            // Update pivot data
            $space->restaurants()->updateExistingPivot($restaurant->id, [
                'rank' => $validated['rank'],
                'status' => $validated['status'],
                'updated_at' => now()
            ]);

            DB::commit();

            $restaurantName = $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Unknown Restaurant';

            return redirect()->route('admin.spaces.restaurants.index', $space)
                           ->with('success', "Restaurant relationship \"{$restaurantName}\" has been successfully updated.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating space restaurant relationship: ' . $e->getMessage());
            
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'An error occurred while updating the restaurant relationship. Please try again.');
        }
    }

    public function destroy(Space $space, Restaurant $restaurant)
    {
        try {
            DB::beginTransaction();

            // Check if the restaurant is attached to this space
            if (!$space->restaurants()->where('restaurant_id', $restaurant->id)->exists()) {
                return redirect()->route('admin.spaces.restaurants.index', $space)
                               ->with('error', 'This restaurant is not attached to this space.');
            }

            // Detach the restaurant
            $space->restaurants()->detach($restaurant->id);

            DB::commit();

            $restaurantName = $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Unknown Restaurant';

            return redirect()->route('admin.spaces.restaurants.index', $space)
                           ->with('success', "Restaurant \"{$restaurantName}\" has been successfully removed from the space.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error removing restaurant from space: ' . $e->getMessage());
            
            return redirect()->back()
                           ->with('error', 'An error occurred while removing the restaurant. Please try again.');
        }
    }

    public function bulkUpdate(Request $request, Space $space)
    {
        $validated = $request->validate([
            'restaurants' => 'required|array',
            'restaurants.*.id' => 'required|exists:restaurants,id',
            'restaurants.*.rank' => 'required|integer|min:0',
            'restaurants.*.status' => 'required|in:active,inactive,pending'
        ]);

        try {
            DB::beginTransaction();

            foreach ($validated['restaurants'] as $restaurantData) {
                // Verify restaurant is attached to this space
                if ($space->restaurants()->where('restaurant_id', $restaurantData['id'])->exists()) {
                    $space->restaurants()->updateExistingPivot($restaurantData['id'], [
                        'rank' => $restaurantData['rank'],
                        'status' => $restaurantData['status'],
                        'updated_at' => now()
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.spaces.restaurants.index', $space)
                           ->with('success', 'Restaurant relationships have been successfully updated.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error bulk updating space restaurant relationships: ' . $e->getMessage());
            
            return redirect()->back()
                           ->with('error', 'An error occurred while updating restaurant relationships. Please try again.');
        }
    }
}
