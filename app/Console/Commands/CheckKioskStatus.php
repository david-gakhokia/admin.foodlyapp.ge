<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckKioskStatus extends Command
{
    protected $signature = 'kiosk:check-status';
    protected $description = 'Check kiosk devices status via API every 2 minutes';

    public function handle()
    {
        // თუ კლიენტის ტოკენი .env-ში გაქვთ გაწერილი
        $token = config('services.kiosk.token');

        // API URL, აიღეთ .env-დან ან კონფიგიდან
        $url = config('app.url').'/api/kiosk/status';

        //	Spring: შეგვიძლია HTTP Client-ით გამოვიძახოთ
        $response = Http::withToken($token)
            ->acceptJson()
            ->get($url);

        if ($response->successful()) {
            // JSON-ს იატვირთავს და გადააკონტროლებს
            $data = $response->json();
            Log::info('Kiosk status checked', $data);
        } else {
            Log::error('Failed to fetch kiosk status', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        }
    }
}
