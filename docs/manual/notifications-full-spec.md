# FOODLY — Email Notifications: Full Spec (STEP 1–7)

ეს დოკუმენტი აერთიანებს ყველა ნაბიჯს, რომ პროექტში ერთიანად გამოიყენო.  
შინაარსი:
1. STEP 1–2 — მონაცემთა სტრუქტურა და Template Mapping (Seeder)
2. STEP 3 — Config (.env, mail.php, SendGrid)
3. STEP 4 — EmailDispatcher Service
4. STEP 5 — Outbox Listener & Processor Job
5. STEP 6 — Webhook (SendGrid Events)
6. STEP 7 — Scheduler (Pre‑Arrival Enqueue)

---

# STEP 1–2

_(Section file `foodly-email-notifications-step1-2.md` was not found. You can regenerate it later.)_


---

# STEP 3 — Config

_(Section file `foodly-email-notifications-step3-config.md` was not found. You can regenerate it later.)_


---

# FOODLY — Email Notifications
**STEP 4 — EmailDispatcher Service (SendGrid API, Dynamic Templates)**

---

## მიზანი
ამ ნაბიჯში ვამატებთ **EmailDispatcher** სერვისს, რომელიც ერთ ადგილზე აგენერირებს და აგზავნის წერილებს **SendGrid Dynamic Template**-ებით.  
Dispatcher მიიღებს:
- მიმღებს (`$to`),
- template-ის გასაღებს (`$templateKey` → DB-დან ამოიღებს `provider_template_id`),
- დინამიურ მონაცემებს (`$data`),
- **idempotency** გასაღებს (`$idemKey`), რომ ერთსა და იმავე მოვლენის დროს დუბლიკაცია არ მოხდეს.

Dispatcher დააბრუნებს **message_id**-ს, რომ Delivery Log-ში შევინახოთ და ვებჰუქების დროს სწორად დავახოლო.

---

## ფაილი
**`app/Services/Email/EmailDispatcher.php`**

```php
<?php

declare(strict_types=1);

namespace App\Services\Email;

use SendGrid;
use SendGrid\Mail\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\NotificationTemplate;
use Throwable;

class EmailDispatcher
{
    protected SendGrid $client;

    public function __construct(?SendGrid $client = null)
    {
        $this->client = $client ?: new SendGrid(env('SENDGRID_API_KEY'));
    }

    public function sendTemplate(
        string $to,
        string $templateKey,
        array $data,
        string $idemKey,
        ?string $fromEmail = null,
        ?string $fromName = null
    ): string {
        $tpl = NotificationTemplate::query()
            ->where('key', $templateKey)
            ->where('status', 'active')
            ->firstOrFail();

        $email = new Mail();
        $email->setFrom($fromEmail ?: config('mail.from.address'), $fromName ?: config('mail.from.name'));
        $email->addTo($to);

        if (isset($data['subject'])) {
            $email->setSubject((string) $data['subject']);
        }

        $email->setTemplateId($tpl->provider_template_id);

        $data += [
            'subject'             => $data['subject'] ?? 'FOODLY Notification',
            'brand_logo_url'      => $data['brand_logo_url'] ?? 'https://foodly.space/assets/logo-email.png',
            'brand_primary_color' => $data['brand_primary_color'] ?? '#ff6b00',
            'brand_tagline'       => $data['brand_tagline'] ?? 'Book, dine, enjoy.',
            'year'                => $data['year'] ?? (string) now()->year,
            'support_url'         => $data['support_url'] ?? 'https://foodly.space/contact',
        ];

        $email->addDynamicTemplateData($data);
        $email->addCustomArg('idempotency_key', $idemKey);

        try {
            $resp = $this->client->send($email);
            $headers = $resp->headers();
            $msgId = $headers['X-Message-Id'][0] ?? $headers['x-message-id'][0] ?? (string) Str::uuid();

            if ($resp->statusCode() >= 400) {
                Log::warning('SendGrid error response', [
                    'status' => $resp->statusCode(),
                    'body'   => $resp->body(),
                    'idem'   => $idemKey,
                    'to'     => $to,
                    'tpl'    => $templateKey,
                    'msgId'  => $msgId,
                ]);
            }

            return $msgId;
        } catch (Throwable $e) {
            Log::error('SendGrid send exception', [
                'error' => $e->getMessage(),
                'idem'  => $idemKey,
                'to'    => $to,
                'tpl'   => $templateKey,
            ]);
            throw $e;
        }
    }
}
```

