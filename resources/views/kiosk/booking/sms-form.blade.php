@extends('kiosk.layouts.app')

@section('title', 'Reserve at ' . $restaurant->name)

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.min.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #F16754 !important;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-secondary {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .intl-tel-input {
            width: 100% !important;
        }

        .intl-tel-input input {
            width: 100% !important;
        }

        .intl-tel-input .selected-flag {
            z-index: 100 !important;
        }
    </style>
@endsection

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card p-4" style="max-width: 500px; width: 100%;">

            <div class="text-center mb-4">
                <img src="https://foodly.space/assets/images/logo.png" width="150" alt="Foodly Logo">
            </div>

            <h2 class="text-center mb-4 fw-bold" style="font-size: 1.75rem;">Reservation - {{ $restaurant->name }}</h2>

            <form method="POST" action="{{ route('dev.booking-form.restaurant.reserve', $restaurant->slug) }}">
                @csrf

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="reservation_date" class="form-control"
                            value="{{ request('reservation_date', now()->toDateString()) }}"
                            onchange="window.location='?reservation_date='+this.value">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Time</label>
                        <select name="reservation_time" class="form-control" required>
                            <option value="">-- Select Time --</option>
                            @forelse($availableSlots as $time)
                                <option value="{{ $time }}">{{ $time }}</option>
                            @empty
                                <option value="">No slots available</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="form-label">Guests</label>
                        <input type="number" name="guests" class="form-control" min="1" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Occasion</label>
                        <select name="occasion" class="form-control">
                            <option value="">-- Select Occasion --</option>
                            <option value="Birthday">Birthday</option>
                            <option value="Anniversary">Anniversary</option>
                            <option value="Business">Business</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Promo Code</label>
                        <input type="text" name="promo_code" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone (Verification)</label>
                    <input type="tel" name="phone" id="phoneInput" class="form-control" style="width:100%;" required>
                    <div class="mt-2">
                        <button type="button" class="btn btn-secondary w-100" onclick="sendOTP()">Send SMS</button>
                    </div>
                </div>

                <div id="otp-section" class="mb-3" style="display: none;">
                    <label class="form-label">Enter OTP</label>
                    <input type="text" id="otpCode" class="form-control" maxlength="4" placeholder="1234">
                    <button type="button" class="btn btn-link p-0 mt-2" id="resendBtn" onclick="sendOTP()" disabled>
                        Resend OTP (<span id="timer">60</span>s)
                    </button>
                </div>

                <div class="mb-3">
                    <label class="form-label">Special Requests</label>
                    <textarea name="special_requests" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="marketing_optin" class="form-check-input" id="marketingOptin">
                    <label class="form-check-label" for="marketingOptin">I agree to receive promotional emails/SMS.</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Reserve</button>
                </div>

            </form>

        </div>
    </div>
@endsection
