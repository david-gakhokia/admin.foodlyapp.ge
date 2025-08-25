<?php

namespace App\Jobs;

use App\Models\Reservation;
use App\Domain\Reservations\Events\ReservationPreArrivalDue;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EnqueuePreArrivalForWindow implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function __construct(
        public int $minutesBefore
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!config('notifications.pre_arrival.enabled', true)) {
            Log::info('Pre-arrival notifications are disabled');
            return;
        }

        $timezone = config('notifications.pre_arrival.timezone', 'Asia/Tbilisi');
        $now = Carbon::now($timezone);
        $targetTime = $now->copy()->addMinutes($this->minutesBefore);

        // Find reservations that need pre-arrival notifications
        $reservations = Reservation::query()
            ->where('status', 'confirmed')
            ->whereBetween('datetime_local', [
                $targetTime->format('Y-m-d H:i:00'),
                $targetTime->format('Y-m-d H:i:59')
            ])
            ->whereNotNull('client_email')
            ->get();

        Log::info('Found reservations for pre-arrival notifications', [
            'minutes_before' => $this->minutesBefore,
            'target_time' => $targetTime->format('Y-m-d H:i:s'),
            'count' => $reservations->count(),
        ]);

        foreach ($reservations as $reservation) {
            try {
                // Dispatch pre-arrival event
                ReservationPreArrivalDue::dispatch(
                    $reservation->id,
                    $this->minutesBefore,
                    [
                        'scheduled_at' => $now->toISOString(),
                        'target_datetime' => $targetTime->toISOString(),
                    ]
                );

                Log::debug('Pre-arrival event dispatched', [
                    'reservation_id' => $reservation->id,
                    'minutes_before' => $this->minutesBefore,
                    'client_email' => $reservation->client_email,
                ]);

            } catch (\Exception $e) {
                Log::error('Failed to dispatch pre-arrival event', [
                    'reservation_id' => $reservation->id,
                    'minutes_before' => $this->minutesBefore,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
