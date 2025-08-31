<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ValidateBOGWebhookSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip validation in testing environment or when disabled
        if (app()->environment('testing') || !config('bog.webhook.signature_validation', true)) {
            Log::info('BOG webhook signature validation skipped', [
                'environment' => app()->environment(),
                'validation_enabled' => config('bog.webhook.signature_validation', true)
            ]);
            return $next($request);
        }

        $signature = $request->header('X-BOG-Signature');
        $payload = $request->getContent();

        if (!$signature) {
            Log::warning('BOG webhook missing signature', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'headers' => $request->headers->all()
            ]);

            return response()->json([
                'error' => 'Missing webhook signature'
            ], 401);
        }

        if (!$this->validateSignature($signature, $payload)) {
            Log::error('BOG webhook invalid signature', [
                'ip' => $request->ip(),
                'signature' => $signature,
                'payload_length' => strlen($payload),
                'user_agent' => $request->userAgent()
            ]);

            return response()->json([
                'error' => 'Invalid webhook signature'
            ], 401);
        }

        Log::info('BOG webhook signature validated successfully', [
            'ip' => $request->ip(),
            'payload_length' => strlen($payload)
        ]);

        return $next($request);
    }

    /**
     * Validate webhook signature
     */
    private function validateSignature(string $signature, string $payload): bool
    {
        $webhookSecret = config('bog.webhook.secret');
        
        if (!$webhookSecret) {
            Log::error('BOG webhook secret not configured');
            return false;
        }

        // Remove 'sha256=' prefix if present
        $cleanSignature = str_replace('sha256=', '', $signature);
        
        // Calculate expected signature
        $expectedSignature = hash_hmac('sha256', $payload, $webhookSecret);
        
        // Use hash_equals for timing attack protection
        return hash_equals($expectedSignature, $cleanSignature);
    }
}
