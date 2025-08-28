<?php

use App\Events\ReservationStatusChanged;
use App\Jobs\SendClientReservationEmail;
use App\Listeners\Client\QueueClientReservationEmails;
use Illuminate\Support\Facades\Bus;

it('dispatches jobs for client recipients when status changes', function () {
    Bus::fake();

    $reservation = (object) [
        'id' => 123,
        'email' => 'client@example.com',
        'name' => 'John Doe',
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueClientReservationEmails();
    $listener->handle($event);

    Bus::assertDispatched(SendClientReservationEmail::class);
});

it('handles multiple client email fields', function () {
    Bus::fake();

    $reservation = (object) [
        'id' => 123,
        'email' => 'primary@example.com',
        'client_email' => 'secondary@example.com',
        'name' => 'John Doe',
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueClientReservationEmails();
    $listener->handle($event);

    Bus::assertDispatched(SendClientReservationEmail::class, 2);
});

it('skips invalid email addresses for client', function () {
    Bus::fake();

    $reservation = (object) [
        'id' => 123,
        'email' => 'invalid-email',
        'name' => 'John Doe',
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueClientReservationEmails();
    $listener->handle($event);

    Bus::assertNotDispatched(SendClientReservationEmail::class);
});
