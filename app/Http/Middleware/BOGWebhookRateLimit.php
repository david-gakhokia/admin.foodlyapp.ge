<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class BOGWebhookRateLimit
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $this->resolveRequestSignature($request);
        $maxAttempts = config('bog.webhook.rate_limit.max_attempts', 60);
        $decayMinutes = config('bog.webhook.rate_limit.decay_minutes', 1);

        // Check rate limit
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            Log::warning('BOG webhook rate limit exceeded', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'key' => $key,
                'max_attempts' => $maxAttempts
            ]);

            return response()->json([
                'error' => 'Too many webhook requests',
                'retry_after' => RateLimiter::availableIn($key)
            ], 429);
        }

        // Check IP whitelist if configured
        if ($this->isIPBlocked($request)) {
            Log::warning('BOG webhook blocked - IP not whitelisted', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return response()->json([
                'error' => 'Unauthorized IP address'
            ], 403);
        }

        // Increment rate limiter
        RateLimiter::hit($key, $decayMinutes * 60);

        Log::info('BOG webhook request processed', [
            'ip' => $request->ip(),
            'remaining_attempts' => max(0, $maxAttempts - RateLimiter::attempts($key))
        ]);

        return $next($request);
    }

    /**
     * Resolve request signature for rate limiting
     */
    private function resolveRequestSignature(Request $request): string
    {
        // Use IP + User-Agent for more specific rate limiting
        return 'bog_webhook:' . sha1(
            ($request->ip() ?? 'unknown') . '|' . ($request->userAgent() ?? '')
        );
    }

    /**
     * Check if IP is blocked (not in whitelist)
     */
    private function isIPBlocked(Request $request): bool
    {
        $allowedIPs = config('bog.webhook.allowed_ips', []);
        
        // If no whitelist configured, allow all
        if (empty($allowedIPs)) {
            return false;
        }

        $clientIP = $request->ip();

        foreach ($allowedIPs as $allowedIP) {
            if ($this->ipMatches($clientIP, $allowedIP)) {
                return false; // IP is allowed
            }
        }

        return true; // IP is blocked
    }

    /**
     * Check if IP matches the allowed pattern (supports CIDR)
     */
    private function ipMatches(string $clientIP, string $allowedIP): bool
    {
        // Exact match
        if ($clientIP === $allowedIP) {
            return true;
        }

        // CIDR notation support
        if (strpos($allowedIP, '/') !== false) {
            return $this->ipInCIDR($clientIP, $allowedIP);
        }

        return false;
    }

    /**
     * Check if IP is in CIDR range
     */
    private function ipInCIDR(string $ip, string $cidr): bool
    {
        [$subnet, $mask] = explode('/', $cidr);

        $ipLong = ip2long($ip);
        $subnetLong = ip2long($subnet);
        $maskLong = -1 << (32 - (int)$mask);

        return ($ipLong & $maskLong) === ($subnetLong & $maskLong);
    }
}
