<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class BOGServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Register route middleware aliases if HTTP Kernel not directly editable
        if (method_exists(Route::class, 'aliasMiddleware')) {
            Route::aliasMiddleware('bog.webhook.rate_limit', \App\Http\Middleware\BOGWebhookRateLimit::class);
            Route::aliasMiddleware('bog.webhook.signature', \App\Http\Middleware\ValidateBOGWebhookSignature::class);
        }
    }
}
