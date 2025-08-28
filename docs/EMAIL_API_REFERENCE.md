# 📚 Email Notifications - API Reference

## 🎯 Classes & Methods

### Events

#### `ReservationStatusChanged`
**Location**: `app/Events/ReservationStatusChanged.php`

```php
class ReservationStatusChanged
{
    public $reservation;    // Reservation model instance
    public $oldStatus;      // Previous status string
    public $newStatus;      // New status string
    
    public function __construct($reservation, $oldStatus, $newStatus)
}
```

**Usage**:
```php
ReservationStatusChanged::dispatch($reservation, 'Pending', 'Confirmed');
```

---

### Listeners

#### `QueueAdminReservationEmails`
**Location**: `app/Listeners/QueueAdminReservationEmails.php`

```php
class QueueAdminReservationEmails
{
    public function handle(ReservationStatusChanged $event): void
    public function determineRecipients(Reservation $reservation): array
    public function createMailable(string $status, Reservation $reservation): ?Mailable
}
```

**Recipients**: Returns admin users based on configuration
**Supported Statuses**: Pending, Confirmed, Completed, Cancelled

#### `QueueClientReservationEmails`
**Location**: `app/Listeners/QueueClientReservationEmails.php`

```php
class QueueClientReservationEmails
{
    public function handle(ReservationStatusChanged $event): void
    public function determineRecipients(Reservation $reservation): array
    public function createMailable(string $status, Reservation $reservation): ?Mailable
}
```

**Recipients**: Reservation client email
**Supported Statuses**: Pending, Confirmed, Completed, Cancelled

#### `QueueRestaurantReservationEmails`
**Location**: `app/Listeners/QueueRestaurantReservationEmails.php`

```php
class QueueRestaurantReservationEmails
{
    public function handle(ReservationStatusChanged $event): void
    public function determineRecipients(Reservation $reservation): array  
    public function createMailable(string $status, Reservation $reservation): ?Mailable
}
```

**Recipients**: Restaurant owner/manager emails
**Supported Statuses**: Pending, Confirmed, Completed, Cancelled

---

### Jobs

#### `SendAdminReservationEmail`
**Location**: `app/Jobs/SendAdminReservationEmail.php`

```php
class SendAdminReservationEmail implements ShouldQueue
{
    use Queueable;
    
    public string $to;                    // Recipient email
    public Mailable $mailable;            // Email template
    public int $reservationId;            // Reservation ID
    
    public function __construct(string $to, Mailable $mailable, int $reservationId)
    public function handle(): void
}
```

**Queue**: `default`
**Timeout**: 60 seconds
**Retries**: 3 attempts

#### `SendClientReservationEmail`
**Location**: `app/Jobs/SendClientReservationEmail.php`

```php
class SendClientReservationEmail implements ShouldQueue
{
    use Queueable;
    
    public string $to;
    public Mailable $mailable;
    public int $reservationId;
    
    public function __construct(string $to, Mailable $mailable, int $reservationId)
    public function handle(): void
}
```

#### `SendRestaurantReservationEmail`
**Location**: `app/Jobs/SendRestaurantReservationEmail.php`

```php
class SendRestaurantReservationEmail implements ShouldQueue
{
    use Queueable;
    
    public string $to;
    public Mailable $mailable;
    public int $reservationId;
    
    public function __construct(string $to, Mailable $mailable, int $reservationId)
    public function handle(): void
}
```

---

### Mailable Classes

#### Admin Mailables

**`AdminPendingEmail`**
```php
class AdminPendingEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "ახალი რეზერვაცია მოლოდინშია"
- **Template**: `emails.admin.pending`

**`AdminConfirmedEmail`**
```php
class AdminConfirmedEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "რეზერვაცია დადასტურდა"
- **Template**: `emails.admin.confirmed`

**`AdminCompletedEmail`**
```php
class AdminCompletedEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "რეზერვაცია დასრულდა"
- **Template**: `emails.admin.completed`

**`AdminCancelledEmail`**
```php
class AdminCancelledEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "რეზერვაცია გაუქმდა"
- **Template**: `emails.admin.cancelled`

#### Client Mailables

