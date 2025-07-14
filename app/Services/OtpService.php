<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OtpService
{
    public function sendOtp(string $phone): string
    {
        $code = rand(1000, 9999);

        Cache::put('otp_' . $phone, $code, now()->addMinutes(5));

        // Log for debugging, replace with real SMS integration
        Log::info("[OTP] Sent to {$phone}: {$code}");

        return $code;
    }

    public function verifyOtp(string $phone, string $code): bool
    {
        $cachedCode = Cache::get('otp_' . $phone);

        return $cachedCode && $cachedCode == $code;
    }
}
