<?php

namespace App\Listeners\Client;

use App\Events\ReservationStatusChanged;
use App\Jobs\SendClientReservationEmail;
use App\Mail\Client\ClientPendingEmail;
use App\Mail\Client\ClientConfirmedEmail;
use App\Mail\Client\ClientCancelledEmail;
use App\Mail\Client\ClientCompletedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueueClientReservationEmails implements ShouldQueue
{
    public function handle(ReservationStatusChanged $event)
    {
        $reservation = $event->reservation;
        $status = $event->newStatus;

        // Map status to Mailable (handle both lowercase and capitalized status values)
        $mailable = match (strtolower($status)) {
            'pending' => new ClientPendingEmail($reservation),
            'confirmed' => new ClientConfirmedEmail($reservation),
            'cancelled' => new ClientCancelledEmail($reservation),
            'completed', 'paid' => new ClientCompletedEmail($reservation),
            default => null,
        };

        if (! $mailable) {
            return;
        }

        // Determine client recipients
        $recipients = [];

        // Get client email from reservation
        if (! empty($reservation->email ?? null)) {
            $recipients[] = $reservation->email;
        }

        // Also check for client_email field if exists
        if (! empty($reservation->client_email ?? null)) {
            $recipients[] = $reservation->client_email;
        }

        if (empty($recipients)) {
            // Nothing to send to; log and return
            try {
                \Illuminate\Support\Facades\Log::warning('No client recipients found for reservation', [
                    'reservation_id' => $reservation->id ?? null,
                    'status' => $status,
                ]);
            } catch (\Throwable $_) {
                // ignore in minimal/test env
            }
            return;
        }

        // Deduplicate and validate recipients
        $recipients = array_values(array_unique(array_filter($recipients, function ($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        })));

        foreach ($recipients as $to) {
            try {
                try {
                    \Illuminate\Support\Facades\Log::info('Dispatching SendClientReservationEmail job', ['to' => $to, 'status' => $status]);
                } catch (\Throwable $_) {
                    // ignore log errors in tests
                }
                // try to dispatch via the framework
                dispatch(new SendClientReservationEmail($to, $mailable, $reservation->id));
            } catch (\Throwable $e) {
                try {
                    \Illuminate\Support\Facades\Log::warning('Dispatch failed; falling back to synchronous send', ['error' => $e->getMessage()]);
                } catch (\Throwable $_) {
                    // ignore
                }
                // If dispatching is not available (tests or minimal runtime), run synchronously
                try {
                    (new SendClientReservationEmail($to, $mailable, $reservation->id))->handle();
                } catch (\Throwable $_) {
                    // swallow secondary exceptions to avoid breaking notification flow in minimal environments
                    try {
                        \Illuminate\Support\Facades\Log::error('Synchronous send also failed', ['to' => $to]);
                    } catch (\Throwable $_) {
                        // ignore
                    }
                }
            }
        }
    }
}
