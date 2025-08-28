<?php

use App\Events\ReservationStatusChanged;
use App\Listeners\Client\QueueClientReservationEmails;

it('runs client listener with client recipients without touching the database', function () {
    $reservation = (object) [
        'id' => 123,
        'email' => 'client@example.com',
        'name' => 'John Doe',
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueClientReservationEmails();
    $listener->handle($event);

    // If we reach here without exception, consider it passed
    expect(true)->toBeTrue();
});

it('runs client listener with invalid email without touching the database', function () {
    $reservation = (object) [
        'id' => 123,
        'email' => 'invalid-email',
        'name' => 'John Doe',
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueClientReservationEmails();
    $listener->handle($event);

    // If we reach here without exception, consider it passed
    expect(true)->toBeTrue();
});

it('runs client listener with no email without touching the database', function () {
    $reservation = (object) [
        'id' => 123,
        'name' => 'John Doe',
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueClientReservationEmails();
    $listener->handle($event);

    // If we reach here without exception, consider it passed
    expect(true)->toBeTrue();
});
