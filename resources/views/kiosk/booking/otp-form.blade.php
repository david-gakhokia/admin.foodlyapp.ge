<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lead Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.min.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="flex items-center justify-center min-h-screen px-2 sm:px-0">

    <form id="lead-form"
        class="bg-white px-4 py-6 sm:px-6 md:p-8 rounded-lg shadow-md w-full max-w-md w-full sm:w-11/12 space-y-6 border-t border-gray-300">
        <img src="https://foodly.space/assets/images/logo.png" width="200" class="mb-4 mx-auto block">

        <div class="grid grid-cols-1 sm:grid-cols-0 gap-2">
            {{-- <input type="hidden" name="utm_source" value="{{ request('utm_source') }}">
            <input type="hidden" name="utm_medium" value="{{ request('utm_medium') }}">

            <input type="hidden" name="utm_campaign" value="{{ request('utm_campaign', request('campaignid')) }}">
            <input type="hidden" name="utm_content" value="{{ request('utm_content', request('adgroupid')) }}">
            <input type="hidden" name="utm_term" value="{{ request('utm_term', request('keyword')) }}"> --}}
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
                        <option value="">No slots available</option>
                    @endforelse
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600">Purpose of Buying</label>
                <select name="purpose" required class="w-full mt-1 border rounded px-3 py-2 text-sm">
                    <option value="">Select</option>
                    <option value="Investment">Investment</option>
                    <option value="Living">Living</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600">Project Type</label>
                <select name="project_type" required class="w-full mt-1 border rounded px-3 py-2 text-sm">
                    <option value="">Select</option>
                    <option value="Completed">Completed</option>
                    <option value="On Going">On Going</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-1200">Payment Method</label>
                <select name="payment" required class="w-full mt-1 border rounded px-3 py-2 text-sm">
                    <option value="">Select</option>
                    <option value="Full">Full Payment</option>
                    <option value="Installments">Installments</option>
                </select>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-0 gap-2">
            <div>
                <label class="block text-sm text-gray-600">Full Name</label>
                <input type="text" name="name" value="" required
                    class="w-full mt-1 border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm text-gray-600">Email</label>
                <input type="email" name="email" value=""
                    class="w-full mt-1 border rounded px-3 py-2 text-sm">
            </div>
            <div class="col-span-full">
                <label class="block text-sm text-gray-600">Phone</label>
                <div class="flex space-x-2 mt-1">
                    <input id="phoneInput" name="phone" type="tel" value="" required
                        class="w-full border rounded px-3 py-2 text-sm">
                    <button type="button" onclick="sendOTP()"
                        class="inline-block text-white text-xs px-3 py-2 rounded transition whitespace-nowrap"
                        style="background-color: #FF9C00;">
                        Send Code &nbsp; <i class="fa fa-comments" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div id="otp-section" style="display:none;" class="space-y-2 col-span-full">
                <label class="block text-sm text-gray-600">Enter Code</label>
                <input type="number" id="otpCode" placeholder="1234" class="w-full border rounded px-3 py-2 text-sm"
                    maxlength="4" autocomplete="one-time-code">
                <div class="flex items-center space-x-4">

                    <button type="button" id="resendBtn" onclick="sendOTP()" class="text-gray-500 hover:underline"
                        disabled>
                        Resend Code (<span id="timer">60</span>s)
                    </button>
                </div>

            </div>

        </div>


        <button type="submit" id="submitBtn" disabled class="w-full text-white py-2 px-4 rounded text-sm transition"
            style="background-color: #000000;">
            Submit
        </button>
    </form>
    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let phoneNumber = '';
        let verified = false;
        let countdown = 60;
        let resendInterval;

        function sendOTP() {
            const isValid = iti.isValidNumber();
            if (!isValid) return alert("Please enter a valid phone number.");
            phoneNumber = iti.getNumber();
            document.getElementById('otp-section').style.display = 'block';

            fetch('/api/send-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify({
                        phone: phoneNumber
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'pending') {
                        Swal.fire('Verification Code Sent!', `sent to ${phoneNumber}`, 'success');
                        startResendTimer();
                        // Reset OTP input for new try
                        const otpInput = document.getElementById('otpCode');
                        otpInput.value = '';
                        otpInput.disabled = false;
                        otpInput.classList.remove('border-green-500', 'border-red-500');
                        verified = false;
                        document.getElementById('submitBtn').disabled = true;
                    } else {
                        Swal.fire('Error', 'Failed to send OTP', 'error');
                    }
                });
        }

        function startResendTimer() {
            const timerSpan = document.getElementById('timer');
            const resendBtn = document.getElementById('resendBtn');
            resendBtn.disabled = true;
            resendBtn.classList.add('opacity-50', 'cursor-not-allowed');
            countdown = 60;
            timerSpan.innerText = countdown;
            clearInterval(resendInterval);
            resendInterval = setInterval(() => {
                countdown--;
                timerSpan.innerText = countdown;
                if (countdown <= 0) {
                    clearInterval(resendInterval);
                    resendBtn.disabled = false;
                    resendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    timerSpan.innerText = '0';
                }
            }, 1000);
        }

        // OTP input ლოგიკა
        document.getElementById('otpCode').addEventListener('input', function() {
            const code = this.value;
            const submitBtn = document.getElementById('submitBtn');
            // შეცვალე 4-ზე თუ 4-ნიშნა კოდია
            if (code.length < 4) {
                this.classList.remove('border-green-500', 'border-red-500');
                submitBtn.disabled = true;
                verified = false;
                return;
            }
            fetch('api/verify-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify({
                        phone: phoneNumber,
                        code
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'verified') {
                        verified = true;
                        submitBtn.disabled = false;
                        this.classList.remove('border-red-500');
                        this.classList.add('border-green-500');
                    } else {
                        verified = false;
                        submitBtn.disabled = true;
                        this.classList.remove('border-green-500');
                        this.classList.add('border-red-500');
                    }
                });
        });

        // Submit ლოგიკა
        document.getElementById('lead-form').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!phoneNumber) {
                Swal.fire('Info', 'Please click "Send Code" to verify your phone number.', 'info');
                return;
            }
            if (!verified) return alert("Please verify your phone code.");
            // აქ ჩასვით სრული ნომერი input-ში
            document.getElementById('phoneInput').value = iti.getNumber();


            const formData = Object.fromEntries(new FormData(this).entries());
            fetch('api/submit-lead', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify(formData)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                });

        });

        const phoneInputField = document.querySelector("#phoneInput");
        const iti = window.intlTelInput(phoneInputField, {
            initialCountry: "auto", // შეცვალეთ "ge" "auto"-თი
            geoIpLookup: function(callback) {
                fetch('https://ipapi.co/json')
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(data) {
                        callback(data.country_code);
                    })
                    .catch(function() {
                        callback('us');
                    }); // სარეზერვო ქვეყანა, თუ API ვერ მოხერხდა
            },
            preferredCountries: ["ge", "us", "ae", "gb"],
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"
        });
    </script>

</body>

</html>
