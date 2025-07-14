<?php

namespace App\Http\Controllers\Manager\Slot;

use App\Http\Controllers\Controller;

use App\Models\Place;
use App\Models\PlaceReservationSlot;
use App\Http\Requests\Slot\PlaceReservationSlotRequest;

class PlaceSlotController extends Controller
{
    public function index($placeId)
    {
        $place = Place::findOrFail($placeId);
        $slots = PlaceReservationSlot::where('place_id', $placeId)->get();
        return view('manager.slots.place.index', compact('slots', 'placeId', 'place'));
    }

    public function create($placeId)
    {
        $place = Place::findOrFail($placeId);
        return view('manager.slots.place.create', compact('placeId', 'place'));
    }

    public function store(PlaceReservationSlotRequest $request, $placeId)
    {
        $data = $request->validated();
        $data['place_id'] = $placeId;

        PlaceReservationSlot::create($data);

        return redirect()->route('manager.slots.place.slots.index', $placeId)
            ->with('success', 'Slot created successfully.');
    }


    public function edit($placeId, $slotId)
    {
        $place = Place::findOrFail($placeId);
        $slot = PlaceReservationSlot::where('place_id', $placeId)->findOrFail($slotId);
        return view('manager.slots.place.edit', compact('slot', 'placeId', 'place'));
    }

    public function update(PlaceReservationSlotRequest $request, $placeId, $slotId)
    {
        $slot = PlaceReservationSlot::where('place_id', $placeId)->findOrFail($slotId);
        $slot->update($request->validated());

        return redirect()->route('manager.slots.place.slots.index', $placeId)
            ->with('success', 'Slot updated successfully.');
    }

    public function destroy($placeId, $slotId)
    {
        $slot = PlaceReservationSlot::where('place_id', $placeId)->findOrFail($slotId);
        $slot->delete();

        return redirect()->route('manager.slots.place.slots.index', $placeId)
            ->with('success', 'Slot deleted successfully.');
    }
}
