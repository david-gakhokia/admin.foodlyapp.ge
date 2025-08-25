<?php

namespace App\Listeners;

use App\Models\NotificationEvent;
use App\Jobs\ProcessNotificationEvent;
use App\Domain\Reservations\Events\ReservationRequested;
use App\Domain\Reservations\Events\ReservationConfirmed;
use App\Domain\Reservations\Events\ReservationDeclined;
use App\Domain\Reservations\Events\ReservationPreArrivalDue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NotificationEventListener
{
    /**
     * Handle reservation domain events and create notification events (Outbox Pattern)
     */
    public function handle(object $event): void
    {
        try {
            // Check if this is a supported event
            if (!$this->isSupportedEvent($event)) {
                return;
            }

            $eventKey = $event->getEventKey();
            $eventType = $event->getEventType();
            $payload = $event->getPayload();
            $reservationId = $event->reservationId;

            // Generate idempotency key to prevent duplicates
            $idempotencyKey = $this->generateIdempotencyKey($eventKey, $reservationId, $payload);

            // Check if this event already exists (idempotency)
            if ($this->eventExists($idempotencyKey)) {
                Log::info('Notification event already exists, skipping', [
                    'idempotency_key' => $idempotencyKey,
                    'event_key' => $eventKey,
                    'reservation_id' => $reservationId,
                ]);
                return;
            }

            // Create notification event in outbox
            $notificationEvent = NotificationEvent::create([
                'event_key' => $eventKey,
                'event_type' => $eventType,
                'reservation_id' => $reservationId,
                'payload' => $payload,
                'idempotency_key' => $idempotencyKey,
                'status' => NotificationEvent::STATUS_PENDING,
            ]);

            Log::info('Notification event created in outbox', [
                'notification_event_id' => $notificationEvent->id,
                'event_key' => $eventKey,
                'reservation_id' => $reservationId,
                'idempotency_key' => $idempotencyKey,
            ]);

            // Dispatch job to process the notification
            ProcessNotificationEvent::dispatch($notificationEvent->id)
                ->onQueue(config('notifications.queue.name', 'emails'));

        } catch (\Exception $e) {
            Log::error('Failed to handle notification event', [
                'event_class' => get_class($event),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Don't re-throw to avoid breaking the main application flow
        }
    }

    /**
     * Check if the event is supported for notifications
     */
    private function isSupportedEvent(object $event): bool
    {
        $supportedEvents = [
            ReservationRequested::class,
            ReservationConfirmed::class,
            ReservationDeclined::class,
            ReservationPreArrivalDue::class,
        ];

        return in_array(get_class($event), $supportedEvents);
    }

    /**
     * Generate idempotency key for event deduplication
     */
    private function generateIdempotencyKey(string $eventKey, int $reservationId, array $payload): string
    {
        // Base key with event and reservation
        $baseKey = "{$eventKey}.{$reservationId}";

        // For pre-arrival events, include minutes_before to allow multiple reminders
        if ($eventKey === 'reservation.prearrival' && isset($payload['minutes_before'])) {
            $baseKey .= ".{$payload['minutes_before']}min";
        }

        // Add date for daily uniqueness (for events that can repeat)
        if (in_array($eventKey, ['reservation.prearrival'])) {
            $baseKey .= "." . now()->format('Y-m-d');
        }

        return $baseKey;
    }

    /**
     * Check if notification event already exists
     */
    private function eventExists(string $idempotencyKey): bool
    {
        return NotificationEvent::where('idempotency_key', $idempotencyKey)->exists();
    }
}
