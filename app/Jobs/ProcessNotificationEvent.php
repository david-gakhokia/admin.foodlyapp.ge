<?php

namespace App\Jobs;

use App\Models\NotificationEvent;
use App\Models\NotificationDelivery;
use App\Models\NotificationTemplate;
use App\Services\Email\EmailDispatcher;
use App\Services\Email\RecipientResolver;
use App\Services\Email\TemplateDataBuilder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\Middleware\RateLimited;

class ProcessNotificationEvent implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public int $tries = 5;
    public int $backoff = 60; // Start with 1 minute backoff

    public function __construct(
        public int $notificationEventId
    ) {}

    /**
     * Execute the job.
     */
    public function handle(
        EmailDispatcher $emailDispatcher,
        RecipientResolver $recipientResolver,
        TemplateDataBuilder $templateDataBuilder
    ): void {
        $notificationEvent = NotificationEvent::find($this->notificationEventId);

        if (!$notificationEvent) {
            Log::warning('Notification event not found', [
                'notification_event_id' => $this->notificationEventId
            ]);
            return;
        }

        if ($notificationEvent->status !== NotificationEvent::STATUS_PENDING) {
            Log::info('Notification event already processed', [
                'notification_event_id' => $this->notificationEventId,
                'status' => $notificationEvent->status
            ]);
            return;
        }

        try {
            // Mark as processing
            $notificationEvent->markAsProcessing();

            Log::info('Processing notification event', [
                'notification_event_id' => $this->notificationEventId,
                'event_key' => $notificationEvent->event_key,
                'reservation_id' => $notificationEvent->reservation_id,
            ]);

            // Resolve recipients for this event
            $recipients = $recipientResolver->resolve($notificationEvent);

            if ($recipients->isEmpty()) {
                Log::warning('No recipients found for notification event', [
                    'notification_event_id' => $this->notificationEventId,
                    'event_key' => $notificationEvent->event_key,
                ]);
                
                $notificationEvent->markAsCompleted();
                return;
            }

            $deliveryResults = [];

            // Process each recipient
            foreach ($recipients as $recipient) {
                try {
                    $deliveryResult = $this->processRecipient(
                        $notificationEvent,
                        $recipient,
                        $emailDispatcher,
                        $templateDataBuilder
                    );
                    
                    $deliveryResults[] = $deliveryResult;

                } catch (\Exception $e) {
                    Log::error('Failed to process recipient', [
                        'notification_event_id' => $this->notificationEventId,
                        'recipient_email' => $recipient['email'],
                        'recipient_type' => $recipient['type'],
                        'error' => $e->getMessage(),
                    ]);

                    // Create failed delivery record
                    NotificationDelivery::create([
                        'notification_event_id' => $notificationEvent->id,
                        'recipient_email' => $recipient['email'],
                        'recipient_type' => $recipient['type'],
                        'template_id' => '',
                        'provider' => 'sendgrid',
                        'status' => NotificationDelivery::STATUS_DROPPED,
                        'error_message' => $e->getMessage(),
                    ]);
                }
            }

            // Mark event as completed
            $notificationEvent->markAsCompleted();

            $successCount = collect($deliveryResults)->where('success', true)->count();
            $totalCount = $recipients->count();

            Log::info('Notification event processed', [
                'notification_event_id' => $this->notificationEventId,
                'success_count' => $successCount,
                'total_count' => $totalCount,
                'delivery_results' => $deliveryResults,
            ]);

        } catch (\Exception $e) {
            $notificationEvent->markAsFailed($e->getMessage());

            Log::error('Failed to process notification event', [
                'notification_event_id' => $this->notificationEventId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e; // Re-throw to trigger job retry
        }
    }

    /**
     * Process a single recipient
     */
    private function processRecipient(
        NotificationEvent $notificationEvent,
        array $recipient,
        EmailDispatcher $emailDispatcher,
        TemplateDataBuilder $templateDataBuilder
    ): array {
        // Find template for this event and recipient type
        $template = NotificationTemplate::findTemplate(
            $notificationEvent->event_key,
            $recipient['type']
        );

        if (!$template) {
            throw new \Exception("No template found for event {$notificationEvent->event_key} and recipient type {$recipient['type']}");
        }

        // Build template data
        $templateData = $templateDataBuilder->buildForTemplate(
            $notificationEvent->event_key,
            $notificationEvent,
            $recipient
        );

        // Create delivery record
        $delivery = NotificationDelivery::create([
            'notification_event_id' => $notificationEvent->id,
            'recipient_email' => $recipient['email'],
            'recipient_type' => $recipient['type'],
            'template_id' => $template->provider_template_id,
            'template_data' => $templateData,
            'provider' => $template->provider,
            'status' => NotificationDelivery::STATUS_PENDING,
        ]);

        try {
            // Send email
            $messageId = $emailDispatcher->sendTemplate(
                $recipient['email'],
                $recipient['type'],
                $template->provider_template_id,
                $templateData,
                $notificationEvent->idempotency_key
            );

            // Update delivery record
            $delivery->update([
                'provider_message_id' => $messageId,
                'status' => NotificationDelivery::STATUS_SENT,
                'sent_at' => now(),
            ]);

            return [
                'success' => true,
                'recipient' => $recipient['email'],
                'type' => $recipient['type'],
                'message_id' => $messageId,
                'delivery_id' => $delivery->id,
            ];

        } catch (\Exception $e) {
            // Update delivery record with error
            $delivery->update([
                'status' => NotificationDelivery::STATUS_DROPPED,
                'error_message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Get the middleware the job should pass through.
     */
    public function middleware(): array
    {
        return [
            new RateLimited('emails'),
        ];
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     */
    public function backoff(): array
    {
        return config('notifications.retry.backoff_seconds', [60, 300, 900, 3600, 10800]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        $notificationEvent = NotificationEvent::find($this->notificationEventId);
        
        if ($notificationEvent) {
            $notificationEvent->markAsFailed($exception->getMessage());
        }

        Log::error('ProcessNotificationEvent job failed permanently', [
            'notification_event_id' => $this->notificationEventId,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts(),
        ]);
    }
}
