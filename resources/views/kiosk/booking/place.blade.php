@extends('kiosk.layouts.app')

@section('title', 'Reserve at ' . $place->name)

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg border-0" style="max-width: 500px; width: 100%; background: #f8fafc;">
            <div class="card-body px-4 py-4">

                <h2 class="card-title text-center mb-3 fw-bold">Reservation - {{ $place->name }}</h2>

                @if (session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('booking-api.place.reserve', [$restaurant->slug, $place->slug]) }}">
                    @csrf

                    <div class="mb-3">
                        <label>Date:</label>
                        <input type="date" name="reservation_date" class="form-control"
                            value="{{ request('reservation_date', now()->toDateString()) }}"
                            onchange="window.location='?reservation_date='+this.value">
                    </div>

                    <div class="mb-3">
                        <label>Time:</label>
                        <select name="reservation_time" class="form-control" required>
                            <option value="">-- Select Time --</option>
                            @forelse($availableSlots as $time)
                                <option value="{{ $time }}">{{ $time }}</option>
                            @empty
                                <option disabled>No Available Slots</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Guests:</label>
                        <input type="number" name="guests_count" class="form-control" value="1" min="1"
                            max="50">
                    </div>

                    <div class="mb-3">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone:</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email (optional):</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Promo Code (optional):</label>
                        <input type="text" name="promo_code" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Reserve Now</button>
                </form>
            </div>
        </div>
    </div>
@endsection
