<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\NotificationDelivery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SendGridWebhookController extends Controller
{
    /**
     * Handle SendGrid event webhook
     */
    public function handle(Request $request): Response
    {
        try {
            // Verify webhook signature if enabled
            if (config('notifications.webhook.sendgrid.verify_signature', true)) {
                if (!$this->verifySignature($request)) {
                    Log::warning('SendGrid webhook signature verification failed', [
                        'headers' => $request->headers->all(),
                        'ip' => $request->ip(),
                    ]);
                    
                    return response('Unauthorized', 401);
                }
            }

            // Get webhook events
            $events = $request->json()->all();
            
            if (!is_array($events)) {
                Log::error('SendGrid webhook: Invalid payload format', [
                    'payload' => $request->getContent(),
                ]);
                
                return response('Bad Request', 400);
            }

            Log::info('SendGrid webhook received', [
                'event_count' => count($events),
                'ip' => $request->ip(),
            ]);

            // Process each event
            foreach ($events as $event) {
                $this->processEvent($event);
            }

            return response('OK', 200);

        } catch (\Exception $e) {
            Log::error('SendGrid webhook processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->getContent(),
            ]);

            return response('Internal Server Error', 500);
        }
    }

    /**
     * Process individual SendGrid event
     */
    private function processEvent(array $event): void
    {
        // Validate required fields
        $validator = Validator::make($event, [
            'sg_message_id' => 'required|string',
            'event' => 'required|string',
            'email' => 'required|email',
            'timestamp' => 'required|integer',
        ]);

        if ($validator->fails()) {
            Log::warning('SendGrid webhook: Invalid event data', [
                'event' => $event,
                'validation_errors' => $validator->errors()->toArray(),
            ]);
            return;
        }

        $messageId = $event['sg_message_id'];
        $eventType = $event['event'];
        $email = $event['email'];
        $timestamp = $event['timestamp'];

        // Find the delivery record
        $delivery = NotificationDelivery::where('provider_message_id', $messageId)
            ->where('recipient_email', $email)
            ->first();

        if (!$delivery) {
            Log::warning('SendGrid webhook: Delivery not found', [
                'message_id' => $messageId,
                'email' => $email,
                'event_type' => $eventType,
            ]);
            return;
        }

        // Map SendGrid events to our status
        $status = $this->mapEventToStatus($eventType);
        
        if (!$status) {
            Log::warning('SendGrid webhook: Unknown event type', [
                'event_type' => $eventType,
                'message_id' => $messageId,
            ]);
            return;
        }

        // Update delivery status
        $delivery->updateStatus($status, $event);

        Log::info('SendGrid webhook: Delivery status updated', [
            'delivery_id' => $delivery->id,
            'message_id' => $messageId,
            'email' => $email,
            'old_status' => $delivery->getOriginal('status'),
            'new_status' => $status,
            'event_type' => $eventType,
        ]);

        // Handle specific events
        $this->handleSpecificEvents($delivery, $eventType, $event);
    }

    /**
     * Map SendGrid event types to our delivery statuses
     */
    private function mapEventToStatus(string $eventType): ?string
    {
        return match($eventType) {
            'processed' => NotificationDelivery::STATUS_SENT,
            'delivered' => NotificationDelivery::STATUS_DELIVERED,
            'open' => NotificationDelivery::STATUS_OPENED,
            'click' => NotificationDelivery::STATUS_CLICKED,
            'bounce' => NotificationDelivery::STATUS_BOUNCED,
            'dropped' => NotificationDelivery::STATUS_DROPPED,
            'deferred' => NotificationDelivery::STATUS_DEFERRED,
            'spamreport' => NotificationDelivery::STATUS_SPAM_REPORT,
            'unsubscribe' => NotificationDelivery::STATUS_UNSUBSCRIBED,
            default => null,
        };
    }

    /**
     * Handle specific event types that need special processing
     */
    private function handleSpecificEvents(NotificationDelivery $delivery, string $eventType, array $event): void
    {
        switch ($eventType) {
            case 'bounce':
                $this->handleBounce($delivery, $event);
                break;
                
            case 'dropped':
                $this->handleDropped($delivery, $event);
                break;
                
            case 'spamreport':
                $this->handleSpamReport($delivery, $event);
                break;
                
            case 'unsubscribe':
                $this->handleUnsubscribe($delivery, $event);
                break;
        }
    }

    /**
     * Handle bounce events
     */
    private function handleBounce(NotificationDelivery $delivery, array $event): void
    {
        $reason = $event['reason'] ?? 'Unknown bounce reason';
        $type = $event['type'] ?? 'unknown';

        Log::warning('Email bounced', [
            'delivery_id' => $delivery->id,
            'email' => $delivery->recipient_email,
            'bounce_type' => $type,
            'reason' => $reason,
        ]);

        // Update delivery with bounce details
        $delivery->update([
            'error_message' => "Bounced ({$type}): {$reason}",
        ]);

        // TODO: Add to suppression list if hard bounce
        if ($type === 'bounce') {
            $this->addToSuppressionList($delivery->recipient_email, 'bounce', $reason);
        }
    }

    /**
     * Handle dropped events
     */
    private function handleDropped(NotificationDelivery $delivery, array $event): void
    {
        $reason = $event['reason'] ?? 'Unknown drop reason';

        Log::warning('Email dropped', [
            'delivery_id' => $delivery->id,
            'email' => $delivery->recipient_email,
            'reason' => $reason,
        ]);

        $delivery->update([
            'error_message' => "Dropped: {$reason}",
        ]);
    }

    /**
     * Handle spam report events
     */
    private function handleSpamReport(NotificationDelivery $delivery, array $event): void
    {
        Log::warning('Email marked as spam', [
            'delivery_id' => $delivery->id,
            'email' => $delivery->recipient_email,
        ]);

        $this->addToSuppressionList($delivery->recipient_email, 'spam', 'User marked as spam');
    }

    /**
     * Handle unsubscribe events
     */
    private function handleUnsubscribe(NotificationDelivery $delivery, array $event): void
    {
        Log::info('User unsubscribed', [
            'delivery_id' => $delivery->id,
            'email' => $delivery->recipient_email,
        ]);

        $this->addToSuppressionList($delivery->recipient_email, 'unsubscribe', 'User unsubscribed');
    }

    /**
     * Add email to suppression list (placeholder for future implementation)
     */
    private function addToSuppressionList(string $email, string $type, string $reason): void
    {
        // TODO: Implement suppression list functionality
        Log::info('Email added to suppression list', [
            'email' => $email,
            'type' => $type,
            'reason' => $reason,
        ]);
    }

    /**
     * Verify SendGrid webhook signature
     */
    private function verifySignature(Request $request): bool
    {
        $publicKey = config('notifications.webhook.sendgrid.public_key');
        
        if (!$publicKey) {
            Log::warning('SendGrid webhook public key not configured');
            return false;
        }

        $signature = $request->header('X-Twilio-Email-Event-Webhook-Signature');
        $timestamp = $request->header('X-Twilio-Email-Event-Webhook-Timestamp');

        if (!$signature || !$timestamp) {
            Log::warning('SendGrid webhook missing signature headers');
            return false;
        }

        // Verify timestamp is recent (within 10 minutes)
        if (abs(time() - $timestamp) > 600) {
            Log::warning('SendGrid webhook timestamp too old', [
                'timestamp' => $timestamp,
                'current_time' => time(),
                'difference' => abs(time() - $timestamp),
            ]);
            return false;
        }

        // Verify signature
        $payload = $timestamp . $request->getContent();
        $expectedSignature = base64_encode(hash_hmac('sha256', $payload, $publicKey, true));

        if (!hash_equals($expectedSignature, $signature)) {
            Log::warning('SendGrid webhook signature mismatch', [
                'expected' => $expectedSignature,
                'received' => $signature,
            ]);
            return false;
        }

        return true;
    }
}
