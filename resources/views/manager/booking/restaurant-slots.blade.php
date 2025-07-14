@extends('manager.layout')

@section('title', 'Restaurant Slots')

@section('content')
    <div class="card shadow-sm p-4">
        <h3 class="mb-4">Slots for {{ $restaurant->name }}</h3>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Day</th>
                    <th>Time From</th>
                    <th>Time To</th>
                    <th>Today Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slots as $slot)
                    <tr>
                        <td>{{ $slot->day_of_week }}</td>
                        <td>{{ $slot->time_from }}</td>
                        <td>{{ $slot->time_to }}</td>
                        <td>
                            @if ($reservations->has($slot->time_from))
                                <span class="badge bg-danger">Reserved</span>
                            @else
                                <span class="badge bg-success">Available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