**`ClientPendingEmail`**
```php
class ClientPendingEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "თქვენი რეზერვაცია მიღებულია"
- **Template**: `emails.client.pending`

**`ClientConfirmedEmail`**
```php
class ClientConfirmedEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "თქვენი რეზერვაცია დადასტურდა"
- **Template**: `emails.client.confirmed`

**`ClientCompletedEmail`**
```php
class ClientCompletedEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "მადლობთ ჩვენთან ყოფნისთვის!"
- **Template**: `emails.client.completed`

**`ClientCancelledEmail`**
```php
class ClientCancelledEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "თქვენი რეზერვაცია გაუქმდა"
- **Template**: `emails.client.cancelled`

#### Restaurant Mailables

**`RestaurantPendingEmail`**
```php
class RestaurantPendingEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "ახალი რეზერვაცია მოლოდინშია"
- **Template**: `emails.restaurant.pending`

**`RestaurantConfirmedEmail`**
```php
class RestaurantConfirmedEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "რეზერვაცია დადასტურდა"
- **Template**: `emails.restaurant.confirmed`

**`RestaurantCompletedEmail`**
```php
class RestaurantCompletedEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "რეზერვაცია დასრულდა"
- **Template**: `emails.restaurant.completed`

**`RestaurantCancelledEmail`**
```php
class RestaurantCancelledEmail extends Mailable
{
    public $reservation;
    public $restaurantName;
    
    public function __construct($reservation)
    public function build()
}
```
- **Subject**: "რეზერვაცია გაუქმდა"
- **Template**: `emails.restaurant.cancelled`

---

### Model Extensions

#### `Reservation` Model Methods

**`getRestaurant()`**
```php
public function getRestaurant()
{
    if ($this->restaurant_id) {
        return $this->restaurant;
    }
    
    if ($this->place_id && $this->place) {
        return $this->place->restaurant ?? null;
    }
    
    if ($this->table_id && $this->table) {
        return $this->table->restaurant ?? null;
    }
    
    return null;
}
```
**Returns**: Restaurant model instance or null

**`getRestaurantName()`**
```php
public function getRestaurantName(): string
{
    $restaurant = $this->getRestaurant();
    return $restaurant ? $restaurant->name : 'N/A';
}
```
**Returns**: Restaurant name string, 'N/A' if not found

---

### Component Methods

#### `ReservationStatusUpdater` (Livewire)

**`updateStatus(string $newStatus)`**
```php
public function updateStatus($newStatus)
{
    $oldStatus = $this->reservation->status;
    
    $this->reservation->update([
        'status' => $newStatus,
        'updated_at' => now()
    ]);
    
    ReservationStatusChanged::dispatch(
        $this->reservation, 
        $oldStatus, 
        $newStatus
    );
    
    $this->dispatch('reservation-updated');
}
```

**Properties**:
```php
public $reservation;      // Current reservation instance
public $statusOptions;    // Available status options array
```

**Status Options Structure**:
```php
[
    'Pending' => [
        'label' => 'მოლოდინში',
        'icon' => '⏳',
        'class' => 'bg-gradient-to-r from-yellow-100...'
    ],
    'Confirmed' => [
        'label' => 'დადასტურებული',
        'icon' => '✅',
        'class' => 'bg-gradient-to-r from-green-100...'
    ],
    // ... other statuses
]
```

---

## 🔧 Configuration

### Queue Configuration
**File**: `config/queue.php`

```php
'connections' => [
    'database' => [
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => true,
    ],
],
```

### Mail Configuration
**File**: `config/mail.php`

```php
'default' => env('MAIL_MAILER', 'smtp'),

