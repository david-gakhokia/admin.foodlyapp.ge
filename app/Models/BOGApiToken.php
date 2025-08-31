<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BOGApiToken extends Model
{
    protected $table = 'bog_api_tokens';
    
    protected $fillable = [
        'environment',
        'access_token',
        'token_type',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    /**
     * Get valid token for environment
     */
    public static function getValidToken(?string $environment = null): ?self
    {
        $environment = $environment ?? config('bog.environment');
        
        return static::where('environment', $environment)
            ->where('expires_at', '>', now()->addMinutes(5)) // 5 წუთით ადრე ვავადებთ
            ->first();
    }

    /**
     * Create or update token for environment
     */
    public static function storeToken(string $accessToken, int $expiresIn, ?string $environment = null): self
    {
        $environment = $environment ?? config('bog.environment');
        
        return static::updateOrCreate(
            ['environment' => $environment],
            [
                'access_token' => $accessToken,
                'token_type' => 'Bearer',
                'expires_at' => now()->addSeconds($expiresIn)
            ]
        );
    }

    /**
     * Check if token is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if token expires soon (within 5 minutes)
     */
    public function expiresSoon(): bool
    {
        return $this->expires_at->lessThan(now()->addMinutes(5));
    }

    /**
     * Get authorization header value
     */
    public function getAuthorizationHeader(): string
    {
        return $this->token_type . ' ' . $this->access_token;
    }
}
