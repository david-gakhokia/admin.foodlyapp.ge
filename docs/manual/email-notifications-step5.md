# FOODLY — Email Notifications
**STEP 5 — Outbox Listener & Processor Job (Queue, Idempotency, Retries)**

---

## მიზანი
ამ ეტაპზე ვაშენებთ მთლიანი გაგზავნის ძრავს:
1) **Listener-ები** დომენურ მოვლენებზე (`Reservation*`) — Outbox-ში (`notification_events`) ამატებენ ჩანაწერს.  
2) **Processor Job** — რიგიდან იღებს Outbox ჩანაწერს, პოულობს მიმღებებს, ირჩევს შესაბამის შაბლონს, იძახებს `EmailDispatcher`‑ს და წერს `notification_deliveries`‑ში.

ვინარჩუნებთ **idempotency**‑ს (ერთსა და იმავე მოვლენის დუბლიკატი არ გაიგზავნოს) და ვაყენებთ **retry/backoff** ლოგიკას.

---

## 1) Domain Events (სტუბ კლასები)

```php
<?php
// app/Domain/Reservations/Events/ReservationRequested.php
namespace App\Domain\Reservations\Events;

class ReservationRequested {
    public function __construct(public int $reservationId) {}
}

// app/Domain/Reservations/Events/ReservationConfirmed.php
namespace App\Domain\Reservations\Events;

class ReservationConfirmed {
    public function __construct(public int $reservationId) {}
}

// app/Domain/Reservations/Events/ReservationDeclined.php
namespace App\Domain\Reservations\Events;

class ReservationDeclined {
    public function __construct(public int $reservationId) {}
}

// app/Domain/Reservations/Events/ReservationPreArrivalDue.php
namespace App\Domain\Reservations\Events;

class ReservationPreArrivalDue {
    public function __construct(public int $reservationId) {}
}

// app/Domain/Reservations/Events/ReservationPaymentSucceeded.php
namespace App\Domain\Reservations\Events;

class ReservationPaymentSucceeded {
    public function __construct(public int $reservationId) {}
}

// app/Domain/Reservations/Events/ReservationPaymentFailed.php
namespace App\Domain\Reservations\Events;

class ReservationPaymentFailed {
    public function __construct(public int $reservationId) {}
}
```

> შენიშვნა: შემდგომში ეს მოვლენები გამოიძახება იქ, სადაც რეზერვაციის სტატუსი იცვლება (სერვის/რეპოზიტორი).

---

## 2) Listener — Outbox-ში ჩაწერა

```php
<?php
// app/Listeners/Notifications/DispatchReservationNotifications.php
namespace App\Listeners\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\NotificationEvent;

class DispatchReservationNotifications implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(object $event): void
    {
        $reservationId = $event->reservationId;
        $eventKey = $this->mapEventKey($event);

        // ააგე payload (გააკეთე შენი რეალური რეპოზიტორით)
        $payload = $this->buildPayload($reservationId);

        // უნიკალური idempotency განსაკუთრებული მიმღებისთვის დაამატებს Processor Job-ში,
        // აქ კი Outbox-ის დონეზე Event-ს ვუნიშნავთ უნიკალურ გასაღებს.
        $idemKey = sprintf('reservation:%d:%s', $reservationId, str_replace('.', '-', $eventKey));

        NotificationEvent::firstOrCreate(
            ['idempotency_key' => $idemKey],
            [
                'event_key'      => $eventKey,
                'reservation_id' => $reservationId,
                'payload'        => $payload,
                'status'         => 'pending',
            ]
        );
    }

    private function mapEventKey(object $event): string
    {
        return match (true) {
            $event instanceof \App\Domain\Reservations\Events\ReservationRequested           => 'reservation.requested',
            $event instanceof \App\Domain\Reservations\Events\ReservationConfirmed          => 'reservation.confirmed',
            $event instanceof \App\Domain\Reservations\Events\ReservationDeclined           => 'reservation.declined',
            $event instanceof \App\Domain\Reservations\Events\ReservationPreArrivalDue      => 'reservation.prearrival',
            $event instanceof \App\Domain\Reservations\Events\ReservationPaymentSucceeded   => 'reservation.payment_succeeded',
            $event instanceof \App\Domain\Reservations\Events\ReservationPaymentFailed      => 'reservation.payment_failed',
            default => 'unknown',
        };
    }

    private function buildPayload(int $reservationId): array
    {
        // აქ ჩაანაცვლე შენი მონაცემების ამოღებით (Reservation + Restaurant + Client + URLs)
        // ნიმუში:
        return [
            'reservation_id' => $reservationId,
            'code' => 'ABCD-7890',
            'restaurant' => ['id'=>77,'name'=>'Exodus','address'=>'Batumi'],
            'client' => ['name'=>'Giorgi','email'=>'g@example.com'],
            'datetime_local' => now()->addDay()->format('Y-m-d H:i'),
            'guests' => 4,
            'urls' => [
                'manager_portal' => "https://foodly.pro/manager/reservations/{$reservationId}",
                'client_view'    => "https://foodly.pro/r/ABCD-7890",
                'payment_retry'  => "https://foodly.pro/pay/retry?token=...",
                'receipt_url'    => "https://foodly.pro/invoices/98765",
            ]
        ];
    }
}
```

