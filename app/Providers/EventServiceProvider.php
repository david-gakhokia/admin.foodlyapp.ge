<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\ReservationStatusChanged;
use App\Listeners\Admin\QueueAdminReservationEmails;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ReservationStatusChanged::class => [
            QueueAdminReservationEmails::class,
        ],
    ];
}
