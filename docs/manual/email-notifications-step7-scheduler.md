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
