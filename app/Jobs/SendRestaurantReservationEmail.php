<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;
use Throwable;

class SendRestaurantReservationEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    public string $to;
    public $mailable;
    public int $reservationId;
    public int $tries = 3;
    public int $backoff = 60; // seconds

    public function __construct(string $to, $mailable, int $reservationId)
    {
        $this->to = $to;
        $this->mailable = $mailable;
        $this->reservationId = $reservationId;
    }

    public function handle()
    {
        try {
            // Load fresh reservation model with all methods
            $reservation = Reservation::find($this->reservationId);
            
            if (!$reservation) {
                Log::warning('Reservation not found for email', ['reservation_id' => $this->reservationId]);
                return;
            }

            // Create new mailable instance with fresh reservation
            $mailableClass = get_class($this->mailable);
            $mailable = new $mailableClass($reservation);

            Log::info('Sending restaurant reservation email', [
                'to' => $this->to,
                'mailable' => get_class($mailable),
            ]);

            Mail::to($this->to)->send($mailable);

            Log::info('Restaurant reservation email sent successfully', [
                'to' => $this->to,
            ]);

        } catch (Throwable $exception) {
            Log::error('Failed to send restaurant reservation email', [
                'to' => $this->to,
                'reservation_id' => $this->reservationId,
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);

            // Rethrow to trigger job retry
            throw $exception;
        }
    }

    public function failed(Throwable $exception)
    {
        Log::error('Restaurant reservation email job failed permanently', [
            'to' => $this->to,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts(),
        ]);
    }

    public function backoff()
    {
        // Exponential backoff: 60s, 120s, 180s
        return [60, 120, 180];
    }

    public function retryUntil()
    {
        return now()->addMinutes(30);
    }

    public function tags()
    {
        return ['email', 'restaurant', 'reservation', $this->to];
    }
}
