<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BogTestWebhook extends Command
{
    protected $signature = 'bog:test-webhook {--scenario=success} {--url=}';
    protected $description = 'Simulate a BOG webhook payload for testing';

    public function handle()
    {
        $scenario = $this->option('scenario');
        $url = $this->option('url') ?? config('bog.callbacks.webhook');

        $payload = [
            'transaction_id' => 'TEST-' . now()->timestamp,
            'status' => $scenario,
            'amount' => 1.00,
            'currency' => 'GEL',
        ];

        $secret = config('bog.webhook.secret');
        $signature = $secret ? hash_hmac('sha256', json_encode($payload), $secret) : '';

        $this->info('Sending webhook to: ' . $url);

        try {
            // Send local POST without throwing on HTTP errors
            $response = Http::withHeaders([
                'X-BOG-Signature' => $signature,
                'Content-Type' => 'application/json',
            ])->post($url, $payload);

            $this->info('Response status: ' . $response->status());
            $this->line($response->body());

            Log::info('bog:test-webhook executed', ['scenario' => $scenario, 'url' => $url, 'status' => $response->status()]);
        } catch (\Exception $e) {
            $this->error('Failed to send webhook: ' . $e->getMessage());
            Log::error('bog:test-webhook failed', ['exception' => $e]);
            return 1;
        }

        $this->info('Webhook simulation complete');
        return 0;
    }
}
