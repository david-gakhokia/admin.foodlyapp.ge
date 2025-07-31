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
            width: 100%;
        }

        .intl-tel-input .selected-flag {
            z-index: 100 !important;
        }

        .btn-light {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            padding: 0.3rem 0.8rem;
            font-weight: 500;
        }
    </style>
@endsection



@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-" style="min-height: 80vh;">
        <div class="card p-4" style="max-width: 500px; width: 100%;">
            <div class="text-center mb-2">
                <a href ="#" class="text-decoration-none">
                    <img src="https://foodly.space/assets/images/logo.png" width="150" alt="FOODLY">
                </a>
            </div>

            <h2 class="text-center mb-2 fw-bold" style="font-size: 1.2rem;">Reserv - {{ $restaurant->name }}</h2>

            <form method="POST" action="{{ route('booking-api.restaurant.reserve', $restaurant->slug) }}">
                @csrf

                <div class="row">
                    <div class="col-6 mb-1">
                        <label class="form-label">Date</label>
                        <input type="date" name="reservation_date"
                            class="form-control @error('reservation_date') is-invalid @enderror"
                            value="{{ old('reservation_date', request('reservation_date', now()->toDateString())) }}"
                            min="{{ now()->toDateString() }}" required
                            onchange="window.location='?reservation_date='+this.value">
                        @error('reservation_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6 mb-1">
                        <label class="form-label">Time</label>
                        <select name="reservation_time" class="form-control @error('reservation_time') is-invalid @enderror"
                            required>
                            <option value=""> -- Set Time -- </option>
                            @foreach ($availableSlots as $time)
                                <option value="{{ $time }}" @if (old('reservation_time') == $time) selected @endif>
                                    {{ $time }}
                                </option>
                            @endforeach
                        </select>
                        @error('reservation_time')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row">

                    <div class="col-12 mb-1">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            required value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-6 mb-1">
                        <label class="form-label">Guests</label>
                        <select name="guests_count" class="form-control">
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" @if (old('guests_count') == $i) selected @endif>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        @error('guests_count')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6 mb-1">
                        <label class="form-label">Occasion</label>
                        <select name="occasion" class="form-control @error('occasion') is-invalid @enderror">
                            <option value="">-- Select Occasion --</option>
                            <option value="Birthday">Birthday</option>
                            <option value="Anniversary">Anniversary</option>
                            <option value="Business">Business</option>
                            <option value="Other">Other</option>

                        </select>
                    </div>

                    <div class="col-12 mb-1 mt-1">
                        <label class="form-label">Phone Verification ( OTP ) </label>
                        <input type="tel" name="phone" id="phoneInput"
                            class="form-control @error('phone') is-invalid @enderror" required value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
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
                    <div class="col-12 mb-2">
                        <label class="form-label">Special Requests</label>
                        <textarea name="special_requests" class="form-control" rows="2"></textarea>
                    </div>

                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Reserve</button>
                </div>
            </form>
        </div>


    </div>

    {{-- <div class="container d-flex justify-content-center align-items-center" style="margin-top: 30px;">
        <div class="btn-group" role="group">
            <a href="?locale=en" class="btn btn-outline-secondary px-4">EN</a>
            <a href="?locale=ka" class="btn btn-outline-secondary px-4">KA</a>
            <a href="?locale=ru" class="btn btn-outline-secondary px-4">RU</a>
        </div>
    </div> --}}
@endsection




@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"></script>

    <script>
        const phoneInputField = document.querySelector("#phoneInput");
        const iti = window.intlTelInput(phoneInputField, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch('https://ipapi.co/json')
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback('us'));
            },
            preferredCountries: ["ge", "us", "ae", "gb"],
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"
        });

        document.querySelector("form").addEventListener("submit", function(e) {
            if (!iti.isValidNumber()) {
                e.preventDefault();
                alert("Please enter a valid phone number.");
                return false;
            }
            phoneInputField.value = iti.getNumber();
        });

        let verified = false;
        let countdown;
        let resendInterval;

        function sendOTP() {
            if (!iti.isValidNumber()) {
                alert("Please enter a valid phone number.");
                return;
            }
            const phone = iti.getNumber();

            fetch("/api/phone/send-otp", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        phone
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'pending') {
                        document.getElementById("otp-section").style.display = 'block';
                        startResendTimer();
                    } else {
                        alert("Failed to send OTP.");
                    }
                });
        }

        function startResendTimer() {
            const resendBtn = document.getElementById("resendBtn");
            const timerSpan = document.getElementById("timer");
            resendBtn.disabled = true;
            countdown = 60;
            timerSpan.textContent = countdown;

            clearInterval(resendInterval);
            resendInterval = setInterval(() => {
                countdown--;
                timerSpan.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(resendInterval);
                    resendBtn.disabled = false;
                }
            }, 1000);
        }

        document.getElementById("otpCode").addEventListener("input", function() {
            const code = this.value;
            const phone = iti.getNumber();
            if (code.length < 4) {
                document.getElementById("submitBtn").disabled = true;
                return;
            }

            fetch("/api/phone/verify-otp", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        phone,
                        code
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'verified') {
                        verified = true;
                        document.getElementById("submitBtn").disabled = false;
                    } else {
                        verified = false;
                        document.getElementById("submitBtn").disabled = true;
                    }
                });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const successMsg = document.getElementById("success-message");
            if (successMsg) {
                setTimeout(() => {
                    successMsg.style.display = 'none';
                }, 3000);
            }
        });
    </script>
@endpush