'mailers' => [
    'smtp' => [
        'transport' => 'smtp',
        'host' => env('MAIL_HOST', 'smtp.hostinger.com'),
        'port' => env('MAIL_PORT', 465),
        'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
    ],
],
```

### Event Registration
**File**: `app/Providers/EventServiceProvider.php`

```php
protected $listen = [
    ReservationStatusChanged::class => [
        QueueAdminReservationEmails::class,
        QueueClientReservationEmails::class, 
        QueueRestaurantReservationEmails::class,
    ],
];
```

---

## 🎯 Template Variables

### Available in All Templates

```php
$reservation          // Reservation model instance
$restaurantName       // Safe restaurant name string
```

### Reservation Properties
```php
$reservation->id                    // Reservation ID
$reservation->client_name           // Client name
$reservation->client_email          // Client email
$reservation->client_phone          // Client phone
$reservation->date                  // Reservation date
$reservation->time                  // Reservation time
$reservation->people                // Number of people
$reservation->notes                 // Additional notes
$reservation->status                // Current status
$reservation->created_at            // Creation timestamp
$reservation->updated_at            // Last update timestamp
```

### Template Usage Example
```blade
<h1>თქვენი რეზერვაცია {{ $restaurantName }}-ში</h1>

<p><strong>სახელი:</strong> {{ $reservation->client_name }}</p>
<p><strong>თარიღი:</strong> {{ $reservation->date }}</p>
<p><strong>დრო:</strong> {{ $reservation->time }}</p>
<p><strong>სტატუსი:</strong> {{ $reservation->status }}</p>
```

---

## 🚀 Artisan Commands

### Email System Commands

```bash
# Test email sending
php artisan test:send-email --to=test@example.com --type=client --status=confirmed

# Process queue jobs
php artisan queue:work

# Restart queue workers
php artisan queue:restart

# Check failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all

# Clear all jobs
php artisan queue:clear
```

### Custom Test Commands

```bash
# Test complete email flow
php artisan email:test-flow

# Test specific listener
php artisan email:test-listener --type=client

# Send test reservation email
php artisan email:test-reservation --id=1
```

---

## 📊 Database Schema

### `jobs` Table
```sql
CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL,
    reserved_at INT UNSIGNED NULL,
    available_at INT UNSIGNED NOT NULL,
    created_at INT UNSIGNED NOT NULL,
    INDEX jobs_queue_index (queue)
);
```

### `failed_jobs` Table
```sql
CREATE TABLE failed_jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload LONGTEXT NOT NULL,
    exception LONGTEXT NOT NULL,
    failed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 🔍 Error Codes & Messages

### Common Errors

**`EmailNotSentException`**
- **Code**: `EMAIL_001`
- **Message**: "Failed to send email"
- **Cause**: SMTP connection issue or invalid recipient

**`InvalidStatusException`**
- **Code**: `EMAIL_002`  
- **Message**: "Invalid reservation status"
- **Cause**: Status not in allowed options

**`ReservationNotFoundException`**
- **Code**: `EMAIL_003`
- **Message**: "Reservation not found"
- **Cause**: Reservation deleted before job processed

**`RecipientNotFoundException`**
- **Code**: `EMAIL_004`
- **Message**: "No recipients found"
- **Cause**: Missing admin/restaurant email configuration

---

## 🎨 Customization Points

### Adding New Status

1. **Update Component**:
```php
// ReservationStatusUpdater.php
public $statusOptions = [
    // ... existing statuses
    'NewStatus' => [
        'label' => 'ახალი სტატუსი',
        'icon' => '🆕',
        'class' => 'bg-gradient-to-r from-purple-100...'
    ],
];
```

2. **Create Mailable Classes**:
```bash
php artisan make:mail Admin/AdminNewStatusEmail
php artisan make:mail Client/ClientNewStatusEmail  
php artisan make:mail Restaurant/RestaurantNewStatusEmail
```

3. **Update Listeners**:
```php
// Add to each listener's createMailable method
'NewStatus' => new ClientNewStatusEmail($reservation),
```

4. **Create Templates**:
```bash
touch resources/views/emails/admin/newstatus.blade.php
touch resources/views/emails/client/newstatus.blade.php
touch resources/views/emails/restaurant/newstatus.blade.php
```

### Custom Recipients

```php
// Override in listener
public function determineRecipients(Reservation $reservation): array
{
    // Custom logic for recipient determination
    return ['custom@example.com'];
}
```

### Template Customization

```php
// Override in Mailable
public function build()
{
    return $this->subject('Custom Subject')
                ->view('emails.custom.template')
                ->with([
                    'customVar' => 'Custom Value',
                    'reservation' => $this->reservation,
                ]);
}
```
