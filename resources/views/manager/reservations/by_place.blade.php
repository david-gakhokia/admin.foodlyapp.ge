@extends('manager.layout')

@section('content')
<div class="container mt-5">
    <h2>Reservations (By Place ID: {{ $placeId }})</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label>Date From:</label>
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>
        <div class="col-md-3">
            <label>Date To:</label>
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type</th>
                <th>Date</th>
                <th>Time</th>
                <th>Name</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $res)
            <tr>
                <td>{{ ucfirst($res->type) }}</td>
                <td>{{ $res->reservation_date }}</td>
                <td>{{ $res->reservation_time }}</td>
                <td>{{ $res->name }}</td>
                <td>{{ $res->phone }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No reservations found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $reservations->links() }}
</div>
@endsection
