<?php

namespace App\Listeners\Admin;

use App\Events\ReservationStatusChanged;
use App\Jobs\SendAdminReservationEmail;
use App\Mail\Admin\AdminPendingEmail;
use App\Mail\Admin\AdminConfirmedEmail;
use App\Mail\Admin\AdminCancelledEmail;
use App\Mail\Admin\AdminCompletedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueueAdminReservationEmails implements ShouldQueue
{
    public function handle(ReservationStatusChanged $event)
    {
        $reservation = $event->reservation;
        $status = $event->newStatus;

        // Map status to Mailable
        $mailable = match ($status) {
            'pending' => new AdminPendingEmail($reservation),
            'confirmed' => new AdminConfirmedEmail($reservation),
            'cancelled' => new AdminCancelledEmail($reservation),
            'paid' => new AdminCompletedEmail($reservation),
            default => null,
        };

        if (! $mailable) {
            return;
        }

        // Determine admin recipients.
        $recipients = [];

        // Prefer Eloquent relation: reservation->restaurant->admins() returning a Collection of admin models with `email`
        if (isset($reservation->restaurant)) {
            try {
                // If restaurant has admins relation as a method (Eloquent), use it
                if (method_exists($reservation->restaurant, 'admins')) {
                    $admins = $reservation->restaurant->admins();
                    // If relation returns query builder, get the collection
                    if (is_object($admins) && method_exists($admins, 'pluck')) {
                        $emails = $admins->pluck('email')->filter()->unique()->values()->all();
                        foreach ($emails as $email) {
                            $recipients[] = $email;
                        }
                    }
                } elseif (! empty($reservation->restaurant->admins)) {
                    // fallback to property-style admins (array/collection)
                    foreach ($reservation->restaurant->admins as $admin) {
                        if (! empty($admin->email ?? null)) {
                            $recipients[] = $admin->email;
                        }
                    }
                }
            } catch (\Throwable $e) {
                // ignore and fallback to other fields
            }
        }

        // If still empty, look for singular admin_email on restaurant or reservation
        if (empty($recipients) && isset($reservation->restaurant) && ! empty($reservation->restaurant->admin_email ?? null)) {
            $recipients[] = $reservation->restaurant->admin_email;
        }

        if (empty($recipients) && ! empty($reservation->admin_email ?? null)) {
            $recipients[] = $reservation->admin_email;
        }

        if (empty($recipients)) {
            // Nothing to send to; log and return
            try {
                \Illuminate\Support\Facades\Log::warning('No admin recipients found for reservation', [
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
                    \Illuminate\Support\Facades\Log::info('Dispatching SendAdminReservationEmail job', ['to' => $to, 'status' => $status]);
                } catch (\Throwable $_) {
                    // ignore log errors in tests
                }
                // try to dispatch via the framework
                dispatch(new SendAdminReservationEmail($to, $mailable));
            } catch (\Throwable $e) {
                try {
                    \Illuminate\Support\Facades\Log::warning('Dispatch failed; falling back to synchronous send', ['error' => $e->getMessage()]);
                } catch (\Throwable $_) {
                    // ignore
                }
                // If dispatching is not available (tests or minimal runtime), run synchronously
                try {
                    (new SendAdminReservationEmail($to, $mailable))->handle();
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
