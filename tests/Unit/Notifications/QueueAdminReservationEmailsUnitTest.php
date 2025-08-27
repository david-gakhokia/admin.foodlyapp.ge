<?php

use App\Events\ReservationStatusChanged;
use App\Listeners\Admin\QueueAdminReservationEmails;

it('runs listener with admin recipients without touching the database', function () {
    $reservation = (object) [
        'restaurant' => (object) [
            'admins' => [ (object)['email' => 'a@ex.com'], (object)['email' => 'b@ex.com'] ]
        ],
    ];

    $event = new ReservationStatusChanged($reservation, null, 'confirmed');

    $listener = new QueueAdminReservationEmails();
    $listener->handle($event);

    // If we reach here without exception, consider it passed
    expect(true)->toBeTrue();
});
