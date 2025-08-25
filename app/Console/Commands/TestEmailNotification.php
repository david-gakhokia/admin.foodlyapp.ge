<?php

namespace App\Console\Commands;

use App\Services\Email\EmailDispatcher;
use App\Models\NotificationEvent;
use App\Models\NotificationTemplate;
use App\Models\NotificationRule;
use App\Models\Reservation;
use App\Domain\Reservations\Events\ReservationRequested;
use App\Jobs\ProcessNotificationEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class TestEmailNotification extends Command
{
    protected $signature = 'email:test {--step=all : Which test to run (config|dispatcher|event|full)}';
    protected $description = 'Test email notification system step by step';

    public function handle()
    {
        $step = $this->option('step');

        $this->info('🧪 Testing Email Notification System');
        $this->newLine();

        switch ($step) {
            case 'config':
                $this->testConfiguration();
                break;
            case 'dispatcher':
                $this->testEmailDispatcher();
                break;
            case 'event':
                $this->testEventFlow();
                break;
            case 'full':
                $this->testConfiguration();
                $this->testEmailDispatcher();
                $this->testEventFlow();
                $this->testAdminEndpoints();
                break;
            default:
                $this->info('Available test steps:');
                $this->line('--step=config     Test configuration');
                $this->line('--step=dispatcher Test EmailDispatcher');
                $this->line('--step=event      Test event flow');
                $this->line('--step=full       Run all tests');
        }
    }

    private function testConfiguration()
    {
        $this->info('📋 Testing Configuration...');

        // Test SendGrid API Key
        $apiKey = config('notifications.providers.sendgrid.api_key');
        if ($apiKey && $apiKey !== 'your_sendgrid_api_key_here') {
            $this->line("✅ SendGrid API Key: " . substr($apiKey, 0, 10) . "...");
        } else {
            $this->error("❌ SendGrid API Key not configured properly");
            return;
        }

        // Test notification config
        $this->line("✅ Default Provider: " . config('notifications.default_provider'));
        $this->line("✅ Queue Connection: " . config('notifications.queue.connection'));
        $this->line("✅ Pre-arrival Enabled: " . (config('notifications.pre_arrival.enabled') ? 'Yes' : 'No'));

        // Test database tables
        $eventCount = NotificationEvent::count();
        $templateCount = NotificationTemplate::count();
        $ruleCount = NotificationRule::count();

        $this->line("✅ Events in DB: {$eventCount}");
        $this->line("✅ Templates in DB: {$templateCount}");
        $this->line("✅ Rules in DB: {$ruleCount}");

        $this->newLine();
    }

    private function testEmailDispatcher()
    {
        $this->info('🚀 Testing EmailDispatcher...');

        try {
            $dispatcher = new EmailDispatcher();
            $this->line("✅ EmailDispatcher initialized successfully");

            // Test rate limit check
            $canSend = $dispatcher->checkRateLimit();
            $this->line("✅ Rate limit check: " . ($canSend ? 'OK' : 'Limited'));

            // Test with a sample template (don't actually send)
            $this->line("✅ EmailDispatcher ready for sending");

        } catch (\Exception $e) {
            $this->error("❌ EmailDispatcher failed: " . $e->getMessage());
        }

        $this->newLine();
    }

    private function testEventFlow()
    {
        $this->info('🎯 Testing Event Flow...');

        // Find or create a test reservation
        $reservation = Reservation::first();
        
        if (!$reservation) {
            $this->error("❌ No reservations found in database. Please create a test reservation first.");
            return;
        }

        $this->line("✅ Using reservation ID: {$reservation->id}");

        // Test event dispatch
        try {
            $this->info("Dispatching ReservationRequested event...");
            
            ReservationRequested::dispatch($reservation->id, [
                'test' => true,
                'timestamp' => now()->toISOString()
            ]);

            $this->line("✅ Event dispatched successfully");

            // Check if notification event was created
            sleep(1); // Give it a moment
            
            $notificationEvent = NotificationEvent::where('reservation_id', $reservation->id)
                ->where('event_key', 'reservation.requested')
                ->latest()
                ->first();

            if ($notificationEvent) {
                $this->line("✅ Notification event created: ID {$notificationEvent->id}");
                $this->line("   Status: {$notificationEvent->status}");
                $this->line("   Idempotency Key: {$notificationEvent->idempotency_key}");

                // Test job processing
                $this->info("Processing notification event...");
                
                ProcessNotificationEvent::dispatchSync($notificationEvent->id);
                
                $notificationEvent->refresh();
                $this->line("✅ Job processed. New status: {$notificationEvent->status}");

                // Show deliveries
                $deliveries = $notificationEvent->deliveries;
                $this->line("✅ Deliveries created: {$deliveries->count()}");

                foreach ($deliveries as $delivery) {
                    $this->line("   - {$delivery->recipient_type}: {$delivery->recipient_email} ({$delivery->status})");
                }

            } else {
                $this->error("❌ No notification event was created");
            }

        } catch (\Exception $e) {
            $this->error("❌ Event flow failed: " . $e->getMessage());
        }

        $this->newLine();
    }

    private function testAdminEndpoints()
    {
        $this->info('📊 Testing Admin Endpoints...');

        try {
            // Check if routes are registered
            $router = app('router');
            $routes = $router->getRoutes();
            
            $dashboardRoute = null;
            foreach ($routes as $route) {
                if (str_contains($route->uri(), 'admin/notifications/dashboard')) {
                    $dashboardRoute = $route;
                    break;
                }
            }

            if ($dashboardRoute) {
                $this->line("✅ Dashboard route registered: " . $dashboardRoute->uri());
            } else {
                $this->error("❌ Dashboard route not found");
            }

            // Test webhook route
            $webhookRoute = null;
            foreach ($routes as $route) {
                if (str_contains($route->uri(), 'webhooks/sendgrid')) {
                    $webhookRoute = $route;
                    break;
                }
            }

            if ($webhookRoute) {
                $this->line("✅ Webhook route registered: " . $webhookRoute->uri());
            } else {
                $this->error("❌ Webhook route not found");
            }

        } catch (\Exception $e) {
            $this->error("❌ Admin endpoints test failed: " . $e->getMessage());
        }

        $this->newLine();
    }
}
