# FOODLY — Email Notifications
**STEP 3 — Config (Environment, Mailer, Queue, SendGrid)**

---

## მიზანი
ამ ეტაპზე ვაკონფიგურირებთ გარემოსა და ლარავინს, რომ Email Notification სისტემა იმუშაოს **SendGrid-ის Free გეგმაზე (100 email/დღე)** და **database queue**-ზე.

ამ დოკშია:
- `.env` პარამეტრები,
- `config/mail.php` ცვლილებები (SendGrid mailer),
- SendGrid-ის მხარეს გასაკეთებელი მინიმალური ქმედებები,
- ლოკალურად ტესტირების ინსტრუქცია.

> შენიშვნა: Redis ჯერ არ გვჭირდება — ვიყენებთ `QUEUE_CONNECTION=database`-ს.

---

## 1) .env (საბაზისო კონფიგი)
ახლა საჭიროა შემდეგი გასაღებები პროექტის `.env` ფაილში:

```env
APP_NAME=FOODLY
APP_ENV=local
APP_KEY=base64:GENERATE_ME
APP_DEBUG=true
APP_URL=http://localhost

APP_TIMEZONE=Asia/Tbilisi

# Queue: database (ამ ეტაპზე)
QUEUE_CONNECTION=database

# Mail (From)
MAIL_FROM_ADDRESS=no-reply@foodly.space
MAIL_FROM_NAME="FOODLY"

# SendGrid API Key (Free 100/day)
SENDGRID_API_KEY=YOUR_SENDGRID_API_KEY_HERE
```

**რა უნდა იცოდე:**  
- `MAIL_FROM_ADDRESS` და `MAIL_FROM_NAME` — სწორედ ეს გამოჩნდება მიმღების საფოსტო ყუთში.  
- `SENDGRID_API_KEY` — მიიღებ SendGrid Dashboard-ში, საჭიროა „Mail Send“ უფლებები მაინც.  
- `APP_TIMEZONE=Asia/Tbilisi` — თარიღების/დროის გასწორებისთვის.

---

## 2) Composer პაკეტი (API transport)
თუ ჯერ არ დაგიყენებია, დაამატე ოფიციალური პაკეტი:
```bash
composer require sendgrid/sendgrid:^8
```

ეს მოგვცემს API-ზე გაგზავნის შესაძლებლობას (SMTP-ს ნაცვლად). **API transport** უფრო სტაბილურია დინამიური შაბლონებისთვის.

---

## 3) `config/mail.php` — SendGrid mailer
ლარავენში შეგიძლია გამოიყენო როგორც SMTP, ისე API. ჩვენ ვირჩევთ **API გზას** (პაკეტი ზემოთ უკვე დავამატეთ).

**ვერსია A — API Client (რეკომენდებული)**
- ამ ვერსიაში შენ თვითონ უკავშირდები SendGrid API-ს `EmailDispatcher` სერვისიდან და `config/mail.php`-ში default mailer დიდად არ გჭირდება.
- საკმარისია `mail.from` იყოს სწორად დაყენებული:

```php
// config/mail.php
'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'no-reply@foodly.space'),
    'name' => env('MAIL_FROM_NAME', 'FOODLY'),
],
```

**ვერსია B — SMTP mailer (ალტერნატივა)**
თუ გინდა SMTP-ის გავლით, დაამატე sendgrid-ს SMTP mailer:

```php
// config/mail.php
'mailers' => [
    'smtp' => [
        'transport' => 'smtp',
        'host' => 'smtp.sendgrid.net',
        'port' => 587,
        'encryption' => 'tls',
        'username' => 'apikey', // literally the string "apikey"
        'password' => env('SENDGRID_API_KEY'),
        'timeout' => null,
        'auth_mode' => null,
    ],
],

'default' => env('MAIL_MAILER', 'smtp'),
'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'no-reply@foodly.space'),
    'name' => env('MAIL_FROM_NAME', 'FOODLY'),
],
```

