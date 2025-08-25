<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Email Provider
    |--------------------------------------------------------------------------
    */
    'default_provider' => env('NOTIFICATION_DEFAULT_PROVIDER', 'sendgrid'),

    /*
    |--------------------------------------------------------------------------
    | Email Providers Configuration
    |--------------------------------------------------------------------------
    */
    'providers' => [
        'sendgrid' => [
            'api_key' => env('SENDGRID_API_KEY'),
            'from_email' => env('MAIL_FROM_ADDRESS', 'no-reply@foodly.space'),
            'from_name' => env('MAIL_FROM_NAME', 'FOODLY'),
            'rate_limit' => [
                'per_minute' => env('SENDGRID_RATE_LIMIT_PER_MINUTE', 100),
                'per_hour' => env('SENDGRID_RATE_LIMIT_PER_HOUR', 600),
            ],
            'templates' => [
                'reservation.requested.manager' => env('SENDGRID_TEMPLATE_RESERVATION_REQUESTED_MANAGER'),
                'reservation.requested.client' => env('SENDGRID_TEMPLATE_RESERVATION_REQUESTED_CLIENT'),
                'reservation.confirmed.client' => env('SENDGRID_TEMPLATE_RESERVATION_CONFIRMED_CLIENT'),
                'reservation.confirmed.manager' => env('SENDGRID_TEMPLATE_RESERVATION_CONFIRMED_MANAGER'),
                'reservation.declined.client' => env('SENDGRID_TEMPLATE_RESERVATION_DECLINED_CLIENT'),
                'reservation.declined.manager' => env('SENDGRID_TEMPLATE_RESERVATION_DECLINED_MANAGER'),
                'reservation.prearrival.client' => env('SENDGRID_TEMPLATE_RESERVATION_PREARRIVAL_CLIENT'),
            ],
        ],
        
        // Future providers can be added here
        'ses' => [
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    */
    'retry' => [
        'max_attempts' => env('NOTIFICATION_MAX_RETRY_ATTEMPTS', 5),
        'backoff_seconds' => [60, 300, 900, 3600, 10800], // 1m, 5m, 15m, 1h, 3h
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */
    'queue' => [
        'connection' => env('NOTIFICATION_QUEUE_CONNECTION', 'database'),
        'name' => env('NOTIFICATION_QUEUE_NAME', 'emails'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhook Configuration
    |--------------------------------------------------------------------------
    */
    'webhook' => [
        'sendgrid' => [
            'url' => env('SENDGRID_WEBHOOK_URL'),
            'verify_signature' => env('SENDGRID_WEBHOOK_VERIFY_SIGNATURE', true),
            'public_key' => env('SENDGRID_WEBHOOK_PUBLIC_KEY'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Pre-arrival Notification Settings
    |--------------------------------------------------------------------------
    */
    'pre_arrival' => [
        'enabled' => env('NOTIFICATION_PRE_ARRIVAL_ENABLED', true),
        'windows' => [
            24 * 60, // 24 hours before
            3 * 60,  // 3 hours before
            30,      // 30 minutes before
        ],
        'timezone' => env('APP_TIMEZONE', 'Asia/Tbilisi'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard Settings
    |--------------------------------------------------------------------------
    */
    'admin' => [
        'pagination' => 50,
        'refresh_interval' => 30, // seconds
    ],
];
