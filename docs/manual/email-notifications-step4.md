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
