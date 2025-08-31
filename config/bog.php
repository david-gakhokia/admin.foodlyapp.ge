<?php

return [
    /*
    |--------------------------------------------------------------------------
    | BOG Payment Configuration
    |--------------------------------------------------------------------------
    |
    | Bank of Georgia (BOG) გადახდის სისტემის კონფიგურაცია
    |
    */

    'client_id' => env('BOG_CLIENT_ID'),
    'client_secret' => env('BOG_CLIENT_SECRET'),
    'environment' => env('BOG_ENVIRONMENT', 'sandbox'),
    'webhook_secret' => env('BOG_WEBHOOK_SECRET'),
    
    /*
    |--------------------------------------------------------------------------
    | BOG API URLs
    |--------------------------------------------------------------------------
    */
    
    'urls' => [
        'auth' => env('BOG_AUTH_URL', 'https://api.bog.ge/oauth2/token'),
        'payment' => env('BOG_PAYMENT_URL', 'https://api.bog.ge/payments/checkout'),
        'api' => env('BOG_API_URL', 'https://api.bog.ge'),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Callback URLs
    |--------------------------------------------------------------------------
    */
    
    'callbacks' => [
        'success' => env('BOG_SUCCESS_URL', env('APP_URL') . '/bog/payment/success'),
        'fail' => env('BOG_FAIL_URL', env('APP_URL') . '/bog/payment/fail'),
        'webhook' => env('BOG_WEBHOOK_URL', env('APP_URL') . '/bog/webhook'),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Payment Settings
    |--------------------------------------------------------------------------
    */
    
    'currency' => 'GEL',
    'timeout' => 30, // seconds for API requests
    'payment_expiry' => 24, // hours until payment expires
    
    /*
    |--------------------------------------------------------------------------
    | Webhook Configuration
    |--------------------------------------------------------------------------
    */
    
    'webhook' => [
        'secret' => env('BOG_WEBHOOK_SECRET'),
        'signature_validation' => env('BOG_WEBHOOK_SIGNATURE_VALIDATION', true),
        'rate_limit' => [
            'max_attempts' => env('BOG_WEBHOOK_RATE_LIMIT_ATTEMPTS', 60), // per minute
            'decay_minutes' => env('BOG_WEBHOOK_RATE_LIMIT_DECAY', 1),
        ],
        'allowed_ips' => [
            '185.17.47.0/24', // BOG production servers
            '10.0.0.0/8',     // Internal network (for testing)
            '127.0.0.1',      // Localhost (for testing)
            '192.168.0.0/16', // Local network (for testing)
        ],
        'timeout' => env('BOG_WEBHOOK_TIMEOUT', 10), // seconds
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    */
    
    'security' => [
        'token_cache_ttl' => env('BOG_TOKEN_CACHE_TTL', 3600), // seconds
        'max_retry_attempts' => env('BOG_MAX_RETRY_ATTEMPTS', 3),
        'retry_delay' => env('BOG_RETRY_DELAY', 5), // seconds
        'enable_logging' => env('BOG_ENABLE_LOGGING', true),
        'log_level' => env('BOG_LOG_LEVEL', 'info'),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Status Mappings
    |--------------------------------------------------------------------------
    */
    
    'status_mappings' => [
        'bog_to_transaction' => [
            'success' => 'completed',
            'captured' => 'completed',
            'completed' => 'completed',
            'failed' => 'failed',
            'declined' => 'failed',
            'insufficient_funds' => 'failed',
            'invalid_card' => 'failed',
            'cancelled' => 'cancelled',
            'voided' => 'cancelled',
            'user_cancelled' => 'cancelled',
            'refunded' => 'refunded',
            'partially_refunded' => 'refunded',
            'pending' => 'pending',
            'created' => 'pending',
            'in_progress' => 'processing',
            'processing' => 'processing',
        ],
        
        'bog_to_reservation' => [
            'success_statuses' => ['success', 'captured', 'completed'],
            'failure_statuses' => ['failed', 'declined', 'insufficient_funds', 'invalid_card'],
            'cancelled_statuses' => ['cancelled', 'voided', 'user_cancelled'],
            'refunded_statuses' => ['refunded', 'partially_refunded'],
        ]
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    */
    
    'logging' => [
        'enabled' => env('BOG_LOGGING_ENABLED', true),
        'level' => env('BOG_LOG_LEVEL', 'info'),
        'channel' => env('BOG_LOG_CHANNEL', 'stack'),
    ],
];
