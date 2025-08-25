# FOODLY — Notifications: **Email Module** (SendGrid + Laravel)

ეს ფაილი არის **Email მოდულის** სრული, დამოუკიდებელი დოკუმენტი FOODLY-სთვის. 
შეგიძლია ახალ ჩათში ან ახალ რეპოში გამოიყენო, SMS ნაწილი ცალკე ფაილში იქნება.

---

## 0) მიმოხილვა
- Provider: **SendGrid (Free 100 email/day)**  
- Laravel: 11/12  
- Queue: **database** (ამ ეტაპზე), შემდეგ შესაძლებელია Redis  
- Templates: **Dynamic Templates** (Handlebars)  
- არქიტექტურა: **Event → Outbox → Processor Job → EmailDispatcher → Webhook → Logs**

---

## 1) მონაცემთა სტრუქტურა (Migrations & Models)

### ცხრილები
- `notification_events` — ინახავს დომენურ მოვლენებს (requested/confirmed/…).
- `notification_deliveries` — ინახავს თითო გაგზავნის სტატუსს (recipient, message_id, status).
- `notification_templates` — Template Mapping: `key → provider_template_id (d-xxxx)`.
- `notification_rules` — წესების მატრიცა (ვის რა მოვლენა/არხით გაეგზავნება).

### მოდელები
- `NotificationEvent`, `NotificationDelivery`, `NotificationTemplate`, `NotificationRule`.

### Migration Fields (რისკენ უნდა მიდიოდეს)
```php
// notification_events
event_key, reservation_id, payload(json), idempotency_key(unique), status(pending|processing|done|failed), retries, last_error, timestamps

// notification_deliveries
event_id(fk), recipient_type(manager|admin|client), recipient_email, provider(sendgrid), message_id, status(queued|sent|delivered|bounced|failed|opened|clicked), meta(json), timestamps

// notification_templates
key(unique), provider_template_id, lang, status(active|inactive), timestamps

// notification_rules
scope(global|restaurant), restaurant_id?, matrix(json), timestamps
```

---

## 2) Template Mapping (Seeder)
შეავსე `notification_templates` ასეთი გასაღებებით (placeholder IDs):

- `reservation.requested.manager.email`  
- `reservation.requested.admin.email`  
- `reservation.requested.client.email`  
- `reservation.confirmed.client.email`  
- `reservation.declined.client.email`  
- `reservation.prearrival.client.email`  
- `reservation.payment_succeeded.client.email`  
- `reservation.payment_failed.client.email`  

Seeder insert ნიმუში:
```php
DB::table('notification_templates')->insert([
  ['key'=>'reservation.requested.manager.email',     'provider_template_id'=>'d-XXXXXX1','lang'=>'ka','status'=>'active'],
  ['key'=>'reservation.requested.admin.email',       'provider_template_id'=>'d-XXXXXX2','lang'=>'ka','status'=>'active'],
  ['key'=>'reservation.requested.client.email',      'provider_template_id'=>'d-XXXXXX3','lang'=>'ka','status'=>'active'],
  ['key'=>'reservation.confirmed.client.email',      'provider_template_id'=>'d-XXXXXX4','lang'=>'ka','status'=>'active'],
  ['key'=>'reservation.declined.client.email',       'provider_template_id'=>'d-XXXXXX5','lang'=>'ka','status'=>'active'],
  ['key'=>'reservation.prearrival.client.email',     'provider_template_id'=>'d-XXXXXX6','lang'=>'ka','status'=>'active'],
  ['key'=>'reservation.payment_succeeded.client.email','provider_template_id'=>'d-XXXXXX7','lang'=>'ka','status'=>'active'],
  ['key'=>'reservation.payment_failed.client.email', 'provider_template_id'=>'d-XXXXXX8','lang'=>'ka','status'=>'active'],
]);
```

---

## 3) Config (.env, mail.php, SendGrid)

`.env` (საბაზისო):
```env
APP_TIMEZONE=Asia/Tbilisi
QUEUE_CONNECTION=database

MAIL_FROM_ADDRESS=no-reply@foodly.space
MAIL_FROM_NAME="FOODLY"
SENDGRID_API_KEY=YOUR_SENDGRID_API_KEY_HERE
```

Composer:
```bash
composer require sendgrid/sendgrid:^8
```

`config/mail.php` (API მიდგომა – ვაგზავნით კოდიდან):
```php
'from' => [
  'address' => env('MAIL_FROM_ADDRESS', 'no-reply@foodly.space'),
  'name'    => env('MAIL_FROM_NAME', 'FOODLY'),
],
```

> სურვილისამებრ SMTP კონფიგიც შეგიძლია გამოიყენო (host: smtp.sendgrid.net), მაგრამ API transport უფრო მოქნილია Dynamic Templates + custom_args-ისთვის.

SendGrid Dashboard-ზე:
1) API Key შექმნა; 2) Domain Authentication (SPF/DKIM/DMARC); 3) Sender Identity;  
4) Dynamic Templates (6 ცალი) → ჩაინიშნე `template_id`-ები;  
5) Event Webhook URL (ვიწერთ STEP 6-ში).

---

## 4) EmailDispatcher Service (SendGrid API)

