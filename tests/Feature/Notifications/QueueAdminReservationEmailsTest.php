<?php

use App\Events\ReservationStatusChanged;
use App\Jobs\SendAdminReservationEmail;
use App\Listeners\Admin\QueueAdminReservationEmails;
use Illuminate\Support\Facades\Bus;

it('dispatches jobs for admin recipients when status changes', function () {
    Bus::fake();

    $reservation = (object) [
        'restaurant' => (object) [
            'admins' => [ (object)['email' => 'a@ex.com'], (object)['email' => 'b@ex.com'] ]
        ],
    ];

    $event = new ReservationStatusChanged($reservation, null, 'confirmed');

    $listener = new QueueAdminReservationEmails();
    $listener->handle($event);

    Bus::assertDispatched(SendAdminReservationEmail::class);
});