---

## გამოყენების მაგალითი (Processor Job-ში)

```php
use App\Services\Email\EmailDispatcher;
use App\Models\NotificationDelivery;

$messageId = app(EmailDispatcher::class)->sendTemplate(
    $toEmail,
    $templateKey,
    $dynamicData,
    $idempotencyKey
);

NotificationDelivery::create([
    'event_id'        => $event->id,
    'recipient_type'  => $recipientType,
    'recipient_email' => $toEmail,
    'provider'        => 'sendgrid',
    'message_id'      => $messageId,
    'status'          => 'sent',
    'meta'            => null,
]);
```

---

## სწრაფი ტესტი

```php
// routes/web.php
Route::get('/test-dispatcher', function () {
    $dispatcher = app(\App\Services\Email\EmailDispatcher::class);
    $msgId = $dispatcher->sendTemplate(
        'your.email@example.com',
        'reservation.confirmed.client.email',
        [
            'subject'        => 'Test — Reservation Confirmed',
            'brand_logo_url' => 'https://foodly.space/assets/logo-email.png',
            'reservation'    => ['code' => 'ABCD-7890'],
            'restaurant'     => ['name' => 'Exodus'],
            'datetime_local' => '2025-09-01 20:00',
            'guests'         => 4,
            'urls'           => [
                'client_view' => 'https://foodly.pro/r/ABCD-7890',
            ],
            'cta_label'      => 'დეტალების ნახვა',
            'cta_url'        => 'https://foodly.pro/r/ABCD-7890',
        ],
        'test-idem-' . now()->timestamp
    );
    return 'OK: ' . $msgId;
});
```

---

## Error Handling / Retry
- თუ SendGrid დააბრუნებს ≥400 სტატუსს ან ისროლებს გამონაკლისს, Dispatcher ალოგავს და ეს გამონაკლისი დაგვიბრუნდება.  
- **Processor Job**-ში გვექნება `tries/backoff` — Laravel ავტომატურად გადააგორებს რეტრიებს.  
- **Idempotency** გასაღები მოქმდება ვებჰუქზეც (`custom_args.idempotency_key`), რათა დუბლიკატები სწორად ვმართოთ.

---

## საუკეთესო პრაქტიკა
- Dynamic Template Data – მხარდაჭერა მინ. ველებისთვის: `subject`, `brand_*`, `reservation`, `restaurant`, `datetime_local`, `guests`, `urls`, `cta_*`.  
- არ ჩააკომიტო API Key; გამოიყენე `.env`.  
- ვებჰუქის controller-ში (STEP 6) მოძებნი `message_id`-ს **ან** `custom_args.idempotency_key`-ს და განაახლებ სტატუსებს.  
- მომავალში მარტივად დაემატება fallback provider (SES/Mailgun).

---

## შემდეგი ნაბიჯი
STEP 5-ში დავამატებთ **Outbox Listener/Processor Job**-ს — Dispatcher უკვე მზადაა, job მხოლოდ მიიღებს event-ს, ამოიღებს recipients-ს, ააგებს `templateKey`-ს, შეავსებს `$data`-ს და გამოიძახებს `sendTemplate()`-ს.


---

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


---

# FOODLY — Email Notifications
**STEP 6 — Webhook (SendGrid Events → Delivery Statuses)**

---

## მიზანი
SendGrid Event Webhook-იდან მოვკრიბოთ მოვლენები (delivered, bounce, dropped, open, click, spamreport, unsubscribe, deferred …) და შევინახოთ სტატუსები `notification_deliveries` ცხრილში. ასევე, საჭიროების შემთხვევაში, გავაახლებინოთ დაკავშირებული `notification_events` ჩანაწერის მდგომარეობა.

---

