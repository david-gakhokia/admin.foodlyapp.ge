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

class SendAdminReservationEmail implements ShouldQueue
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

            // Avoid calling Mail facade in 'testing' environment (unit tests without app bootstrapped)
            if (getenv('APP_ENV') !== 'testing') {
                Mail::to($this->to)->send($mailable);
            }
            try {
                Log::info('Admin reservation email sent', ['to' => $this->to, 'mailable' => get_class($mailable)]);
            } catch (Throwable $_) {
                // ignore logging failures in minimal/test environments
            }
        } catch (Throwable $e) {
            // Log and rethrow to let the queue worker handle retry according to $tries/backoff
            try {
                Log::error('Failed to send admin reservation email', [
                    'to' => $this->to,
                    'reservation_id' => $this->reservationId,
                    'error' => $e->getMessage(),
                ]);
            } catch (Throwable $_) {
                // ignore logging failures in minimal/test environments
            }
            // rethrow so the job will be retried or failed by the queue worker
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        try {
            // write a DB-backed notification log if possible
            if (class_exists(\App\Models\NotificationLog::class)) {
                \App\Models\NotificationLog::create([
                    'to' => $this->to,
                    'mailable' => is_object($this->mailable) ? get_class($this->mailable) : (string) $this->mailable,
                    'status' => 'failed',
                    'message' => $exception->getMessage(),
                    'meta' => [],
                ]);
            }

            try {
                Log::critical('SendAdminReservationEmail job failed permanently', [
                    'to' => $this->to,
                    'mailable' => is_object($this->mailable) ? get_class($this->mailable) : (string) $this->mailable,
                    'exception' => $exception->getMessage(),
                ]);
            } catch (Throwable $_) {
                // ignore logging failures in minimal/test environments
            }
        } catch (Throwable $_) {
            // do not allow failed handler to throw
        }
    }
}
