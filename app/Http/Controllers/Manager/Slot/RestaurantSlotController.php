<?php

namespace App\Http\Controllers\Manager\Slot;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\RestaurantReservationSlot;
use App\Http\Requests\Slot\ReservationSlotRequest;

class RestaurantSlotController extends Controller
{
    public function index($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $slots = RestaurantReservationSlot::where('restaurant_id', $restaurantId)->get();
        return view('manager.slots.restaurant.index', compact('slots', 'restaurantId', 'restaurant'));
    }

    public function create($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        return view('manager.slots.restaurant.create', compact('restaurantId', 'restaurant'));
    }

    public function store(ReservationSlotRequest $request, $restaurantId)
    {
        $data = $request->validated();
        $data['restaurant_id'] = $restaurantId;

        RestaurantReservationSlot::create($data);

        return redirect()->route('manager.slots.restaurant.slots.index', $restaurantId)
            ->with('success', 'Slot created successfully.');
    }


    public function edit($restaurantId, $slotId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $slot = RestaurantReservationSlot::where('restaurant_id', $restaurantId)->findOrFail($slotId);
        return view('manager.slots.restaurant.edit', compact('slot', 'restaurantId', 'restaurant'));
    }

    public function update(ReservationSlotRequest $request, $restaurantId, $slotId)
    {
        $slot = RestaurantReservationSlot::where('restaurant_id', $restaurantId)->findOrFail($slotId);
        $slot->update($request->validated());

        return redirect()->route('manager.slots.restaurant.slots.index', $restaurantId)
            ->with('success', 'Slot updated successfully.');
    }

    public function destroy($restaurantId, $slotId)
    {
        $slot = RestaurantReservationSlot::where('restaurant_id', $restaurantId)->findOrFail($slotId);
        $slot->delete();

        return redirect()->route('manager.slots.restaurant.slots.index', $restaurantId)
            ->with('success', 'Slot deleted successfully.');
    }
}