და `.env`-ში:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=apikey
MAIL_PASSWORD=${SENDGRID_API_KEY}
```

> შენიშვნა: Dynamic Templates SMTP-ზეც მუშაობს, მაგრამ API გზით უფრო მოქნილია custom args (`idempotency_key`) და პასუხების დამუშავება.

---

## 4) SendGrid — Dashboard ქმედებები
1. **API Key** — შექმენი და ჩასვი `.env`-ში.  
2. **Domain Authentication** — დაამატე `foodly.space` ან ქვედომენი (მაგ. `mail.foodly.space`) SPF/DKIM ჩანაწერებით. ეს აუმჯობესებს დელივერაბელობას.  
3. **Sender Identity** — „no-reply@foodly.space“.  
4. **Dynamic Templates** — შექმენი მინ. 6 ცალი (Requested, Confirmed, Declined, Pre-Arrival, Payment Succeeded, Payment Failed) და ჩაინიშნე `template_id`-ები (`d-xxxxx`).  
5. **Event Webhook** — მოგვიანებით ჩავთიშავთ/ჩავრთავთ; ახლა მხოლოდ URL დაიმახსოვრე (`/webhooks/sendgrid`).

---

## 5) Template Mapping — Seed
STEP 2-ში მოვამზადეთ Seeder, სადაც შევავსეთ `notification_templates` `key → provider_template_id` map-ით.  
გახსოვდეს, რომ production-ზე **რეალური `d-xxxx` ID-ები** უნდა ჩაწერო და გაუშვა:

```bash
php artisan migrate --force
php artisan db:seed --class=NotificationTemplatesSeeder
```

---

## 6) Queue (database) — რას ნიშნავს
ამ ეტაპზე queue job-ები ჩაიწერება **DB ცხრილში** (`jobs`).  
დასაწყებად:
```bash
php artisan queue:table
php artisan queue:failed-table
php artisan migrate
php artisan queue:work database --queue=default --tries=5 --backoff=60
```

- `failed_jobs` დაგეხმარება ჩავარდნილი ამოცანების ნახვაში/გადაგორებაში.  
- შემდგომ ეტაპზე მარტივად გადავრთავთ Redis-ზე (`QUEUE_CONNECTION=redis`).

---

## 7) ლოკალური ტესტი
შეამოწმე, რომ ძირითადი კონფიგი მუშაობს:

```php
// routes/web.php (დროებითი ტესტი)
Route::get('/test-mail', function () {
    $dispatcher = app(\App\Services\Email\EmailDispatcher::class);
    $messageId = $dispatcher->sendTemplate(
        'your.email@example.com',
        'reservation.confirmed.client.email',
        [
            'subject' => 'Test — Reservation Confirmed',
            'brand_logo_url' => 'https://foodly.space/assets/logo-email.png',
            'brand_tagline' => 'Book, dine, enjoy.',
            'brand_primary_color' => '#ff6b00',
            'year' => '2025',
            'support_url' => 'https://foodly.space/contact',
            'footer_note' => 'ეს არის ტესტური ტრანზაქციული წერილი.',
            'reservation' => ['code' => 'ABCD-7890'],
            'restaurant'  => ['name' => 'Exodus'],
            'datetime_local' => '2025-09-01 20:00',
            'guests' => 4,
            'urls' => [
                'client_view' => 'https://foodly.pro/r/ABCD-7890',
                'receipt_url' => 'https://foodly.pro/invoices/98765'
            ],
            'cta_label' => 'დეტალების ნახვა',
            'cta_url'   => 'https://foodly.pro/r/ABCD-7890'
        ],
        'test-idem-' . now()->timestamp
    );
    return 'OK: ' . $messageId;
});
```

გაუშვი სერვერი:
```bash
php artisan serve
```
და მერე: `http://127.0.0.1:8000/test-mail`

თუ წერილი მივიდა — კონფიგი წესრიგშია.

---

## 8) უსაფრთხოება და საუკეთესო პრაქტიკა
- **არასოდეს** არ ჩააკომიტო `SENDGRID_API_KEY` Git-ში. გქონდეს `.env`-ში/CI სეკრეტებში.  
- **SPF/DKIM/DMARC** — Domain Authentication აუცილებლად დაასრულე, რომ წერილები სპამში არ წავიდეს.  
- **From Address** — ყოველთვის შენი დომენიდან (არა @gmail.com).  
- **Rate Limiting** — დიდი მოცულობის დროს, გამოიყენე queue backoff და per-recipient შეზღუდვები.  
- **PII მინიმიზაცია** — ელფოსტაში მხოლოდ საჭირო ინფორმაცია. ლინკები — Signed URLs (ვადა 24–48 სთ).

---

## 9) რა არის შემდეგი
STEP 4-ში დავამატებთ **EmailDispatcher** სერვისს (SendGrid API-ის კლიენტი) და დავუკავშირებთ Outbox-ს/Job-ს.  
STEP 5–7-ში — Listener-ები, Processor Job, Webhook Controller და Scheduler (Pre‑Arrival).
