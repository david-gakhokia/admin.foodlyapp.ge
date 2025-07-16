<?php

namespace App\Http\Controllers\Admin\Slot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\TableReservationSlotRequest;
use App\Models\Table;
use App\Models\Restaurant;
use App\Models\Place;
use App\Models\TableReservationSlot;
use Illuminate\Http\Request;

class TableSlotController extends Controller
{
    public function index(Restaurant $restaurant, Place $place, Table $table)
    {
        $slots = $table->reservationSlots()->orderBy('day_of_week')->orderBy('time_from')->get();
        
        return view('admin.restaurants.places.tables.slots.index', compact('restaurant', 'place', 'table', 'slots'));
    }

    public function create(Restaurant $restaurant, Place $place, Table $table)
    {
        return view('admin.restaurants.places.tables.slots.create', compact('restaurant', 'place', 'table'));
    }

    public function store(TableReservationSlotRequest $request, Restaurant $restaurant, Place $place, Table $table)
    {
        $table->reservationSlots()->create($request->validated());

        return redirect()->route('admin.restaurants.places.tables.slots.index', [$restaurant, $place, $table])
            ->with('success', 'TimeSlot წარმატებით შეიქმნა!');
    }

    public function show(Restaurant $restaurant, Place $place, Table $table, TableReservationSlot $slot)
    {
        return view('admin.restaurants.places.tables.slots.show', compact('restaurant', 'place', 'table', 'slot'));
    }

    public function edit(Restaurant $restaurant, Place $place, Table $table, TableReservationSlot $slot)
    {
        return view('admin.restaurants.places.tables.slots.edit', compact('restaurant', 'place', 'table', 'slot'));
    }

    public function update(TableReservationSlotRequest $request, Restaurant $restaurant, Place $place, Table $table, TableReservationSlot $slot)
    {
        $slot->update($request->validated());

        return redirect()->route('admin.restaurants.places.tables.slots.index', [$restaurant, $place, $table])
            ->with('success', 'Slot წარმატებით განახლდა!');
    }

    public function destroy(Restaurant $restaurant, Place $place, Table $table, TableReservationSlot $slot)
    {
        $slot->delete();

        return redirect()->route('admin.restaurants.places.tables.slots.index', [$restaurant, $place, $table])
            ->with('success', 'Slot წარმატებით წაიშალა!');
    }

    // Place-specific methods
    public function createForPlace(Restaurant $restaurant, Place $place, Table $table)
    {
        return view('admin.restaurants.places.tables.slots.create', compact('restaurant', 'place', 'table'));
    }

    public function storeForPlace(TableReservationSlotRequest $request, Restaurant $restaurant, Place $place, Table $table)
    {
        $table->reservationSlots()->create($request->validated());

        return redirect()->route('admin.restaurants.places.tables.show', [$restaurant, $place, $table])
            ->with('success', 'TimeSlot წარმატებით შეიქმნა!');
    }
}
