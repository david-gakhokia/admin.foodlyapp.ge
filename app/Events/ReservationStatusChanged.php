<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reservation;
    public ?string $oldStatus;
    public ?string $newStatus;

    public function __construct($reservation, ?string $oldStatus, ?string $newStatus)
    {
        $this->reservation = $reservation;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }
}
