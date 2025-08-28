# რეზერვაციის შეტყობინებების სისტემა - დოკუმენტაცია

## 📋 მიმოხილვა

ეს დოკუმენტი აღწერს რეზერვაციის სტატუსის ცვლილებისას ელ.ფოსტის შეტყობინებების გაგზავნის სისტემას Foodly აპლიკაციაში.

## 🏗️ არქიტექტურა

სისტემა ეფუძნება Laravel-ის Event-Listener-Job-Mail პატერნს:

```
სტატუსის ცვლილება → Event → Listeners → Jobs → Email
```

### მთავარი კომპონენტები:

1. **Event**: `ReservationStatusChanged`
2. **Listeners**: Admin, Client, Restaurant (სამი სახეობა)
3. **Jobs**: `SendAdminReservationEmail`, `SendClientReservationEmail`, `SendRestaurantReservationEmail`
4. **Mail Classes**: Status-ზე დაფუძნებული Mailable კლასები
5. **Templates**: Blade შაბლონები ელ.ფოსტისთვის

## 🔧 ტექნიკური იმპლემენტაცია

### 1. Livewire კომპონენტი - `ReservationStatusUpdater`

**ფაილი**: `app/Livewire/ReservationStatusUpdater.php`

```php
public function updateStatus($newStatus)
{
    // სტატუსის განახლება
    $this->reservation->update(['status' => $newStatus]);
    
    // Event-ის გაშვება
    ReservationStatusChanged::dispatch($this->reservation, $oldStatus, $newStatus);
}
```

**მიზანი**: რეზერვაციის სტატუსის განახლება და შეტყობინებების პროცესის ინიციირება.

### 2. Event კლასი - `ReservationStatusChanged`

**ფაილი**: `app/Events/ReservationStatusChanged.php`

```php
class ReservationStatusChanged
{
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

**მიზანი**: Event data-ს გადაცემა listeners-ისთვის.

### 3. Listener კლასები

#### `QueueAdminReservationEmails`
**ფაილი**: `app/Listeners/Admin/QueueAdminReservationEmails.php`

```php
public function handle(ReservationStatusChanged $event)
{
    // Admin recipients-ების განსაზღვრა
    $recipients = ['admin@foodlyapp.ge'];
    
    // Status-ზე დაფუძნებული Mailable-ის შერჩევა
    $mailable = match($event->newStatus) {
        'Pending' => new AdminPendingEmail($event->reservation),
        'Confirmed' => new AdminConfirmedEmail($event->reservation),
        'Completed' => new AdminCompletedEmail($event->reservation),
        'Cancelled' => new AdminCancelledEmail($event->reservation),
    };
    
    // Job-ის Queue-ში დამატება
    dispatch(new SendAdminReservationEmail($recipient, $mailable, $event->reservation->id));
}
```

#### `QueueClientReservationEmails`
**ფაილი**: `app/Listeners/Client/QueueClientReservationEmails.php`

```php
public function handle(ReservationStatusChanged $event)
{
    // Client email-ის მიღება
    $recipient = $event->reservation->email;
    
    // Mailable-ის შერჩევა
    $mailable = match($event->newStatus) {
        'Pending' => new ClientPendingEmail($event->reservation),
        'Confirmed' => new ClientConfirmedEmail($event->reservation),
        'Completed' => new ClientCompletedEmail($event->reservation),
        'Cancelled' => new ClientCancelledEmail($event->reservation),
    };
    
    // Job-ის dispatch
    dispatch(new SendClientReservationEmail($recipient, $mailable, $event->reservation->id));
}
```

#### `QueueRestaurantReservationEmails`
**ფაილი**: `app/Listeners/Restaurant/QueueRestaurantReservationEmails.php`

- Restaurant-ის email მისამართების განსაზღვრა
- Restaurant-ზე ორიენტირებული Mailable კლასების გამოყენება

### 4. Job კლასები

#### `SendAdminReservationEmail`
**ფაილი**: `app/Jobs/SendAdminReservationEmail.php`

```php
public function handle()
{
    // Reservation მოდელის ახალი ჩატვირთვა serialization-ის შემდეგ
    $reservation = Reservation::find($this->reservationId);
    
    // Fresh Mailable instance-ის შექმნა
    $mailableClass = get_class($this->mailable);
    $mailable = new $mailableClass($reservation);
    
    // Email-ის გაგზავნა
    Mail::to($this->to)->send($mailable);
}
```

**მნიშვნელოვანი**: Job-ები reservation ID-ს ინახავენ ნაცვლად მთელი ობიექტისა serialization პრობლემების თავიდან ასაცილებლად.

### 5. Mail კლასები

#### მაგალითი: `ClientConfirmedEmail`
**ფაილი**: `app/Mail/Client/ClientConfirmedEmail.php`

```php
class ClientConfirmedEmail extends Mailable
{
    public $reservation;
    public $restaurantName;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
        
        // Restaurant name-ის წინასწარ გამოთვლა serialization პრობლემების თავიდან ასაცილებლად
        if (method_exists($reservation, 'getRestaurantName')) {
            $this->restaurantName = $reservation->getRestaurantName();
        } else {
            $this->restaurantName = 'N/A';
        }
    }

    public function build()
    {
        return $this->subject('რეზერვაციის დეტალები - დადასტურებულია')
                    ->view('emails.client.confirmed')
                    ->with([
                        'reservation' => $this->reservation,
                        'restaurantName' => $this->restaurantName
                    ]);
    }
}
```

### 6. Email Templates

**მდებარეობა**: `resources/views/emails/`

```
emails/
├── admin/
│   ├── pending.blade.php
│   ├── confirmed.blade.php
│   ├── completed.blade.php
│   └── cancelled.blade.php
├── client/
│   ├── pending.blade.php
│   ├── confirmed.blade.php
│   ├── completed.blade.php
│   └── cancelled.blade.php
└── restaurant/
    ├── pending.blade.php
    ├── confirmed.blade.php
    ├── completed.blade.php
    └── cancelled.blade.php
