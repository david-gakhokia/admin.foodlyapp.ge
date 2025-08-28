# 🔧 Email Notifications - Developer Guide

## 🏗️ Architecture Overview

### Event-Driven Design Pattern
```
UI Action → Event → Listeners → Jobs → Queue → Email
```

### Key Components

1. **Event Broadcasting**
   - `ReservationStatusChanged` event
   - Carries reservation data, old status, new status

2. **Listeners (3 types)**
   - Determine recipients for each user type
   - Create appropriate Mailable instances
   - Dispatch jobs to queue

3. **Jobs (Queued)**
   - Handle actual email sending
   - Include retry logic and error handling
   - Reconstruct fresh models from IDs

4. **Mailable Classes**
   - Status-specific email templates
   - Pre-process data for templates
   - Handle null-safety

## 🔄 Data Flow

### 1. Status Update Trigger
```php
// ReservationStatusUpdater.php
public function updateStatus($newStatus)
{
    $oldStatus = $this->reservation->status;
    
    $this->reservation->update([
        'status' => $newStatus,
        'updated_at' => now()
    ]);
    
    // 🔥 Event dispatch
    ReservationStatusChanged::dispatch(
        $this->reservation, 
        $oldStatus, 
        $newStatus
    );
}
```

### 2. Event Processing
```php
// ReservationStatusChanged.php
class ReservationStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $reservation;
    public $oldStatus;
    public $newStatus;
    
    public function __construct($reservation, $oldStatus, $newStatus)
    {
        $this->reservation = $reservation;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }
}
```

### 3. Listener Registration
```php
// EventServiceProvider.php
protected $listen = [
    ReservationStatusChanged::class => [
        QueueAdminReservationEmails::class,
        QueueClientReservationEmails::class,
        QueueRestaurantReservationEmails::class,
    ],
];
```

### 4. Listener Implementation Pattern
```php
// Abstract pattern for all listeners
public function handle(ReservationStatusChanged $event)
{
    // 1. Determine recipients
    $recipients = $this->determineRecipients($event->reservation);
    
    // 2. Create status-specific mailable
    $mailable = $this->createMailable($event->newStatus, $event->reservation);
    
    // 3. Dispatch jobs for each recipient
    foreach ($recipients as $recipient) {
        dispatch(new SendEmailJob($recipient, $mailable, $event->reservation->id));
    }
}
```

### 5. Job Processing
```php
// Job pattern (all three jobs follow this)
public function handle()
{
    // 🔄 Reload fresh model to avoid serialization issues
    $reservation = Reservation::find($this->reservationId);
    
    if (!$reservation) {
        Log::warning('Reservation not found', ['id' => $this->reservationId]);
        return;
    }
    
    // 🆕 Create fresh mailable instance
    $mailableClass = get_class($this->mailable);
    $mailable = new $mailableClass($reservation);
    
    // 📧 Send email
    Mail::to($this->to)->send($mailable);
}
```

## 🎯 Implementation Details

### Serialization Strategy
**Problem**: Eloquent models lose custom methods when serialized in queue
**Solution**: Store only reservation ID, reload fresh model in job

```php
// ❌ Bad: Serializes entire model
dispatch(new SendEmail($to, $mailable));

// ✅ Good: Stores only ID, reloads in job
dispatch(new SendEmail($to, $mailable, $reservation->id));
```

### Null-Safety Pattern
**Problem**: Restaurant relationships may be null
**Solution**: Pre-compute values in Mailable constructors

```php
class ClientConfirmedEmail extends Mailable
{
    public $reservation;
    public $restaurantName; // Pre-computed safe value
    
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
        
        // 🛡️ Null-safe restaurant name computation
        if (method_exists($reservation, 'getRestaurantName')) {
            $this->restaurantName = $reservation->getRestaurantName();
        } else {
            $this->restaurantName = 'N/A';
        }
    }
}
```

### Template Variable Strategy
```blade
{{-- ❌ Avoid: Method calls in templates --}}
{{ $reservation->getRestaurantName() }}

{{-- ✅ Use: Pre-computed variables --}}
{{ $restaurantName }}
```

## 🔄 Adding New Status

### 1. Add to Status Options
```php
// ReservationStatusUpdater.php
public $statusOptions = [
    'Pending' => [...],
    'Confirmed' => [...],
    'Completed' => [...],
    'Cancelled' => [...],
    'NewStatus' => [
        'label' => 'ახალი სტატუსი',
        'icon' => '🆕',
        'class' => 'bg-gradient-to-r from-purple-100 to-indigo-100...'
    ],
];
```

### 2. Create Mailable Classes
```bash
# Admin
php artisan make:mail Admin/AdminNewStatusEmail

# Client  
php artisan make:mail Client/ClientNewStatusEmail

# Restaurant
php artisan make:mail Restaurant/RestaurantNewStatusEmail
```

### 3. Add to Listener Match Statements
```php
// In each listener's handle method
$mailable = match($event->newStatus) {
    'Pending' => new ClientPendingEmail($event->reservation),
    'Confirmed' => new ClientConfirmedEmail($event->reservation),
    'Completed' => new ClientCompletedEmail($event->reservation),
    'Cancelled' => new ClientCancelledEmail($event->reservation),
    'NewStatus' => new ClientNewStatusEmail($event->reservation), // Add this
    default => null,
};
```