## მაღალი დონის ლოგიკა
1) SendGrid აგზავნის **batch JSON array**-ს ერთ POST-ში.  
2) თითო ელემენტიდან ვცდილობთ ამოვიღოთ:
   - **message_id** (`sg_message_id` ან SMTP `smtp-id`),
   - **custom_args.idempotency_key** (რომელსაც ვაყენებთ გაგზავნისას EmailDispatcher-იდან),
   - event type (`event`: delivered|bounce|open|click|dropped|…),
   - reason/details, timestamp.  
3) პოულობთ შესაბამის `notification_deliveries` ჩანაწერს და ვაახლებთ `status` + `meta` ველს (სრულ payload-ს ვამატებთ).

> „open/click“ ტიპები ინფორმაციულია და შეიძლება დატოვოთ როგორც საბოლოო `status='opened'/'clicked'`. კრიტიკულია `delivered`, `bounced`, `dropped`, `failed`.

---

## URL და Route
ვებჰუქის მისამართი:
```
POST /webhooks/sendgrid
```
როუტერი:
```php
// routes/api.php ან routes/web.php (თუ გინდა Session-გარეშე, აირჩიე api.php)
use App\Http\Controllers\Webhooks\SendGridWebhookController;
Route::post('/webhooks/sendgrid', [SendGridWebhookController::class, 'handle']);
```

> რეკო: გამოიყენე `routes/api.php` + `VerifyCsrfToken` გამონაკლისი ამ URL-ზე, რადგან ეს არის მესამე მხარის POST.

---

## Controller (ბაზური იმპლემენტაცია)

**`app/Http/Controllers/Webhooks/SendGridWebhookController.php`**
```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers\Webhooks;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\NotificationDelivery;
use App\Models\NotificationEvent;

class SendGridWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // SendGrid აგზავნის array-ს — დავადასტუროთ ფორმატი
        $events = $request->json()->all();
        if (!is_array($events)) {
            Log::warning('SendGrid webhook: invalid payload (not array)');
            return response()->json(['ok' => true]); // არ დავაბლოკოთ SG retr(y)
        }

        foreach ($events as $ev) {
            try {
                $type = $ev['event'] ?? null;

                // იდენტიფიკაცია: ჯერ სცადე sg_message_id, შემდეგ custom_args.idempotency_key
                $messageId = $ev['sg_message_id'] ?? ($ev['smtp-id'] ?? null);
                $idemKey   = $ev['custom_args']['idempotency_key'] ?? null;

                $delivery = null;
                if ($messageId) {
                    $delivery = NotificationDelivery::query()
                        ->where('message_id', $messageId)
                        ->latest('id')->first();
                }
                if (!$delivery && $idemKey) {
                    $delivery = NotificationDelivery::query()
                        ->where('meta->idempotency_key', $idemKey) // თუ meta-ში ვინახავთ
                        ->latest('id')->first();
                    // ან გამოირიცხოს meta-ს საჭიროება: შეგიძლია დაამატო ცალკე სვეტი idempotency_key
                }

                if (!$delivery && $idemKey) {
                    // ბონუსად ვცადოთ eventId + recipient გაცილებით მკაცრი ძიება, თუ გქონდა შენახული
                    $delivery = NotificationDelivery::query()
                        ->where('recipient_email', $ev['email'] ?? '')
                        ->latest('id')->first();
                }

                if (!$delivery) {
                    Log::info('SendGrid webhook: delivery not found', ['message_id' => $messageId, 'idem' => $idemKey]);
                    continue;
                }

                // სტატუსის რუკა
                $status = $this->mapStatus($type, $ev);

                // meta: შევინახოთ სრული მოვლენა + sg_message_id/idempotency_key სწრაფი ძიებისთვის
                $meta = $delivery->meta ?? [];
                $meta['last_event'] = $ev;
                if ($messageId) $meta['sg_message_id'] = $messageId;
                if ($idemKey)   $meta['idempotency_key'] = $idemKey;

                $delivery->update([
                    'status' => $status,
                    'meta'   => $meta,
                ]);

                // სურვილისამებრ: თუკი შედგა "delivered" — შეგვიძლია event-ს მივანიჭოთ "done"
                if ($status === 'delivered') {
                    optional($delivery->event)->update(['status' => 'done']);
                }

            } catch (\Throwable $e) {
                Log::error('SendGrid webhook event failed', ['error' => $e->getMessage(), 'event' => $ev]);
                // ვუბრუნებთ 200-ს, რომ SG-ს არ გაურთულდეს რეტრაი — ჩვენი retry ლოგიკა შიგნით გვექნება
                continue;
            }
        }

        return response()->json(['ok' => true]);
    }

    private function mapStatus(?string $type, array $ev): string
    {
        return match ($type) {
            'processed'  => 'sent',        // SendGrid queue-ს მიღება
            'delivered'  => 'delivered',
            'bounce'     => 'bounced',
            'dropped'    => 'failed',      // rejected
            'deferred'   => 'queued',      // დაგვიანებული მიწოდება
            'open'       => 'opened',
            'click'      => 'clicked',
            'spamreport' => 'failed',
            'unsubscribe'=> 'failed',
            default      => 'queued',
        };
    }
}
```

