@extends('kiosk.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Reserve at რესტორანი{{ $restaurant->name }} | სივრცე {{ $place->name }} #{{ $table->id }}</h2>

    <form method="GET" class="mb-4">
        <div class="form-group">
            <label>Select Date:</label>
            <input type="date" name="date" class="form-control" value="{{ $selectedDate }}" onchange="this.form.submit()">
        </div>
    </form>

    <form method="POST" action="{{ route('reservations.table.reserve', $table->id) }}" class="card p-4">
        @csrf
        <input type="hidden" name="reservation_date" value="{{ $selectedDate }}" />

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email (optional):</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Time:</label>
            <select name="reservation_time" class="form-select" required>
                <option value="">Select Time</option>
                @foreach ($slots as $slot)
                    <option value="{{ $slot }}">{{ $slot }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Guests:</label>
            <input type="number" name="guests_count" class="form-control" min="1">
        </div>

        <div class="mb-3">
            <label class="form-label">Promo Code:</label>
            <input type="text" name="promo_code" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Notes:</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Reserve Now</button>
    </form>
</div>
@endsection
