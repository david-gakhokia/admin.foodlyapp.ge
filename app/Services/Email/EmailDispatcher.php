<?php

namespace App\Services\Email;

use SendGrid;
use SendGrid\Mail\Mail;
use App\Models\NotificationDelivery;
use App\Models\NotificationTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class EmailDispatcher
{
    private SendGrid $sendgrid;
    private string $fromEmail;
    private string $fromName;

    public function __construct()
    {
        $apiKey = config('notifications.providers.sendgrid.api_key');
        
        if (!$apiKey) {
            throw new \Exception('SendGrid API key is not configured');
        }

        $this->sendgrid = new SendGrid($apiKey);
        $this->fromEmail = config('notifications.providers.sendgrid.from_email');
        $this->fromName = config('notifications.providers.sendgrid.from_name');
    }

    /**
     * Send email using SendGrid Dynamic Template
     */
    public function sendTemplate(
        string $recipientEmail,
        string $recipientType,
        string $templateId,
        array $templateData = [],
        ?string $idempotencyKey = null
    ): string {
        try {
            $mail = new Mail();
            $mail->setFrom($this->fromEmail, $this->fromName);
            $mail->addTo($recipientEmail);
            $mail->setTemplateId($templateId);
            
            // Add dynamic template data
            if (!empty($templateData)) {
                $mail->addDynamicTemplateData($templateData);
            }

            // Add idempotency key for duplicate prevention
            if ($idempotencyKey) {
                $mail->addHeader('X-Idempotency-Key', $idempotencyKey);
            }

            // Send the email
            $response = $this->sendgrid->send($mail);

            // Get message ID from response headers
            $messageId = $this->extractMessageId($response);

            Log::info('Email sent successfully', [
                'recipient' => $recipientEmail,
                'template_id' => $templateId,
                'message_id' => $messageId,
                'status_code' => $response->statusCode()
            ]);

            return $messageId;

        } catch (\Exception $e) {
            Log::error('Failed to send email via SendGrid', [
                'recipient' => $recipientEmail,
                'template_id' => $templateId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    /**
     * Send email to multiple recipients
     */
    public function sendToMultiple(
        array $recipients,
        string $templateId,
        array $templateData = [],
        ?string $idempotencyKey = null
    ): array {
        $results = [];

        foreach ($recipients as $recipient) {
            try {
                $messageId = $this->sendTemplate(
                    $recipient['email'],
                    $recipient['type'],
                    $templateId,
                    array_merge($templateData, $recipient['data'] ?? []),
                    $idempotencyKey ? $idempotencyKey . '_' . $recipient['type'] : null
                );

                $results[] = [
                    'recipient' => $recipient['email'],
                    'type' => $recipient['type'],
                    'success' => true,
                    'message_id' => $messageId
                ];

            } catch (\Exception $e) {
                $results[] = [
                    'recipient' => $recipient['email'],
                    'type' => $recipient['type'],
                    'success' => false,
                    'error' => $e->getMessage()
                ];
            }
        }

        return $results;
    }

    /**
     * Extract SendGrid message ID from response
     */
    private function extractMessageId($response): ?string
    {
        $headers = $response->headers();
        
        if (isset($headers['X-Message-Id'])) {
            return is_array($headers['X-Message-Id']) 
                ? $headers['X-Message-Id'][0] 
                : $headers['X-Message-Id'];
        }

        // Fallback: generate a unique ID
        return 'sg_' . uniqid() . '_' . time();
    }

    /**
     * Validate rate limits
     */
    public function checkRateLimit(): bool
    {
        // TODO: Implement rate limiting logic
        // For now, return true
        return true;
    }

    /**
     * Get SendGrid client for advanced operations
     */
    public function getClient(): SendGrid
    {
        return $this->sendgrid;
    }
}
