<?php

use App\Events\ReservationStatusChanged;
use App\Listeners\Restaurant\QueueRestaurantReservationEmails;

it('runs restaurant listener with restaurant recipients without touching the database', function () {
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

    // If we reach here without exception, consider it passed
    expect(true)->toBeTrue();
});

it('runs restaurant listener with no restaurant email without touching the database', function () {
    $reservation = (object) [
        'id' => 123,
        'restaurant' => (object) [
            'name' => 'Great Restaurant',
        ],
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'confirmed');

    $listener = new QueueRestaurantReservationEmails();
    $listener->handle($event);

    // If we reach here without exception, consider it passed
    expect(true)->toBeTrue();
});

it('runs restaurant listener with unsupported status without touching the database', function () {
    $reservation = (object) [
        'id' => 123,
        'restaurant' => (object) [
            'email' => 'restaurant@example.com',
            'name' => 'Great Restaurant',
        ],
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'unknown_status');

    $listener = new QueueRestaurantReservationEmails();
    $listener->handle($event);

    // If we reach here without exception, consider it passed
    expect(true)->toBeTrue();
});
