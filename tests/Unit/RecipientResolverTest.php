<?php

use App\Services\Email\RecipientResolver;
use App\Models\NotificationEvent;
use App\Models\NotificationRule;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create sample notification rules
    NotificationRule::create([
        'event_key' => 'reservation.requested',
        'recipient_type' => 'manager',
        'delay_minutes' => 0,
        'is_active' => true,
    ]);
    
    NotificationRule::create([
        'event_key' => 'reservation.requested',
        'recipient_type' => 'client',
        'delay_minutes' => 0,
        'is_active' => true,
    ]);
});

test('recipient resolver resolves recipients for event', function () {
    $resolver = new RecipientResolver();
    
    $event = NotificationEvent::create([
        'event_key' => 'reservation.requested',
        'event_type' => 'reservation',
        'reservation_id' => 1,
        'idempotency_key' => 'test-key-123',
        'status' => 'pending',
    ]);
    
    $recipients = $resolver->resolve($event);
    
    expect($recipients)->toBeInstanceOf(\Illuminate\Support\Collection::class);
});

test('recipient resolver gets rules for event', function () {
    $rules = NotificationRule::getRulesForEvent('reservation.requested');
    
    expect($rules)->toHaveCount(2);
    expect($rules->first()->event_key)->toBe('reservation.requested');
});

test('notification rule should send returns true for active rules', function () {
    $rule = NotificationRule::where('event_key', 'reservation.requested')->first();
    
    expect($rule->shouldSend())->toBe(true);
});

test('inactive rules are not included', function () {
    // Deactivate all rules
    NotificationRule::query()->update(['is_active' => false]);
    
    $rules = NotificationRule::getRulesForEvent('reservation.requested');
    
    expect($rules)->toHaveCount(0);
});

test('recipient resolver gets recipients for specific event types', function () {
    $resolver = new RecipientResolver();
    
    $recipients = $resolver->getRecipientsForEventType('reservation.requested', 1);
    
    expect($recipients)->toBeInstanceOf(\Illuminate\Support\Collection::class);
});
