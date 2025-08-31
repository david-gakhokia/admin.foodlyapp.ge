<?php

namespace App\Services\BOG;

use App\Models\BOGApiToken;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class BOGAuthService
{
    private string $clientId;
    private string $clientSecret;
    private string $authUrl;
    private string $environment;

    public function __construct()
    {
        $this->clientId = config('bog.client_id');
        $this->clientSecret = config('bog.client_secret');
        $this->authUrl = config('bog.urls.auth');
        $this->environment = config('bog.environment');
    }

    /**
     * Get valid access token (from cache or new request)
     */
    public function getAccessToken(): string
    {
        // Check for valid cached token
        $cachedToken = BOGApiToken::getValidToken($this->environment);
        
        if ($cachedToken && !$cachedToken->expiresSoon()) {
            Log::info('BOG: Using cached access token');
            return $cachedToken->access_token;
        }

        // Request new token
        return $this->requestNewToken();
    }

    /**
     * Request new access token from BOG API
     */
    public function requestNewToken(): string
    {
        try {
            Log::info('BOG: Requesting new access token', [
                'client_id' => $this->clientId,
                'environment' => $this->environment,
                'auth_url' => $this->authUrl
            ]);

            // BOG OAuth2 uses Basic Auth with username/password
            $response = Http::timeout(config('bog.timeout'))
                ->asForm()
                ->withBasicAuth($this->clientId, $this->clientSecret)
                ->post($this->authUrl, [
                    'grant_type' => 'client_credentials',
                    'scope' => 'email profile' // BOG-ის scope
                ]);

            if (!$response->successful()) {
                Log::error('BOG Auth API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers()
                ]);
                throw new Exception('BOG Auth API Error: ' . $response->body());
            }

            $data = $response->json();

            if (!isset($data['access_token']) || !isset($data['expires_in'])) {
                throw new Exception('Invalid BOG Auth response: missing access_token or expires_in');
            }

            // Cache the token
            BOGApiToken::storeToken(
                $data['access_token'],
                $data['expires_in'],
                $this->environment
            );

            Log::info('BOG: Successfully obtained new access token', [
                'expires_in' => $data['expires_in'],
                'token_type' => $data['token_type'] ?? 'Bearer',
                'scope' => $data['scope'] ?? null
            ]);

            return $data['access_token'];

        } catch (Exception $e) {
            Log::error('BOG Auth Error', [
                'message' => $e->getMessage(),
                'client_id' => $this->clientId,
                'auth_url' => $this->authUrl
            ]);

            throw new Exception('Failed to authenticate with BOG: ' . $e->getMessage());
        }
    }

    /**
     * Get authorization header for API requests
     */
    public function getAuthorizationHeader(): string
    {
        return 'Bearer ' . $this->getAccessToken();
    }

    /**
     * Test BOG authentication
     */
    public function testAuthentication(): array
    {
        try {
            $token = $this->getAccessToken();
            
            return [
                'success' => true,
                'message' => 'BOG authentication successful',
                'token_preview' => substr($token, 0, 20) . '...',
                'environment' => $this->environment
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'BOG authentication failed: ' . $e->getMessage(),
                'environment' => $this->environment
            ];
        }
    }

    /**
     * Force refresh token (clear cache and get new)
     */
    public function refreshToken(): string
    {
        // Clear cached token
        BOGApiToken::where('environment', $this->environment)->delete();
        
        return $this->requestNewToken();
    }

    /**
     * Revoke current token (logout)
     */
    public function revokeToken(): void
    {
        BOGApiToken::where('environment', $this->environment)->delete();
        Log::info('BOG: Token revoked for environment: ' . $this->environment);
    }
}
