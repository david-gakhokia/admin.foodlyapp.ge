<?php

use App\Models\NotificationDelivery;
use App\Models\NotificationEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Disable signature verification for tests
    config(['notifications.webhook.sendgrid.verify_signature' => false]);
});

it('handles sendgrid webhook successfully', function () {
    // Create a notification delivery record
    $delivery = NotificationDelivery::create([
        'notification_event_id' => 1,
        'recipient_email' => 'test@example.com',
        'recipient_type' => 'client',
        'template_id' => 'd-123456',
        'provider' => 'sendgrid',
        'provider_message_id' => 'test-message-id-123',
        'status' => 'sent',
    ]);

    // SendGrid webhook payload for delivered event
    $payload = [
        [
            'email' => 'test@example.com',
            'timestamp' => time(),
            'smtp-id' => '<test-smtp-id@sendgrid.net>',
            'event' => 'delivered',
            'category' => ['reservation'],
            'sg_event_id' => 'test-event-id',
            'sg_message_id' => 'test-message-id-123',
            'useragent' => 'Mozilla/5.0',
            'ip' => '192.168.1.1',
        ]
    ];

    // Send webhook request
    $response = $this->postJson('/api/webhooks/sendgrid', $payload);

    // Assert success response
    $response->assertStatus(200);
    $response->assertSeeText('OK');

    // Assert delivery status was updated
    $delivery->refresh();
    expect($delivery->status)->toBe('delivered');
    expect($delivery->delivered_at)->not->toBeNull();
    expect($delivery->webhook_data)->not->toBeNull();
});

it('handles multiple events in single webhook', function () {
    // Create multiple delivery records
    $delivery1 = NotificationDelivery::create([
        'notification_event_id' => 1,
        'recipient_email' => 'test1@example.com',
        'recipient_type' => 'client',
        'template_id' => 'd-123456',
        'provider' => 'sendgrid',
        'provider_message_id' => 'message-id-1',
        'status' => 'sent',
    ]);

    $delivery2 = NotificationDelivery::create([
        'notification_event_id' => 2,
        'recipient_email' => 'test2@example.com',
        'recipient_type' => 'manager',
        'template_id' => 'd-789012',
        'provider' => 'sendgrid',
        'provider_message_id' => 'message-id-2',
        'status' => 'sent',
    ]);

    // Multiple events payload
    $payload = [
        [
            'email' => 'test1@example.com',
            'timestamp' => time(),
            'event' => 'delivered',
            'sg_message_id' => 'message-id-1',
        ],
        [
            'email' => 'test2@example.com',
            'timestamp' => time(),
            'event' => 'opened',
            'sg_message_id' => 'message-id-2',
        ]
    ];

    $response = $this->postJson('/api/webhooks/sendgrid', $payload);

    $response->assertStatus(200);

    // Check both deliveries were updated
    $delivery1->refresh();
    $delivery2->refresh();

    expect($delivery1->status)->toBe('delivered');
    expect($delivery2->status)->toBe('opened');
});

it('handles bounce events correctly', function () {
    $delivery = NotificationDelivery::create([
        'notification_event_id' => 1,
        'recipient_email' => 'bounce@example.com',
        'recipient_type' => 'client',
        'template_id' => 'd-123456',
        'provider' => 'sendgrid',
        'provider_message_id' => 'bounce-message-id',
        'status' => 'sent',
    ]);

    $payload = [
        [
            'email' => 'bounce@example.com',
            'timestamp' => time(),
            'event' => 'bounce',
            'sg_message_id' => 'bounce-message-id',
            'reason' => 'Mailbox does not exist',
            'type' => 'bounce',
        ]
    ];

    $response = $this->postJson('/api/webhooks/sendgrid', $payload);

    $response->assertStatus(200);

    $delivery->refresh();
    expect($delivery->status)->toBe('bounced');
    expect($delivery->error_message)->toContain('Bounced');
    expect($delivery->error_message)->toContain('Mailbox does not exist');
});

it('handles unknown message ids gracefully', function () {
    Log::fake();

    $payload = [
        [
            'email' => 'unknown@example.com',
            'timestamp' => time(),
            'event' => 'delivered',
            'sg_message_id' => 'unknown-message-id',
        ]
    ];

    $response = $this->postJson('/api/webhooks/sendgrid', $payload);

    // Should still return 200 even if delivery not found
    $response->assertStatus(200);

    // Should log warning
    Log::assertLogged('warning', function ($level, $message, $context) {
        return str_contains($message, 'Delivery not found') && 
               $context['message_id'] === 'unknown-message-id';
    });
});

it('validates webhook payload format', function () {
    // Invalid payload (not array)
    $response = $this->postJson('/api/webhooks/sendgrid', 'invalid-json');

    $response->assertStatus(400);
});

it('handles malformed events gracefully', function () {
    Log::fake();

    // Event missing required fields
    $payload = [
        [
            'email' => 'test@example.com',
            // Missing sg_message_id, event, timestamp
        ]
    ];

    $response = $this->postJson('/api/webhooks/sendgrid', $payload);

    $response->assertStatus(200); // Should not fail the webhook

    // Should log validation warning
    Log::assertLogged('warning', function ($level, $message) {
        return str_contains($message, 'Invalid event data');
    });
});
