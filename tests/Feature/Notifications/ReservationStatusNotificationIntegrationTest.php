<?php

use App\Events\ReservationStatusChanged;
use App\Jobs\SendAdminReservationEmail;
use App\Jobs\SendClientReservationEmail;
use App\Jobs\SendRestaurantReservationEmail;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;

it('dispatches all notification types when status changes', function () {
    Bus::fake();

    $reservation = (object) [
        'id' => 123,
        'email' => 'client@example.com',
        'name' => 'John Doe',
        'restaurant' => (object) [
            'email' => 'restaurant@example.com',
            'name' => 'Great Restaurant',
            'admins' => [
                (object)['email' => 'admin@example.com'],
            ]
        ],
    ];

    // Dispatch the event
    ReservationStatusChanged::dispatch($reservation, 'pending', 'confirmed');

    // Assert all three types of emails are dispatched
    Bus::assertDispatched(SendAdminReservationEmail::class);
    Bus::assertDispatched(SendClientReservationEmail::class);
    Bus::assertDispatched(SendRestaurantReservationEmail::class);
});

it('handles status change from Livewire component', function () {
    Bus::fake();

    $reservation = \App\Models\Reservation::factory()->create([
        'status' => 'Pending',
        'email' => 'client@example.com',
    ]);

    // Simulate what happens in ReservationStatusUpdater
    $oldStatus = $reservation->status;
    $newStatus = 'Confirmed';
    
    $reservation->update(['status' => $newStatus]);
    
    ReservationStatusChanged::dispatch($reservation, $oldStatus, $newStatus);

    // Assert emails are dispatched
    Bus::assertDispatched(SendClientReservationEmail::class);
    // Note: Admin and Restaurant emails might not be dispatched if those relationships don't exist in factory
});

it('does not dispatch emails for unsupported status', function () {
    Bus::fake();

    $reservation = (object) [
        'id' => 123,
        'email' => 'client@example.com',
        'name' => 'John Doe',
    ];

    $event = new ReservationStatusChanged($reservation, 'pending', 'unknown_status');
    
    // Manually handle each listener since unsupported status won't create mailables
    $adminListener = new \App\Listeners\Admin\QueueAdminReservationEmails();
    $clientListener = new \App\Listeners\Client\QueueClientReservationEmails();
    $restaurantListener = new \App\Listeners\Restaurant\QueueRestaurantReservationEmails();
    
    $adminListener->handle($event);
    $clientListener->handle($event);
    $restaurantListener->handle($event);

    Bus::assertNotDispatched(SendAdminReservationEmail::class);
    Bus::assertNotDispatched(SendClientReservationEmail::class);
    Bus::assertNotDispatched(SendRestaurantReservationEmail::class);
});
