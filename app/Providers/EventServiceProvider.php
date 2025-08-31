<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\ReservationStatusChanged;
use App\Events\BOGPaymentStatusChanged;
use App\Listeners\Admin\QueueAdminReservationEmails;
use App\Listeners\Client\QueueClientReservationEmails;
use App\Listeners\Restaurant\QueueRestaurantReservationEmails;
use App\Listeners\HandleBOGPaymentNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ReservationStatusChanged::class => [
            QueueAdminReservationEmails::class,
            QueueClientReservationEmails::class,
            QueueRestaurantReservationEmails::class,
        ],
        BOGPaymentStatusChanged::class => [
            HandleBOGPaymentNotification::class,
        ],
    ];
}
