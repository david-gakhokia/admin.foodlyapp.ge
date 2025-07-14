@extends('booking.layout')

@section('content')
    <h2 class="mb-4">All Reservations (Booking Panel)</h2>

    <form method="GET" class="mb-4">
        <div class="card p-3 shadow-sm">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="type" class="form-label fw-bold">Reservation Type:</label>
                    <select name="type" class="form-select">
                        <option value="">All</option>
                        <option value="restaurant" {{ request('type') == 'restaurant' ? 'selected' : '' }}>Restaurant
                        </option>
                        <option value="place" {{ request('type') == 'place' ? 'selected' : '' }}>Place</option>
                        <option value="table" {{ request('type') == 'table' ? 'selected' : '' }}>Table</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="restaurant_id" class="form-label fw-bold">Restaurant:</label>
                    <select name="restaurant_id" class="form-select">
                        <option value="">All</option>
                        @foreach ($restaurants as $rest)
                            <option value="{{ $rest->id }}"
                                {{ request('restaurant_id') == $rest->id ? 'selected' : '' }}>
                                {{ $rest->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="place" class="form-label fw-bold">Place:</label>
                    <select name="place" class="form-select">
                        <option value="">All</option>
                        @foreach ($places as $place)
                            <option value="{{ $place->id }}" {{ request('place') == $place->id ? 'selected' : '' }}>
                                {{ $place->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="table" class="form-label fw-bold">Table:</label>
                    <select name="table" class="form-select">
                        <option value="">All</option>
                        @foreach ($tables as $table)
                            <option value="{{ $table->id }}" {{ request('table') == $table->id ? 'selected' : '' }}>
                                {{ $table->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <div class="row g-2">
                        <div class="col">
                            <label class="form-label fw-bold">From:</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col">
                            <label class="form-label fw-bold">To:</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="time_from" class="form-label fw-bold">Time From:</label>
                    <input type="time" name="time_from" class="form-control" value="{{ request('time_from') }}"
                        step="60">
                </div>

                <div class="col-md-3">
                    <label for="time_to" class="form-label fw-bold">Time To:</label>
                    <input type="time" name="time_to" class="form-control" value="{{ request('time_to') }}"
                        step="60">
                </div>


                <div class="col-md-6">
                    <a href="{{ route('dev.booking.reservations.export.csv', request()->query()) }}"
                        class="btn btn-outline-success">
                        Export CSV
                    </a>
                    <a href="{{ route('dev.booking.reservations.export.pdf', request()->query()) }}"
                        class="btn btn-outline-danger">
                        Export PDF
                    </a>
                </div>


                <div class="col-md-12 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary px-4">Filter</button>
                    <a href="{{ route('dev.booking.reservations') }}" class="btn btn-secondary px-4">Reset</a>
                </div>
            </div>
        </div>
    </form>

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Type</th>
                <th>Restaurant</th>
                {{-- <th>Place</th> --}}
                {{-- <th>Table</th> --}}
                <th>Date / Time</th>
                {{-- <th>Time</th> --}}
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Guests</th>
                <th>Status</th>
                {{-- <th>Promo Code</th> --}}
                {{-- <th>Notes</th> --}}
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $res)
                <tr>
                    <td>
                        <a href="" class="text-decoration-none">
                            {{ $res->id }}
                        </a>
                    </td>
                    <td>
                        @if ($res->type == 'restaurant')
                            <span class="badge bg-primary">Restaurant</span>
                        @elseif($res->type == 'place')
                            <span class="badge bg-success">Place</span>
                        @elseif($res->type == 'table')
                            <span class="badge bg-warning text-dark">Table</span>
                        @else
                            {{ ucfirst($res->type) }}
                        @endif
                    </td>
                    <td>
                        @if ($res->type == 'restaurant')
                            <strong>{{ $res->reservable?->name ?? '-' }}</strong>
                        @elseif ($res->type == 'place')
                            <strong>{{ $res->reservable?->restaurant?->name ?? '-' }}</strong><br>
                            <span>{{ $res->reservable?->name ?? '-' }}</span>
                        @elseif ($res->type == 'table')
                            <strong>{{ $res->reservable?->place?->restaurant?->name ?? '-' }}</strong><br>
                            <span>{{ $res->reservable?->place?->name ?? '-' }}</span><br>
                            <span class="fw-semibold">{{ $res->reservable?->name ?? '-' }}</span>
                        @endif
                    </td>
                    {{-- <td>{{ $res->reservable?->name ?? '-' }}</td> --}}
                    {{-- <td>{{ $res->place?->name ?? '-' }}</td>
                    <td>{{ $res->table?->name ?? '-' }}</td> --}}
                    {{-- <td><strong>{{ $res->reservation_date }}</strong></td> --}}
                    <td><span class="badge bg-secondary">{{ $res->time_from }}</span></td>
                    <td>{{ $res->name }}</td>
                    <td>{{ $res->phone }}</td>
                    <td>{{ $res->email }}</td>
                    <td>{{ $res->guests_count }}</td>
                    <td>{{ $res->status }}</td>
                    {{-- <td>{{ $res->promo_code }}</td> --}}
                    {{-- <td>{{ $res->notes }}</td> --}}
                    <td>{{ $res->created_at }}</td>
                    <td>{{ $res->updated_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="15" class="text-center">No reservations found</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    {{ $reservations->links() }}
@endsection
