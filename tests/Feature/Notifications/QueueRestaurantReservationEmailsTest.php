<?php

use App\Events\ReservationStatusChanged;
use App\Jobs\SendRestaurantReservationEmail;
use App\Listeners\Restaurant\QueueRestaurantReservationEmails;
use Illuminate\Support\Facades\Bus;

it('dispatches jobs for restaurant recipients when status changes', function () {
    Bus::fake();

    $reservation = (object) [
        'id' => 123,
        'restaurant' => (object) [
            'email' => 'restaurant@example.com',
            'name' => 'Great Restaurant',
        ],
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueRestaurantReservationEmails();
    $listener->handle($event);

    Bus::assertDispatched(SendRestaurantReservationEmail::class);
});

it('handles restaurant managers email list', function () {
    Bus::fake();

    $reservation = (object) [
        'id' => 123,
        'restaurant' => (object) [
            'email' => 'restaurant@example.com',
            'managers' => [
                (object)['email' => 'manager1@example.com'],
                (object)['email' => 'manager2@example.com'],
            ]
        ],
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueRestaurantReservationEmails();
    $listener->handle($event);

    Bus::assertDispatched(SendRestaurantReservationEmail::class, 3); // restaurant + 2 managers
});

it('skips when no restaurant recipients found', function () {
    Bus::fake();

    $reservation = (object) [
        'id' => 123,
        'restaurant' => (object) [
            'name' => 'Great Restaurant',
            // no email fields
        ],
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueRestaurantReservationEmails();
    $listener->handle($event);

    Bus::assertNotDispatched(SendRestaurantReservationEmail::class);
});
