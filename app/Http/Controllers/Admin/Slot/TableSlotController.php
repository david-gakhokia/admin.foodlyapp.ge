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
    public function index(Table $table)
    {
        $slots = $table->reservationSlots()->orderBy('day_of_week')->orderBy('time_from')->get();
        
        return view('admin.restaurants.tables.slots.index', compact('table', 'slots'));
    }

    public function create(Table $table)
    {
        return view('admin.restaurants.tables.slots.create', compact('table'));
    }

    public function store(TableReservationSlotRequest $request, Table $table)
    {
        $table->reservationSlots()->create($request->validated());

        return redirect()->route('admin.tables.slots.index', $table)
            ->with('success', 'Slot წარმატებით შეიქმნა!');
    }

    public function show(Table $table, TableReservationSlot $slot)
    {
        return view('admin.restaurants.tables.slots.show', compact('table', 'slot'));
    }

    public function edit(Table $table, TableReservationSlot $slot)
    {
        return view('admin.restaurants.tables.slots.edit', compact('table', 'slot'));
    }

    public function update(TableReservationSlotRequest $request, Table $table, TableReservationSlot $slot)
    {
        $slot->update($request->validated());

        return redirect()->route('admin.tables.slots.index', $table)
            ->with('success', 'Slot წარმატებით განახლდა!');
    }

    public function destroy(Table $table, TableReservationSlot $slot)
    {
        $slot->delete();

        return redirect()->route('admin.tables.slots.index', $table)
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