**EventServiceProvider**‑ში დაამატე ბმულები:

```php
// app/Providers/EventServiceProvider.php
protected $listen = [
    \App\Domain\Reservations\Events\ReservationRequested::class => [
        \App\Listeners\Notifications\DispatchReservationNotifications::class,
    ],
    \App\Domain\Reservations\Events\ReservationConfirmed::class => [
        \App\Listeners\Notifications\DispatchReservationNotifications::class,
    ],
    \App\Domain\Reservations\Events\ReservationDeclined::class => [
        \App\Listeners\Notifications\DispatchReservationNotifications::class,
    ],
    \App\Domain\Reservations\Events\ReservationPreArrivalDue::class => [
        \App\Listeners\Notifications\DispatchReservationNotifications::class,
    ],
    \App\Domain\Reservations\Events\ReservationPaymentSucceeded::class => [
        \App\Listeners\Notifications\DispatchReservationNotifications::class,
    ],
    \App\Domain\Reservations\Events\ReservationPaymentFailed::class => [
        \App\Listeners\Notifications\DispatchReservationNotifications::class,
    ],
];
```

---

## 3) Processor Job — გაგზავნა და ლოგირება

```php
<?php
// app/Jobs/ProcessNotificationEvent.php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\NotificationEvent;
use App\Models\NotificationDelivery;
use App\Models\NotificationRule;
use App\Services\Email\EmailDispatcher;
use Throwable;

class ProcessNotificationEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public function backoff(): array
    {
        return [60, 300, 900, 3600, 10800];
    }

    public function __construct(public int $eventId) {}

    public function handle(EmailDispatcher $dispatcher): void
    {
        $event = NotificationEvent::query()->findOrFail($this->eventId);
        if ($event->status === 'done') return;

        // მონიშნე, რომ ვამუშავებთ
        $event->update(['status' => 'processing']);

        try {
            // 1) მიმღებები წესებიდან (მინ. იმპლემენტაცია — შეგიძლია ჩაანაცვლო შენი ლოგიკით)
            $recipients = $this->resolveRecipients($event);

            // 2) თითო მიმღებისთვის გააშვი გაგზავნა
            foreach ($recipients as $rcpt) {
                $templateKey = $this->resolveTemplateKey($event->event_key, $rcpt['type']);
                $idemKey = sprintf(
                    '%s:%s:%s:%s',
                    str_replace('.', ':', $event->event_key),  // reservation:confirmed
                    $event->reservation_id,
                    $rcpt['type'],                             // manager|admin|client
                    'email'
                );

                $data = $this->buildDynamicData($event->payload, $rcpt);

                $messageId = $dispatcher->sendTemplate(
                    $rcpt['email'],
                    $templateKey,
                    $data,
                    $idemKey
                );

                NotificationDelivery::create([
                    'event_id'        => $event->id,
                    'recipient_type'  => $rcpt['type'],
                    'recipient_email' => $rcpt['email'],
                    'provider'        => 'sendgrid',
                    'message_id'      => $messageId,
                    'status'          => 'sent',
                    'meta'            => null,
                ]);
            }

            // 3) წარმატება
            $event->update(['status' => 'done']);
        } catch (Throwable $e) {
            Log::error('ProcessNotificationEvent failed', ['event_id' => $event->id, 'error' => $e->getMessage()]);
            $event->update([
                'status' => 'failed',
                'retries' => DB::raw('retries + 1'),
                'last_error' => $e->getMessage(),
            ]);
            // Exception გასროლა საჭიროა, რომ queue retry მოახდინოს:
            throw $e;
        }
    }

    private function resolveRecipients(NotificationEvent $event): array
    {
        // MVP ლოგიკა: გამოსცვალე შენი მონაცემებით (რესტორნის კონტაქტები, admin e-mail, client e-mail)
        $clientEmail = $event->payload['client']['email'] ?? null;

        $list = [];
        // Manager
        $list[] = ['type' => 'manager', 'email' => 'manager@restaurant.example'];
        // Admin (Foodly)
        $list[] = ['type' => 'admin', 'email' => 'admin@foodly.space'];
        // Client
        if ($clientEmail) $list[] = ['type' => 'client', 'email' => $clientEmail];

        return $list;
    }

    private function resolveTemplateKey(string $eventKey, string $recipientType): string
    {
        // მარტივი რუთინგი (საჭიროა მხოლოდ client keys, დანარჩენი დაამატე საჭიროებისას)
        return match ([$eventKey, $recipientType]) {
            ['reservation.requested','manager'] => 'reservation.requested.manager.email',
            ['reservation.requested','admin']   => 'reservation.requested.admin.email',
            ['reservation.requested','client']  => 'reservation.requested.client.email',

            ['reservation.confirmed','client']  => 'reservation.confirmed.client.email',
            ['reservation.declined','client']   => 'reservation.declined.client.email',

            ['reservation.prearrival','client'] => 'reservation.prearrival.client.email',

            ['reservation.payment_succeeded','client'] => 'reservation.payment_succeeded.client.email',
            ['reservation.payment_failed','client']    => 'reservation.payment_failed.client.email',

            default => throw new \RuntimeException("No template mapping for {$eventKey} → {$recipientType}"),
        };
    }

    private function buildDynamicData(array $payload, array $rcpt): array
    {
        // შეგიძლია დაამატო მრავალენოვნება ან სხვადასხვა ტექსტები per recipient
        return [
            'subject'           => $this->subjectLine($payload, $rcpt),
            'brand_logo_url'    => 'https://foodly.space/assets/logo-email.png',
            'brand_tagline'     => 'Book, dine, enjoy.',
            'brand_primary_color'=> '#ff6b00',
            'year'              => (string) now()->year,
            'support_url'       => 'https://foodly.space/contact',

            'reservation'       => ['code' => $payload['code'] ?? ''],
            'restaurant'        => ['name' => $payload['restaurant']['name'] ?? ''],
            'datetime_local'    => $payload['datetime_local'] ?? '',
            'guests'            => $payload['guests'] ?? 0,
            'urls'              => $payload['urls'] ?? [],

            'cta_label'         => 'დეტალების ნახვა',
            'cta_url'           => $payload['urls']['client_view'] ?? null,
        ];
    }

    private function subjectLine(array $payload, array $rcpt): string
    {
        return sprintf(
            'FOODLY — %s (%s)',
            $payload['restaurant']['name'] ?? 'Reservation',
            strtoupper($rcpt['type'])
        );
    }
}
```

