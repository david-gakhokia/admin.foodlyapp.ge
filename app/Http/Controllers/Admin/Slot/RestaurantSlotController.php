<?php

namespace App\Http\Controllers\Admin\Slot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\ReservationSlotRequest;
use App\Models\Restaurant;
use App\Models\RestaurantReservationSlot;
use Illuminate\Http\Request;

class RestaurantSlotController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $slots = $restaurant->reservationSlots()->orderBy('day_of_week')->orderBy('time_from')->get();
        
        return view('admin.restaurants.slots.index', compact('restaurant', 'slots'));
    }

    public function create(Restaurant $restaurant)
    {
        return view('admin.restaurants.slots.create', compact('restaurant'));
    }

    public function store(ReservationSlotRequest $request, Restaurant $restaurant)
    {
        $restaurant->reservationSlots()->create($request->validated());

        return redirect()->route('admin.restaurants.slots.index', $restaurant)
            ->with('success', 'Slot წარმატებით შეიქმნა!');
    }

    public function show(Restaurant $restaurant, RestaurantReservationSlot $slot)
    {
        return view('admin.restaurants.slots.show', compact('restaurant', 'slot'));
    }

    public function edit(Restaurant $restaurant, RestaurantReservationSlot $slot)
    {
        return view('admin.restaurants.slots.edit', compact('restaurant', 'slot'));
    }

    public function update(ReservationSlotRequest $request, Restaurant $restaurant, RestaurantReservationSlot $slot)
    {
        $slot->update($request->validated());

        return redirect()->route('admin.restaurants.slots.index', $restaurant)
            ->with('success', 'Slot წარმატებით განახლდა!');
    }

    public function destroy(Restaurant $restaurant, RestaurantReservationSlot $slot)
    {
        $slot->delete();

        return redirect()->route('admin.restaurants.slots.index', $restaurant)
            ->with('success', 'Slot წარმატებით წაიშალა!');
    }
}
