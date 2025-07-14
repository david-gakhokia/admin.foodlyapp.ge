<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://smsoffice.ge/api/v2/',
        ]);
    }

    public function sendSms($recipient, $message, $urgent = false)
    {
        $options = [
            'form_params' => [
                'key' => config('services.smsoffice.key'),
                'destination' => $recipient,
                'sender' => config('services.smsoffice.sender'),
                'content' => $message,
            ],
        ];

        if ($urgent) {
            $options['form_params']['urgent'] = 'true';
        }

        try {
            $response = $this->client->post('send/', $options);
            return json_decode($response->getBody());
        } catch (\Exception $e) {
            Log::error($e);
            return null;
        }
    }

    // --------------- OTP Integration -----------------

    public function sendOtp(string $phone): string
    {
        $code = rand(1000, 9999);
        Cache::put('otp_' . $phone, $code, now()->addMinutes(5));

        $message = "FOODLY Verification Code: {$code}";
        $this->sendSms($phone, $message);

        Log::info("[OTP] Sent to {$phone}: {$code}");

        return $code;
    }

    public function verifyOtp(string $phone, string $code): bool
    {
        $cachedCode = Cache::get('otp_' . $phone);
        return $cachedCode && $cachedCode == $code;
    }
}