### 4. Create Email Templates
```bash
# Create template files
touch resources/views/emails/admin/newstatus.blade.php
touch resources/views/emails/client/newstatus.blade.php
touch resources/views/emails/restaurant/newstatus.blade.php
```

## 🧪 Testing Strategy

### Unit Testing
```php
// Test event dispatch
public function test_status_change_dispatches_event()
{
    Event::fake();
    
    $component = new ReservationStatusUpdater();
    $component->updateStatus('Confirmed');
    
    Event::assertDispatched(ReservationStatusChanged::class);
}

// Test listener job dispatch
public function test_listener_dispatches_jobs()
{
    Queue::fake();
    
    $listener = new QueueClientReservationEmails();
    $event = new ReservationStatusChanged($reservation, 'Pending', 'Confirmed');
    
    $listener->handle($event);
    
    Queue::assertPushed(SendClientReservationEmail::class);
}
```

### Integration Testing
```php
// Test end-to-end email flow
public function test_email_flow()
{
    Mail::fake();
    
    // Trigger status change
    $this->post('/reservations/1/status', ['status' => 'Confirmed']);
    
    // Process queue
    $this->artisan('queue:work --stop-when-empty');
    
    // Assert emails sent
    Mail::assertSent(ClientConfirmedEmail::class);
    Mail::assertSent(AdminConfirmedEmail::class);
    Mail::assertSent(RestaurantConfirmedEmail::class);
}
```

## 🚀 Performance Optimization

### 1. Queue Configuration
```php
// config/queue.php
'connections' => [
    'database' => [
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => true, // Wait for DB transaction commit
    ],
],
```

### 2. Job Optimization
```php
class SendEmailJob implements ShouldQueue
{
    use Queueable;
    
    public $tries = 3;
    public $timeout = 60;
    public $backoff = [10, 30, 60]; // Exponential backoff
    
    public function retryUntil()
    {
        return now()->addHours(1); // Max retry window
    }
}
```

### 3. Bulk Processing
```php
// For high-volume scenarios
public function handleBulk(array $recipients, Mailable $mailable)
{
    $chunks = array_chunk($recipients, 50);
    
    foreach ($chunks as $chunk) {
        dispatch(new SendBulkEmail($chunk, $mailable))->delay(5);
    }
}
```

## 🔍 Debugging

### 1. Queue Inspection
```php
// Check pending jobs
$pendingJobs = DB::table('jobs')->count();

// Check failed jobs
$failedJobs = DB::table('failed_jobs')->count();

// Get job details
$jobDetails = DB::table('jobs')->get();
```

### 2. Event Debugging
```php
// Add to EventServiceProvider boot method
Event::listen('*', function ($eventName, array $data) {
    if (str_contains($eventName, 'ReservationStatus')) {
        Log::debug('Event fired', [
            'event' => $eventName,
            'data' => $data
        ]);
    }
});
```

### 3. Mail Debugging
```php
// Temporarily switch to log driver
Config::set('mail.default', 'log');
```

## 🔒 Security Considerations

### 1. Input Validation
```php
public function updateStatus($newStatus)
{
    // Validate status
    if (!array_key_exists($newStatus, $this->statusOptions)) {
        throw new InvalidArgumentException('Invalid status');
    }
    
    // Check permissions
    if (!auth()->user()->can('update-reservation-status')) {
        throw new UnauthorizedException();
    }
}
```

### 2. Email Content Sanitization
```php
// In Mailable classes
public function build()
{
    return $this->view('emails.client.confirmed')
                ->with([
                    'reservation' => $this->reservation,
                    'restaurantName' => Str::limit($this->restaurantName, 100),
                    'notes' => strip_tags($this->reservation->notes),
                ]);
}
```

### 3. Rate Limiting
```php
// In Job classes
use Illuminate\Support\Facades\RateLimiter;

public function handle()
{
    $executed = RateLimiter::attempt(
        'send-email:'.$this->to,
        $perMinute = 5,
        function() {
            // Send email logic
        }
    );
    
    if (!$executed) {
        $this->release(60); // Retry in 1 minute
    }
}
```

## 📈 Monitoring & Metrics

### 1. Email Success Tracking
```php
// Add to Job classes
protected function recordSuccess()
{
    Cache::increment('email.sent.total');
    Cache::increment('email.sent.'.strtolower(class_basename($this->mailable)));
}

protected function recordFailure($exception)
{
    Cache::increment('email.failed.total');
    Log::error('Email failed', [
        'job' => static::class,
        'to' => $this->to,
        'error' => $exception->getMessage()
    ]);
}
```

### 2. Queue Health Monitoring
```php
// Add to monitoring system
public function getQueueHealth()
{
    return [
        'pending_jobs' => DB::table('jobs')->count(),
        'failed_jobs' => DB::table('failed_jobs')->count(),
        'oldest_job' => DB::table('jobs')->min('created_at'),
        'newest_job' => DB::table('jobs')->max('created_at'),
    ];
}
```

## 🎯 Best Practices

1. **Always use Queue** - Never send emails synchronously
2. **Fail Gracefully** - Handle missing data elegantly
3. **Log Everything** - Track email sends for debugging
4. **Monitor Queue** - Watch for stuck or failed jobs
5. **Test Thoroughly** - Test all status combinations
6. **Sanitize Content** - Escape user input in templates
7. **Rate Limit** - Prevent email spam/abuse
8. **Retry Logic** - Configure appropriate retry strategies
