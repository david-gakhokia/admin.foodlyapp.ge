<?php

namespace App\Domain\Reservations\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $reservationId,
        public array $payload = []
    ) {}

    public function getEventKey(): string
    {
        return 'reservation.confirmed';
    }

    public function getEventType(): string
    {
        return 'reservation';
    }

    public function getPayload(): array
    {
        return array_merge($this->payload, [
            'reservation_id' => $this->reservationId,
            'timestamp' => now()->toISOString(),
        ]);
    }
}
