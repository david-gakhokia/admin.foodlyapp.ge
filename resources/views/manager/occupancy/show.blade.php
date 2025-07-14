@extends('manager.layout')

@section('content')
    <div class="container">
        <h1>Occupancy: {{ $restaurant->name }}</h1>

        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col">
                    <label>Start Date:</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col">
                    <label>End Date:</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col">
                    <label>Group By:</label>
                    <select name="period" class="form-control">
                        <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Day</option>
                        <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Week</option>
                        <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Month</option>
                        <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Year</option>
                    </select>
                </div>
                <div class="col d-flex align-items-end">
                    <button class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('manager.occupancy.show', $restaurant->id) }}" class="btn btn-secondary ms-2">Clear</a>
                </div>
            </div>
        </form>


        @if ($occupancyData->isEmpty())
            <div class="alert alert-info">No reservations found for selected period.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time From</th>
                        <th>Time To</th>
                        <th>Type</th>
                        <th>Reservable</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($occupancyData as $reservation)
                        <tr>
                            <td>{{ $reservation['date'] }}</td>
                            <td>{{ $reservation['time_from'] }}</td>
                            <td>{{ $reservation['time_to'] }}</td>
                            <td>{{ ucfirst($reservation['type']) }}</td>
                            <td>{{ $reservation['reservable'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif


        {{-- <a href="{{ route('manager.occupancy.index') }}" class="btn btn-secondary mt-3">Back</a> --}}
    </div>
@endsection