Queue-ში Job ჩასმა Outbox ჩანაწერებისათვის შეგიძლია გააკეთო Event-ის შექმნისას ან ცალკე Scheduler-ით:

```php
// სადმე შემდგომში:
\App\Jobs\ProcessNotificationEvent::dispatch($notificationEvent->id)->onQueue('default');
```

---

## 4) Queue გაშვება (database)

```bash
php artisan queue:work database --queue=default --tries=5 --backoff=60
```

- `--tries` და `--backoff` უკვე კომპლიმენტარია Job-ის `$tries`/`backoff()`-თან.  
- ჩაფლუნვისას Job ჩაიწერება `failed_jobs` ცხრილში, საიდანაც შეგიძლია `php artisan queue:retry`.

---

## 5) სწრაფი შემოწმება (Route)

```php
// routes/web.php (დროებითი ტესტი)
use App\Domain\Reservations\Events\ReservationConfirmed;
use Illuminate\Support\Facades\Event;

Route::get('/test-outbox', function () {
    // აამუშავებს Listener-ს → ჩაწერს notification_events → (შენ დაამატებ dispatch job-ს)
    Event::dispatch(new ReservationConfirmed(12345));
    return 'OK';
});
```

შემდეგ გაუშვი worker და ეცადე ერთი Outbox ჩანაწერი დაამუშაო ხელით:

```php
php artisan tinker
>>> $e = \App\Models\NotificationEvent::latest()->first();
>>> \App\Jobs\ProcessNotificationEvent::dispatchSync($e->id);
```

თუ ყველაფერი სწორადაა, DB-ში უნდა დაიმატოს ერთი ან რამდენიმე `notification_deliveries` ჩანაწერი `status='sent'`‑ით, ხოლო Event გახდეს `done`.

---

## 6) Best Practices
- **Idempotency**: Outbox დონეზე უნიკალური key; თითო მიმღებისთვის Processor აშენებს უფრო კონკრეტულ `idemKey`‑ს (recipient‑ით).  
- **Observability**: STEP 6 ვებჰუქი `message_id`‑ზე/`idempotency_key`‑ზე დააჯექი.  
- **Error Handling**: გამონაკლისის ნასროლად დატოვება მნიშვნელოვანია, რომ Queue Retry იმუშაოს.  
- **Rules/Recipients**: ახლა MVP ლოგიკაა; შემდეგ ჩაანაცვლე Restaurant Contacts + Notification Rules ცხრილებით.

---

## შემდეგი ნაბიჯი
**STEP 6 — Webhook (SendGrid Events)** — დავამატებთ ვებჰუქის controller-ს, რომელიც `delivered/bounced/opened/clicked` სტატუსებს ჩაწერს `notification_deliveries` ცხრილში და გააახლებს მონიტორინგს.
