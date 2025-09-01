<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Listeners\NotificationEventListener;
use App\Domain\Reservations\Events\ReservationRequested;
use App\Domain\Reservations\Events\ReservationConfirmed;
use App\Domain\Reservations\Events\ReservationDeclined;
use App\Domain\Reservations\Events\ReservationPreArrivalDue;
use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register BOG webhook middleware aliases for route usage
        if (method_exists(Route::class, 'aliasMiddleware')) {
            Route::aliasMiddleware('bog.webhook.rate_limit', \App\Http\Middleware\BOGWebhookRateLimit::class);
            Route::aliasMiddleware('bog.webhook.signature', \App\Http\Middleware\ValidateBOGWebhookSignature::class);
        }

        View::share('locales', config('translatable.locales'));

        // Register notification event listeners
        Event::listen([
            ReservationRequested::class,
            ReservationConfirmed::class,
            ReservationDeclined::class,
            ReservationPreArrivalDue::class,
        ], NotificationEventListener::class);

        // Configure Horizon authorization
        Horizon::auth(function ($request) {
            return $request->user() && $request->user()->hasRole('admin');
        });
    }
}
