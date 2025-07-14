@extends('kiosk.layouts.app')

@section('title', 'Reserve a Table - ' . $restaurant->name)

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg border-0" style="max-width: 500px; width: 100%; background: #f8fafc;">
            <div class="card-body px-4 py-4">
                <h2 class="card-title text-center mb-2 fw-bold" style="letter-spacing:1px;">Reservation -
                    {{ $restaurant->name }}</h2>
                <p class="text-center text-muted mb-4" style="font-size: 1rem;">Book your table in just a few steps</p>

                @if (session('success'))
                    <div class="alert alert-success text-center" id="success-alert">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('dev.reservations.restaurant.reserve', $restaurant->slug) }}">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="fw-semibold mb-1">Date:</label>
                            <input type="date" name="reservation_date" class="form-control rounded-3"
                                value="{{ old('reservation_date', $reservationDate) }}"
                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                onchange="window.location='?reservation_date='+this.value">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold mb-1">Time:</label>
                            <select name="reservation_time" class="form-control rounded-3" required>
                                <option value="">-- Select Time --</option>
                                @forelse($availableSlots as $time)
                                    <option value="{{ $time }}"
                                        {{ old('reservation_time', $oldReservationTime) == $time ? 'selected' : '' }}>
                                        {{ $time }}
                                    </option>
                                @empty
                                    <option disabled>No Available Slots</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold mb-1">Guests:</label>
                        <select name="guests_count" class="form-control rounded-3">
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ old('guests_count') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold mb-1">Name:</label>
                        <input type="text" name="name" class="form-control rounded-3" value="{{ old('name') }}"
                            required placeholder="Your Name">
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold mb-1">Phone / WhatsApp:</label>
                        <input type="tel" name="phone" class="form-control rounded-3" value="{{ old('phone') }}"
                            required placeholder="Phone or WhatsApp Number" pattern="^\+?[0-9\s\-()]{7,15}$"
                            title="Enter a valid phone or WhatsApp number">
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold mb-1">Email <span class="text-muted">(optional)</span>:</label>
                        <input type="email" name="email" class="form-control rounded-3" value="{{ old('email') }}"
                            placeholder="Email Address">
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold mb-1">Promo Code <span class="text-muted">(optional)</span>:</label>
                        <input type="text" name="promo_code" class="form-control rounded-3"
                            value="{{ old('promo_code') }}" placeholder="Promo Code">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm rounded-3"
                        style="letter-spacing:1px; transition:0.2s;">
                        Reserve Now
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            setTimeout(function() {
                let alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.transition = "opacity 0.5s";
                    alert.style.opacity = 0;
                    setTimeout(() => alert.remove(), 500);
                }
            }, 2000); // 2 წამში გაქრება
        </script>
    @endpush
@endsection
