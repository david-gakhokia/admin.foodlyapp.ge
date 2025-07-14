@extends('manager.layout')

@section('title', 'Restaurant Slots')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Slots</h2>
        <a href="{{ route('manager.slots.restaurant.slots.create', $restaurantId) }}" class="btn btn-success">
            + Add Slot
        </a>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Max Guests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($slots as $slot)
                <tr>
                        <td>{{ $slot->day_of_week }}</td>
                        <td>{{ $slot->time_from }}</td>
                        <td>{{ $slot->time_to }}</td>
                    <td>
                        @if ($slot->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('manager.slots.restaurant.slots.edit', [$restaurantId, $slot->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form method="POST"
                            action="{{ route('manager.slots.restaurant.slots.destroy', [$restaurantId, $slot->id]) }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
