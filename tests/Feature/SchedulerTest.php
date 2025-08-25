<?php

use App\Models\Reservation;
use App\Jobs\EnqueuePreArrivalForWindow;
use App\Domain\Reservations\Events\ReservationPreArrivalDue;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Enable pre-arrival notifications
    config(['notifications.pre_arrival.enabled' => true]);
    config(['notifications.pre_arrival.timezone' => 'Asia/Tbilisi']);
    
    Queue::fake();
    Event::fake();
});

it('enqueues pre-arrival notifications for reservations', function () {
    $now = Carbon::now('Asia/Tbilisi');
    $targetTime = $now->copy()->addMinutes(30); // 30 minutes from now
    
    // Create a reservation exactly 30 minutes from now
    $reservation = Reservation::factory()->create([
        'status' => 'confirmed',
        'client_email' => 'client@example.com',
        'datetime_local' => $targetTime->format('Y-m-d H:i:s'),
    ]);

    // Run the job for 30-minute window
    $job = new EnqueuePreArrivalForWindow(30);
    $job->handle();

    // Check that pre-arrival event was dispatched
    Event::assertDispatched(ReservationPreArrivalDue::class, function ($event) use ($reservation) {
        return $event->reservationId === $reservation->id && 
               $event->minutesBefore === 30;
    });
});

it('only processes confirmed reservations', function () {
    $now = Carbon::now('Asia/Tbilisi');
    $targetTime = $now->copy()->addMinutes(30);
    
    // Create reservations with different statuses
    $pendingReservation = Reservation::factory()->create([
        'status' => 'pending',
        'client_email' => 'pending@example.com',
        'datetime_local' => $targetTime->format('Y-m-d H:i:s'),
    ]);

    $confirmedReservation = Reservation::factory()->create([
        'status' => 'confirmed',
        'client_email' => 'confirmed@example.com',
        'datetime_local' => $targetTime->format('Y-m-d H:i:s'),
    ]);

    $job = new EnqueuePreArrivalForWindow(30);
    $job->handle();

    // Only confirmed reservation should trigger event
    Event::assertDispatched(ReservationPreArrivalDue::class, function ($event) use ($confirmedReservation) {
        return $event->reservationId === $confirmedReservation->id;
    });
});

it('skips disabled pre-arrival notifications', function () {
    config(['notifications.pre_arrival.enabled' => false]);
    
    $now = Carbon::now('Asia/Tbilisi');
    $targetTime = $now->copy()->addMinutes(30);
    
    $reservation = Reservation::factory()->create([
        'status' => 'confirmed',
        'client_email' => 'client@example.com',
        'datetime_local' => $targetTime->format('Y-m-d H:i:s'),
    ]);

    $job = new EnqueuePreArrivalForWindow(30);
    $job->handle();

    // Should not dispatch any events when disabled
    Event::assertNotDispatched(ReservationPreArrivalDue::class);
});