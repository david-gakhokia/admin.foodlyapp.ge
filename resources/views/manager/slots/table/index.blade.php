@extends('manager.layout')

@section('title', 'Table Time Slots')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Time Slots for {{ $table->name ?? 'Table' }}</h2>
        <a href="{{ route('manager.slots.table.slots.create', $tableId) }}" class="btn btn-success">
            + Add Time Slot
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Day of Week</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Interval (min)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($slots as $slot)
                    <tr>
                        <td>{{ $slot->day_of_week }}</td>
                        <td>{{ $slot->time_from }}</td>
                        <td>{{ $slot->time_to }}</td>
                        <td>{{ $slot->slot_interval_minutes }}</td>
                        <td>
                            @if ($slot->available)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Not Available</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('manager.slots.table.slots.edit', [$tableId, $slot->id]) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST"
                                action="{{ route('manager.slots.table.slots.destroy', [$tableId, $slot->id]) }}">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this time slot?')"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No time slots available. Create your first time slot!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
