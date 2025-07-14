<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SmsService;

class PhoneVerificationController extends Controller
{
    protected $sms;

    public function __construct(SmsService $sms)
    {
        $this->sms = $sms;
    }

    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        $this->sms->sendOtp($request->phone);

        return response()->json(['status' => 'pending']);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'code'  => 'required|string'
        ]);

        if ($this->sms->verifyOtp($request->phone, $request->code)) {
            return response()->json(['status' => 'verified']);
        }

        return response()->json(['status' => 'invalid']);
    }
}
