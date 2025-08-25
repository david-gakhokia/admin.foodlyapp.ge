<?php

namespace App\Domain\Reservations\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationDeclined
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $reservationId,
        public string $reason = '',
        public array $payload = []
    ) {}

    public function getEventKey(): string
    {
        return 'reservation.declined';
    }

    public function getEventType(): string
    {
        return 'reservation';
    }

    public function getPayload(): array
    {
        return array_merge($this->payload, [
            'reservation_id' => $this->reservationId,
            'decline_reason' => $this->reason,
            'timestamp' => now()->toISOString(),
        ]);
    }
}