> შენიშვნა: ზემოთ `meta->idempotency_key`-ზე ძებნა იმუშავებს თუ `meta` JSON-ში შევინახეთ გაგზავნისას. ალტერნატივა: დაუმატე ცალკე სვეტი `idempotency_key` `notification_deliveries` ცხრილში და ჩაწერე გაგზავნისას.

---

## უსაფრთხოება (Signing, IP Allowlist)
- SendGrid Event Webhook-ს აქვს **Public Key Signature Verification** (v3). შეგიძლია ჩართო და შეამოწმო ხელმოწერა Controller-ში, რომ Payload რეალურად SendGrid-იდან მოდის.  
- ალტერნატივად, შეგიძლია Firewall/IP allowlist (SendGrid-ის IP-ები) და Secret Token ჰედერი.  
- პროდაქშენში URL უნდა იყოს HTTPS.

> MVP ეტაპზე გამარტივებულად დავტოვოთ, მაგრამ Roadmap-ზე ჩაიწერე Signature Verification.

---

## Index-ები და ოპტიმიზაცია
- `notification_deliveries.message_id` — ინდექსი სწრაფი ძიებისთვის.  
- თუ დაამატებ გამიზნულ სვეტს `idempotency_key`-სთვის deliveries-ში — დააინდექსე.  
- Webhook Controller არ უნდა იყოს მძიმე — წონა გადაიტანე Queue Job-ზე, თუ საჭირო იქნება.

---

## ლოკალური ტესტირება
1) Ngrok/Cloudflared ან სერვერზე პირდაპირი URL.  
2) SendGrid Dashboard → Settings → Mail Settings → Event Webhook → ჩაწერე შენი სრული URL ( напр. `https://dev.foodly.space/webhooks/sendgrid`).  
3) Test Payload: SendGrid-ს აქვს test delivery, ან თავად გააკეთე curl:
```bash
curl -X POST http://localhost:8000/webhooks/sendgrid \
  -H "Content-Type: application/json" \
  -d '[{"email":"test@example.com","event":"delivered","sg_message_id":"abc123"}]'
```

თუ შესაბამისი `notification_deliveries` ჩანაწერი მოიძებნა — განახლდება `status='delivered'` და `meta.last_event`.

---

## What’s Next
**STEP 7 — Scheduler (Pre‑Arrival Enqueue)** — შევქმნით სქედულერ ჯობს, რომელიც მოძებნის მოახლოებულ ჯავშნებს (T‑24h/T‑3h) და ჩააგდებს `ReservationPreArrivalDue` მოვლენებს Outbox-ში.


---

# FOODLY — Email Notifications
**STEP 7 — Scheduler (Pre‑Arrival Enqueue)**

---

## მიზანი
გადავხედოთ **რეზერვაციებს, რომლებიც ახლოვდება** (მაგ. T‑24h ან T‑3h სტუმრობის დრომდე) და გავაგზავნოთ შეხსენების წერილები.  
ამისათვის:
1. Scheduler Job იძებნის შესაბამის რეზერვაციებს.  
2. თითო რეზერვაციისთვის EventDispatcher ჩააგდებს **ReservationPreArrivalDue** მოვლენა Outbox-ში.  
3. Processor Job (STEP 5) უკვე ავტომატურად გააგზავნის Email‑ს.

