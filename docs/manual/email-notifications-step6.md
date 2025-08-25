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
