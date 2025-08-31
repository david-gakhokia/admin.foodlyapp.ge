<?php

namespace App\Events;

use App\Models\BOGTransaction;
use App\Enums\ReservationStatus;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BOGPaymentStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public BOGTransaction $transaction;
    public string $previousTransactionStatus;
    public ReservationStatus|string $previousReservationStatus;

    /**
     * Create a new event instance.
     */
    public function __construct(
        BOGTransaction $transaction, 
        string $previousTransactionStatus,
        ReservationStatus|string $previousReservationStatus
    ) {
        $this->transaction = $transaction;
        $this->previousTransactionStatus = $previousTransactionStatus;
        $this->previousReservationStatus = $previousReservationStatus;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('bog-payments.' . $this->transaction->reservation_id),
            new PrivateChannel('reservations.' . $this->transaction->reservation_id),
        ];
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'transaction_id' => $this->transaction->id,
            'reservation_id' => $this->transaction->reservation_id,
            'bog_order_id' => $this->transaction->bog_order_id,
            'transaction_status' => $this->transaction->status,
            'bog_status' => $this->transaction->bog_status,
            'reservation_status' => is_object($this->transaction->reservation->status) 
                ? $this->transaction->reservation->status->value 
                : $this->transaction->reservation->status,
            'amount' => $this->transaction->amount,
            'currency' => $this->transaction->currency,
            'previous_transaction_status' => $this->previousTransactionStatus,
            'previous_reservation_status' => is_object($this->previousReservationStatus) 
                ? $this->previousReservationStatus->value 
                : $this->previousReservationStatus,
            'timestamp' => now()->toISOString(),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'payment.status.changed';
    }
}
