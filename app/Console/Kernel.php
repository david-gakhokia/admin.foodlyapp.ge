<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\BogTestWebhook;
use App\Console\Commands\BogTestPaymentFlow;
use App\Console\Commands\BogTestEmails;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        BogTestWebhook::class,
        BogTestPaymentFlow::class,
        BogTestEmails::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('kiosk:check-status')
            ->everyTwoMinutes()
            ->withoutOverlapping();

        // Pre-arrival notification scheduling
        if (config('notifications.pre_arrival.enabled', true)) {
            $windows = config('notifications.pre_arrival.windows', [24 * 60, 3 * 60, 30]);
            
            foreach ($windows as $minutesBefore) {
                $schedule->job(new \App\Jobs\EnqueuePreArrivalForWindow($minutesBefore))
                    ->everyMinute()
                    ->name("pre-arrival-{$minutesBefore}min")
                    ->withoutOverlapping()
                    ->runInBackground();
            }
        }

        // Process failed notification events (retry)
        $schedule->call(function () {
            \App\Models\NotificationEvent::failed()
                ->where('retry_count', '<', config('notifications.retry.max_attempts', 5))
                ->where('updated_at', '<', now()->subMinutes(30))
                ->chunk(50, function ($events) {
                    foreach ($events as $event) {
                        \App\Jobs\ProcessNotificationEvent::dispatch($event->id)
                            ->delay(now()->addMinutes(5));
                    }
                });
        })
        ->everyTenMinutes()
        ->name('retry-failed-notifications');

        // Cleanup old notification events and deliveries
        $schedule->call(function () {
            // Delete completed events older than 30 days
            \App\Models\NotificationEvent::where('status', 'completed')
                ->where('created_at', '<', now()->subDays(30))
                ->delete();

            // Delete old deliveries older than 90 days
            \App\Models\NotificationDelivery::where('created_at', '<', now()->subDays(90))
                ->delete();
        })
        ->daily()
        ->at('02:00')
        ->name('cleanup-old-notifications');
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
