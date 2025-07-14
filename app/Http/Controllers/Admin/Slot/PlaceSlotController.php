<?php

namespace App\Http\Controllers\Admin\Slot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\PlaceReservationSlotRequest;
use App\Models\Place;
use App\Models\PlaceReservationSlot;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class PlaceSlotController extends Controller
{
    public function index(Restaurant $restaurant, Place $place)
    {
        $slots = $place->reservationSlots()->orderBy('day_of_week')->orderBy('time_from')->get();
        
        return view('admin.restaurants.places.slots.index', compact('restaurant', 'place', 'slots'));
    }

    public function create(Restaurant $restaurant, Place $place)
    {
        return view('admin.restaurants.places.slots.create', compact('restaurant', 'place'));
    }

    public function store(PlaceReservationSlotRequest $request, Restaurant $restaurant, Place $place)
    {
        $place->reservationSlots()->create($request->validated());

        return redirect()->route('admin.restaurants.places.slots.index', [$restaurant, $place])
            ->with('success', 'Slot წარმატებით შეიქმნა!');
    }

    public function show(Restaurant $restaurant, Place $place, PlaceReservationSlot $slot)
    {
        return view('admin.restaurants.places.slots.show', compact('restaurant', 'place', 'slot'));
    }

    public function edit(Restaurant $restaurant, Place $place, PlaceReservationSlot $slot)
    {
        return view('admin.restaurants.places.slots.edit', compact('restaurant', 'place', 'slot'));
    }

    public function update(PlaceReservationSlotRequest $request, Restaurant $restaurant, Place $place, PlaceReservationSlot $slot)
    {
        $slot->update($request->validated());

        return redirect()->route('admin.restaurants.places.slots.index', [$restaurant, $place])
            ->with('success', 'Slot წარმატებით განახლდა!');
    }

    public function destroy(Restaurant $restaurant, Place $place, PlaceReservationSlot $slot)
    {
        $slot->delete();

        return redirect()->route('admin.restaurants.places.slots.index', [$restaurant, $place])
            ->with('success', 'Slot წარმატებით წაიშალა!');
    }
}
