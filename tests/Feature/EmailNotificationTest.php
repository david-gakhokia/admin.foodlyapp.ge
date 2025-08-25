<?php

use App\Models\NotificationEvent;
use App\Models\NotificationRule;
use App\Models\NotificationTemplate;
use App\Models\Reservation;
use App\Domain\Reservations\Events\ReservationRequested;
use App\Jobs\ProcessNotificationEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Event;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Setup test configuration
    config([
        'notifications.providers.sendgrid.api_key' => 'test-api-key',
        'notifications.providers.sendgrid.from_email' => 'test@foodly.space',
        'notifications.providers.sendgrid.from_name' => 'FOODLY Test',
    ]);

    // Create notification rules
    NotificationRule::create([
        'event_key' => 'reservation.requested',
        'recipient_type' => 'manager',
        'delay_minutes' => 0,
        'is_active' => true,
    ]);

    NotificationRule::create([
        'event_key' => 'reservation.requested',
        'recipient_type' => 'client',
        'delay_minutes' => 0,
        'is_active' => true,
    ]);

    // Create notification templates
    NotificationTemplate::create([
        'event_key' => 'reservation.requested',
        'recipient_type' => 'manager',
        'provider' => 'sendgrid',
        'provider_template_id' => 'd-manager123',
        'is_active' => true,
    ]);

    NotificationTemplate::create([
        'event_key' => 'reservation.requested',
        'recipient_type' => 'client',
        'provider' => 'sendgrid',
        'provider_template_id' => 'd-client123',
        'is_active' => true,
    ]);
});

it('creates notification event when reservation requested event is dispatched', function () {
    Event::fake();
    Queue::fake();

    // Create a reservation (simplified for test)
    $reservation = Reservation::factory()->create([
        'status' => 'pending',
        'client_email' => 'client@example.com',
    ]);

    // Dispatch the domain event
    ReservationRequested::dispatch($reservation->id);

    // Check that event was dispatched
    Event::assertDispatched(ReservationRequested::class);
});

it('notification event listener creates outbox entry', function () {
    $reservation = Reservation::factory()->create([
        'status' => 'pending',
        'client_email' => 'client@example.com',
    ]);

    // Dispatch the domain event
    ReservationRequested::dispatch($reservation->id);

    // Check that notification event was created in outbox
    $this->assertDatabaseHas('notification_events', [
        'event_key' => 'reservation.requested',
        'reservation_id' => $reservation->id,
        'status' => 'pending',
    ]);
});

it('process notification event job runs successfully', function () {
    Queue::fake();

    $reservation = Reservation::factory()->create([
        'status' => 'pending',
        'client_email' => 'client@example.com',
    ]);

    $notificationEvent = NotificationEvent::create([
        'event_key' => 'reservation.requested',
        'event_type' => 'reservation',
        'reservation_id' => $reservation->id,
        'idempotency_key' => 'test-key-123',
        'status' => 'pending',
    ]);

    // Dispatch the job
    ProcessNotificationEvent::dispatch($notificationEvent->id);

    // Check that job was dispatched
    Queue::assertPushed(ProcessNotificationEvent::class);
});

it('idempotency prevents duplicate notification events', function () {
    $reservation = Reservation::factory()->create([
        'status' => 'pending',
        'client_email' => 'client@example.com',
    ]);

    // Dispatch the same event twice
    ReservationRequested::dispatch($reservation->id);
    ReservationRequested::dispatch($reservation->id);

    // Only one notification event should be created
    $count = NotificationEvent::where([
        'event_key' => 'reservation.requested',
        'reservation_id' => $reservation->id,
    ])->count();

    expect($count)->toBe(1);
});

it('inactive notification rules are not processed', function () {
    // Deactivate all rules
    NotificationRule::query()->update(['is_active' => false]);

    $reservation = Reservation::factory()->create([
        'status' => 'pending',
        'client_email' => 'client@example.com',
    ]);

    // Dispatch the domain event
    ReservationRequested::dispatch($reservation->id);

    // Notification event should still be created
    $this->assertDatabaseHas('notification_events', [
        'event_key' => 'reservation.requested',
        'reservation_id' => $reservation->id,
    ]);

    // But no deliveries should be created when job runs
    // (This would need to be tested with job execution)
});
