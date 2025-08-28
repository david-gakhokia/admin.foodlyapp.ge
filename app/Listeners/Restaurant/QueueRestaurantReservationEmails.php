<?php

namespace App\Listeners\Restaurant;

use App\Events\ReservationStatusChanged;
use App\Jobs\SendRestaurantReservationEmail;
use App\Mail\Restaurant\RestauranPendingEmail;
use App\Mail\Restaurant\RestaurantConfirmedEmail;
use App\Mail\Restaurant\RestaurantCancelledEmail;
use App\Mail\Restaurant\RestaurantCompletedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueueRestaurantReservationEmails implements ShouldQueue
{
    public function handle(ReservationStatusChanged $event)
    {
        $reservation = $event->reservation;
        $status = $event->newStatus;

        // Map status to Mailable (handle both lowercase and capitalized status values)
        $mailable = match (strtolower($status)) {
            'pending' => new RestauranPendingEmail($reservation),
            'confirmed' => new RestaurantConfirmedEmail($reservation),
            'cancelled' => new RestaurantCancelledEmail($reservation),
            'completed', 'paid' => new RestaurantCompletedEmail($reservation),
            default => null,
        };

        if (! $mailable) {
            return;
        }

        // Determine restaurant recipients
        $recipients = [];

        // Get restaurant email from reservation->restaurant
        if (isset($reservation->restaurant)) {
            // Primary restaurant email
            if (! empty($reservation->restaurant->email ?? null)) {
                $recipients[] = $reservation->restaurant->email;
            }

            // Restaurant manager emails (if relation exists)
            try {
                if (method_exists($reservation->restaurant, 'managers')) {
                    $managers = $reservation->restaurant->managers();
                    if (is_object($managers) && method_exists($managers, 'pluck')) {
                        $emails = $managers->pluck('email')->filter()->unique()->values()->all();
                        foreach ($emails as $email) {
                            $recipients[] = $email;
                        }
                    }
                } elseif (! empty($reservation->restaurant->managers)) {
                    foreach ($reservation->restaurant->managers as $manager) {
                        if (! empty($manager->email ?? null)) {
                            $recipients[] = $manager->email;
                        }
                    }
                }
            } catch (\Throwable $e) {
                // ignore and fallback to other fields
            }

            // Fallback to restaurant manager_email field if exists
            if (empty($recipients) && ! empty($reservation->restaurant->manager_email ?? null)) {
                $recipients[] = $reservation->restaurant->manager_email;
            }
            
            // Fallback to restaurant email field if exists
            if (empty($recipients) && ! empty($reservation->restaurant->email ?? null)) {
                $recipients[] = $reservation->restaurant->email;
            }
        }

        if (empty($recipients)) {
            // Nothing to send to; log and return
            try {
                \Illuminate\Support\Facades\Log::warning('No restaurant recipients found for reservation', [
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
                    \Illuminate\Support\Facades\Log::info('Dispatching SendRestaurantReservationEmail job', ['to' => $to, 'status' => $status]);
                } catch (\Throwable $_) {
                    // ignore log errors in tests
                }
                // try to dispatch via the framework
                dispatch(new SendRestaurantReservationEmail($to, $mailable, $reservation->id));
            } catch (\Throwable $e) {
                try {
                    \Illuminate\Support\Facades\Log::warning('Dispatch failed; falling back to synchronous send', ['error' => $e->getMessage()]);
                } catch (\Throwable $_) {
                    // ignore
                }
                // If dispatching is not available (tests or minimal runtime), run synchronously
                try {
                    (new SendRestaurantReservationEmail($to, $mailable, $reservation->id))->handle();
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
