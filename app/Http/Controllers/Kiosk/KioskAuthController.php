<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kiosk;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KioskAuthController extends Controller
{
    /**
     * კონსტრუქტორი, სადაც Sanctum-ის middleware-ს ვაყენებთ
     */
    public function test()
    {
        return response()->json([
            'message' => 'Kiosk API is up and running!'
        ], 200);
    }


    public function login(Request $request)
    {

        // ვალიდაცია
        $data = $request->validate([
            'identifier' => 'required|string|exists:kiosks,identifier',
            'secret'     => 'required|string',
        ]);

        // Kiosk-ს მოძებნა
        $kiosk = Kiosk::where('identifier', $data['identifier'])->first();

        // საკეტი გადაამოწმე
        if (! $kiosk || ! Hash::check($data['secret'], $kiosk->secret)) {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        // ტოკენის შექმნა
        $token = $kiosk->createToken('kiosk-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'kiosk'        => $kiosk // Optionally return kiosk data
        ], 200);
    }


    /**
     * აპარატის „გულსცემა“:
     * 1) გადმოგზავნილი ტოკენით ვპოულობთ Kiosk–ს
     * 2) ვაახლებთ last_seen = now()
     * 3) ვაბრუნებთ alive სტატუსსა და სიაახლეს
     */
    public function heartbeat(Request $request)
    {
        $now = Carbon::now();

        /** @var Kiosk $kiosk */
        $kiosk = $request->user();

        // direct assignment და save
        $kiosk->last_seen = $now;
        $kiosk->save();

        return response()->json([
            'status'    => 'alive',
            'last_seen' => $now->toIso8601String(),
        ], 200);
    }

    public function status()
    {
        // დააფიქსირეთ, რომ 5 წუთზე ახალი heartbeat ითვლება online
        $threshold = Carbon::now()->subMinutes(5);

        $devices = Kiosk::all()->map(function (Kiosk $kiosk) use ($threshold) {
            return [
                'identifier' => $kiosk->identifier,
                'name'       => $kiosk->name,
                'last_seen'  => optional($kiosk->last_seen)->toIso8601String(),
                'status'     => $kiosk->last_seen && $kiosk->last_seen->gt($threshold)
                    ? 'online' : 'offline',
            ];
        });

        return response()->json([
            'threshold_minutes' => 5,
            'devices'           => $devices,
        ], 200);
    }


    public function config(Request $request)
    {
        $device = $request->user(); // kiosk მოწყობილობა, რომელიც ავტორიზებულია Sanctum-ის მეშვეობით

        return response()->json([
            'identifier' => $device->identifier,
            'name'       => $device->name,
            'location'   => $device->location,
            'mode'       => $device->mode ?? 'default',
            'content'    => $device->content ?? [],
            'status'     => $device->status,
            'last_seen'  => $device->last_seen,
        ]);
    }


    /**
     * ტოკენის გაუქმება (logout)
     */
    public function logout(Request $request)
    {
        // მიმდინარე ტოკენის წაშლა
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

        return response()->json([
            'message' => 'Logged out successfully.'
        ], 200);
    }

    
}
