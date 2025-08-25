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
        View::share('locales', config('translatable.locales'));

        // Register notification event listeners
        Event::listen([
            ReservationRequested::class,
            ReservationConfirmed::class,
            ReservationDeclined::class,
            ReservationPreArrivalDue::class,
        ], NotificationEventListener::class);
    }
}
