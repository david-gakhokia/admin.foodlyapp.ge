<?php

use App\Services\Email\EmailDispatcher;
use SendGrid;
use Illuminate\Foundation\Testing\TestCase;

beforeEach(function () {
    // This runs in Laravel test environment
    $this->artisan('config:clear');
    
    // Mock SendGrid API key in config
    config(['notifications.providers.sendgrid.api_key' => 'test-api-key']);
    config(['notifications.providers.sendgrid.from_email' => 'test@foodly.space']);
    config(['notifications.providers.sendgrid.from_name' => 'FOODLY Test']);
});

it('initializes email dispatcher with valid config', function () {
    $dispatcher = new EmailDispatcher();
    
    expect($dispatcher)->toBeInstanceOf(EmailDispatcher::class);
    expect($dispatcher->getClient())->toBeInstanceOf(SendGrid::class);
});

it('throws exception with invalid config', function () {
    config(['notifications.providers.sendgrid.api_key' => null]);
    
    expect(fn() => new EmailDispatcher())
        ->toThrow(Exception::class, 'SendGrid API key is not configured');
});

it('can check rate limit', function () {
    $dispatcher = new EmailDispatcher();
    
    expect($dispatcher->checkRateLimit())->toBe(true);
});
