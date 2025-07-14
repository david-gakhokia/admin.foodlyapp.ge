<?php

namespace App\Http\Controllers\Manager\Slot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\PlaceReservationSlotRequest; // Reusing the same request class since structure is identical
use App\Models\Table;
use App\Models\TableReservationSlot;

class TableSlotController extends Controller
{
    public function index($tableId)
    {
        $table = Table::findOrFail($tableId);
        $slots = TableReservationSlot::where('table_id', $tableId)->get();
        return view('manager.slots.table.index', compact('slots', 'tableId', 'table'));
    }

    public function create($tableId)
    {
        $table = Table::findOrFail($tableId);
        return view('manager.slots.table.create', compact('tableId', 'table'));
    }

    public function store(PlaceReservationSlotRequest $request, $tableId)
    {
        $data = $request->validated();
        $data['table_id'] = $tableId;

        TableReservationSlot::create($data);

        return redirect()->route('manager.slots.table.slots.index', $tableId)
            ->with('success', 'Slot created successfully.');
    }


    public function edit($tableId, $slotId)
    {
        $table = Table::findOrFail($tableId);
        $slot = TableReservationSlot::where('table_id', $tableId)->findOrFail($slotId);
        return view('manager.slots.table.edit', compact('slot', 'tableId', 'table'));
    }

    public function update(PlaceReservationSlotRequest $request, $tableId, $slotId)
    {
        $slot = TableReservationSlot::where('table_id', $tableId)->findOrFail($slotId);
        $slot->update($request->validated());

        return redirect()->route('manager.slots.table.slots.index', $tableId)
            ->with('success', 'Slot updated successfully.');
    }

    public function destroy($tableId, $slotId)
    {
        $slot = TableReservationSlot::where('table_id', $tableId)->findOrFail($slotId);
        $slot->delete();

        return redirect()->route('manager.slots.table.slots.index', $tableId)
            ->with('success', 'Slot deleted successfully.');
    }
}