```

**Template ცვლადები**:
- `$reservation` - რეზერვაციის ინფორმაცია
- `$restaurantName` - რესტორნის სახელი (null-safe)

## 🔄 მუშაობის პროცესი

### ნაბიჯ 1: სტატუსის ცვლილება
```php
// ReservationStatusUpdater.php
ReservationStatusChanged::dispatch($reservation, $oldStatus, $newStatus);
```

### ნაბიჯ 2: Event-ის მუშაობა
Event-ი გაეშვება და EventServiceProvider.php-ში რეგისტრირებული listeners ამუშავდება:

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

### ნაბიჯ 3: Listeners-ების მუშაობა
ყველა listener განსაზღვრავს recipients-ებს და სათანადო Mailable კლასებს, შემდეგ Jobs-ს queue-ში ამატებს.

### ნაბიჯ 4: Queue Processing
Queue worker-ი ამუშავებს Jobs-ებს და აგზავნის emails-ებს:

```bash
php artisan queue:work
```

### ნაბიჯ 5: Email გაგზავნა
Mail facade SMTP-ის გავლით აგზავნის emails-ებს recipients-ისთვის.

## ⚙️ კონფიგურაცია

### Mail Settings (.env)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=admin@foodlyapp.ge
MAIL_PASSWORD=FoodlyApp_2015
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="admin@foodlyapp.ge"
MAIL_FROM_NAME="Foodly App"
ADMIN_EMAIL="admin@foodlyapp.ge"
```

### Queue Configuration
```env
QUEUE_CONNECTION=database
```

## 🧪 ტესტირება

### 1. უბრალო Email ტესტი
```bash
php artisan test:email
```

### 2. რეალური რეზერვაციით ტესტი
```bash
php artisan test:real-reservation [reservation_id]
```

### 3. მარტივი შეტყობინება
```bash
php artisan test:simple-notification [reservation_id]
```

### 4. Queue-ის მუშაობის შემოწმება
```bash
# Jobs-ების რაოდენობის შემოწმება
php artisan tinker --execute="echo 'Jobs: ' . \DB::table('jobs')->count();"

# Queue-ის დამუშავება
php artisan queue:work --stop-when-empty
```

## 🔧 ადმინისტრირება

### Queue Worker-ის გაშვება

#### Production-ისთვის:
```bash
# Windows
.\start_queue_worker.bat

# Linux/Mac
nohup php artisan queue:work --sleep=3 --tries=3 --timeout=90 &
```

#### Development-ისთვის:
```bash
# ყველა pending job-ის დამუშავება
.\process_email_queue.bat

# ან
php artisan queue:work --stop-when-empty
```

### Queue მონიტორინგი
```bash
# Queue-ის გასუფთავება
php artisan queue:clear

# Failed jobs-ების ნახვა
php artisan queue:failed

# Failed jobs-ების retry
php artisan queue:retry all
```

## 🐛 ხშირი პრობლემები და მათი გადაწყვეტა

### 1. Emails არ გაიგზავნება
**მიზეზი**: Queue worker არ მუშაობს
**გადაწყვეტა**: 
```bash
php artisan queue:work --stop-when-empty
```

### 2. Template შეცდომები
**მიზეზი**: Mail კლასებში არასწორი data passing
**გადაწყვეტა**: შეამოწმეთ Mailable კლასის constructor და build მეთოდი

### 3. Restaurant name არ ჩანს
**მიზეზი**: `getRestaurantName()` მეთოდი არ მუშაობს serialization-ის შემდეგ
**გადაწყვეტა**: გამოიყენეთ pre-computed `$restaurantName` property

### 4. SMTP შეცდომები
**გადაწყვეტა**: შეამოწმეთ .env ფაილში mail credentials

## 📊 მეტრიკები და ლოგირება

### ლოგ ფაილები
- `storage/logs/laravel.log` - ყველა email activity
- Queue job success/failure logs

### მნიშვნელოვანი ლოგ მესიჯები
```php
Log::info('Dispatching SendClientReservationEmail job', ['to' => $to, 'status' => $status]);
Log::info('Client reservation email sent successfully', ['to' => $to]);
Log::error('Failed to send client reservation email', ['error' => $exception->getMessage()]);
```

## 🔮 მომავალი გაუმჯობესებები

1. **Bulk Email Processing** - მრავალ recipient-ისთვის ერთდროული გაგზავნა
2. **Email Templates Editor** - Admin panel-ში template-ების რედაქტირება
3. **Retry Logic** - SMTP failures-ის შემთხვევაში automatic retry
4. **Email Analytics** - open rates, click tracking
5. **Push Notifications** - Email-ის დამატებით mobile push notifications

## 📧 მხარდაჭერა

ტექნიკური საკითხებისთვის:
- Email: dev.foodly@gmail.com
- GitHub Issues: [Repository Issues](https://github.com/david-gakhokia/api.foodlyapp.ge/issues)

## 📝 ვერსიის ისტორია

- **v1.0** - ბაზისური email notification სისტემა
- **v1.1** - Queue integration და background processing
- **v1.2** - Template fixes და null-safety improvements
- **v1.3** - Simple text notifications as fallback