`app/Services/Email/EmailDispatcher.php` (სკელი):
```php
class EmailDispatcher {
  public function __construct(private ?\SendGrid $client = null) {
    $this->client = $client ?: new \SendGrid(env('SENDGRID_API_KEY'));
  }

  public function sendTemplate(string $to, string $templateKey, array $data, string $idemKey, ?string $fromEmail=null, ?string $fromName=null): string {
    $tpl = \App\Models\NotificationTemplate::where('key',$templateKey)->where('status','active')->firstOrFail();

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom($fromEmail ?: config('mail.from.address'), $fromName ?: config('mail.from.name'));
    $email->addTo($to);
    if (isset($data['subject'])) $email->setSubject((string)$data['subject']);
    $email->setTemplateId($tpl->provider_template_id);

    $data += [
      'subject' => $data['subject'] ?? 'FOODLY Notification',
      'brand_logo_url' => $data['brand_logo_url'] ?? 'https://foodly.space/assets/logo-email.png',
      'brand_primary_color' => $data['brand_primary_color'] ?? '#ff6b00',
      'brand_tagline' => $data['brand_tagline'] ?? 'Book, dine, enjoy.',
      'year' => (string) now()->year,
      'support_url' => $data['support_url'] ?? 'https://foodly.space/contact',
    ];

    $email->addDynamicTemplateData($data);
    $email->addCustomArg('idempotency_key', $idemKey);

    $resp = $this->client->send($email);
    $headers = $resp->headers();
    return $headers['X-Message-Id'][0] ?? $headers['x-message-id'][0] ?? (string) \Illuminate\Support\Str::uuid();
  }
}
```

---

## 5) Outbox Listener & Processor Job

Domain Events (სტუბები):  
`ReservationRequested`, `ReservationConfirmed`, `ReservationDeclined`, `ReservationPreArrivalDue`, `ReservationPaymentSucceeded`, `ReservationPaymentFailed`.

Listener `DispatchReservationNotifications`:
- გამართული მოვლენიდან აგებს `payload`-ს
- Outbox-ში (`notification_events`) წერს ერთ ჩანაწერს `status=pending`

Processor Job `ProcessNotificationEvent`:
- Resolve recipients (manager/admin/client) `notification_rules` + `restaurant_contacts` მიხედვით
- აარჩევს `templateKey` per event+recipient
- გამოიძახებს `EmailDispatcher->sendTemplate()`
- ჩაწერს `notification_deliveries`-ში (`message_id`, `status=sent`)
- Event-ს დაასრულებს `done` ან მონიშნავს `failed` (retry/backoff-config-ით)

Job retries/backoff:
```php
public $tries = 5;
public function backoff(): array { return [60, 300, 900, 3600, 10800]; }
```

Queue run (database):
```bash
php artisan queue:table
php artisan queue:failed-table
php artisan migrate
php artisan queue:work database --queue=default --tries=5 --backoff=60
```

---

## 6) Webhook (SendGrid Events → Delivery Statuses)

Route:
```php
Route::post('/webhooks/sendgrid', [SendGridWebhookController::class, 'handle']);
```

Controller ლოგიკა:
- მიიღე batch JSON array
- ამოიღე `sg_message_id` ან `custom_args.idempotency_key`
- მონახე `notification_deliveries` ჩანაწერი
- განაახლე `status` რუკით: processed→sent, delivered→delivered, bounce→bounced, dropped→failed, deferred→queued, open→opened, click→clicked
- შეინახე სრული payload `meta`-ში

Security: HTTPS, სურვილისამებრ **signature verification** ან IP allowlist.

---

## 7) Scheduler (Pre‑Arrival Enqueue)

`app/Console/Kernel.php`:
```php
$schedule->job(new \App\Jobs\EnqueuePreArrivalForWindow)->hourly();
```
Job:
- მოძებნის რეზერვაციებს T‑24h/T‑3h ფანჯარაში (±30 წუთი)
- ჩააგდებს `ReservationPreArrivalDue` მოვლენას (Listener → Outbox → Processor → Email)

Cron (server):
```
* * * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1
```

---

## Visual Templates (მზად Draft-ები)
SendGrid Dynamic Templates-ისთვის უკვე გაქვს HTML draft-ები:  
- `_base.html`, `reservation_requested.html`, `reservation_confirmed.html`, `reservation_declined.html`, `pre_arrival.html`, `payment_succeeded.html`, `payment_failed.html`  
(Placeholders: `{{reservation.code}}`, `{{restaurant.name}}`, `{{datetime_local}}` და ა.შ.)

---

## Quick Test
დროებითი Route:
```php
Route::get('/test-mail', function () {
  $dispatcher = app(\App\Services\Email\EmailDispatcher::class);
  return $dispatcher->sendTemplate(
    'your.email@example.com',
    'reservation.confirmed.client.email',
    [
      'subject'=>'Test — Reservation Confirmed',
      'brand_logo_url'=>'https://foodly.space/assets/logo-email.png',
      'reservation'=>['code'=>'ABCD-7890'],
      'restaurant'=>['name'=>'Exodus'],
      'datetime_local'=>'2025-09-01 20:00',
      'guests'=>4,
      'urls'=>['client_view'=>'https://foodly.pro/r/ABCD-7890'],
      'cta_label'=>'დეტალების ნახვა',
      'cta_url'=>'https://foodly.pro/r/ABCD-7890',
    ],
    'test-idem-'.now()->timestamp
  );
});
```

---

## Acceptance Checklist
- [ ] `php artisan migrate --seed` გაიარა
- [ ] SendGrid Templates შექმნილია და IDs ჩაწერილია Seeder-ში
- [ ] Queue (`jobs`, `failed_jobs`) აქტიური და worker მუშაობს
- [ ] Webhook იღებს events და აახლებს `notification_deliveries`
- [ ] Scheduler enqueue-ს Pre‑Arrival მოვლენებს
- [ ] Email-ის დელივერი OK (SPF/DKIM/DMARC გამართული)

---

## Roadmap (შემდეგი ეტაპები)
- Redis Queue + Horizon (მაღალი დატვირთვისთვის)  
- Fallback Provider (SES)  
- Admin Panel: Delivery Log viewer + resend  
- Template Versioning per Restaurant/Language  
- Security: Webhook Signature Verification