---

## Kernel-ში Scheduler
**`app/Console/Kernel.php`**

```php
protected function schedule(Schedule $schedule): void
{
    // ყოველ საათში ერთხელ გადავამოწმოთ მოახლოებული რეზერვაციები
    $schedule->job(new \App\Jobs\EnqueuePreArrivalForWindow)->hourly();
}
```

---

## Job: EnqueuePreArrivalForWindow

**`app/Jobs/EnqueuePreArrivalForWindow.php`**

```php
<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Domain\Reservations\Events\ReservationPreArrivalDue;
use Illuminate\Support\Facades\Event;

class EnqueuePreArrivalForWindow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        // 1) მოძებნე რეზერვაციები T‑24h ან T‑3h შიგნით
        $now   = now();
        $win24 = [$now->copy()->addHours(23, 30), $now->copy()->addHours(24, 30)];
        $win3  = [$now->copy()->addHours(2, 30),  $now->copy()->addHours(3, 30)];

        $reservations = \App\Models\Reservation::query()
            ->whereBetween('datetime_local', $win24)
            ->orWhereBetween('datetime_local', $win3)
            ->get();

        foreach ($reservations as $r) {
            Log::info('PreArrival enqueue', ['reservation_id' => $r->id]);

            // Event (STEP 5-ის Listener ჩაიწერს Outbox-ში)
            Event::dispatch(new ReservationPreArrivalDue($r->id));
        }
    }
}
```

> შენიშვნა: `Reservation` მოდელი უნდა არსებობდეს და ჰქონდეს `datetime_local` ველი. საჭიროა შენი რეზერვაციის ლოგიკიდან გამართვა.

---

## Cron სერვერზე
სერვერზე დაამატე CRON:
```
* * * * * cd /var/www/foodly && php artisan schedule:run >> /dev/null 2>&1
```
ეს ყოველ წუთს ამოწმებს Kernel-ს და ჩვენს `hourly()` scheduler-ს გაუშვებს.

---

## ტესტირება ლოკალურად
1. `php artisan tinker`-ში შექმენი Reservation, რომელსაც აქვს `datetime_local = now()->addHours(24)`.
2. გაუშვი:
```bash
php artisan schedule:run
```
3. შედეგი: უნდა შეიქმნას ერთი Outbox Event (`reservation.prearrival`) შესაბამის Reservation-ზე.

შემდეგ უკვე Processor Job (STEP 5) გამოიძახებს EmailDispatcher-ს და გაგზავნის Pre‑Arrival Reminder-ს.

---

## საუკეთესო პრაქტიკა
- **Window Buffers** — T‑24h და T‑3h არ ითვლება ზუსტი წუთით, არამედ ±30 წუთის ფანჯარით, რომ შემთხვევით არ გამოგვრჩეს.  
- **TimeZone Awareness** — დარწმუნდი, რომ Reservation-ის დროები ინახება UTC‑ში ან აპის Timezone‑ში და შედარება სწორად კეთდება.  
- **Idempotency** — Listener STEP 5-ში Outbox-ში ჩაწერისას მაინც უზრუნველყოფს უნიკალურობას, რომ ერთსა და იმავე Reservation-ზე ორჯერ არ გავუგზავნოთ.  
- **Extensibility** — შემდგომში შეიძლება დაემატოს SMS არხიც ან Push Notification.

---

## საბოლოო ჯაჭვი (STEP 1 → 7)
1. STEP 1 — მონაცემთა სტრუქტურა (Events, Deliveries, Templates, Rules)  
2. STEP 2 — Template Mapping (Seeder)  
3. STEP 3 — Config (.env, mail.php, SendGrid API Key)  
4. STEP 4 — EmailDispatcher Service  
5. STEP 5 — Outbox Listener + Processor Job  
6. STEP 6 — Webhook Controller (SendGrid Events)  
7. STEP 7 — Scheduler (Pre‑Arrival Enqueue)  

ამ ეტაპზე სისტემა უკვე ბოლომდე მუშაობს end‑to‑end!

---
