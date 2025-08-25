# FOODLY — Email Notifications (SendGrid) — Copilot Prompt (Mini Version)

You are **Copilot**, acting as a Senior Laravel Developer.  
We want an **event-driven Email Notification system** in Laravel 11/12 using **SendGrid (Free 100/day)** with **database queue**.

Follow the steps below, generate code for each step in Laravel style.

---

## STEP 1 — Migrations & Models
- Create migrations for:
  - `notification_events`
  - `notification_deliveries`
  - `notification_templates`
  - `notification_rules`
- Fields:
  - `notification_events`: event_key, reservation_id, payload(json), idempotency_key(unique), status(enum), retries, last_error, timestamps
  - `notification_deliveries`: event_id(fk), recipient_type(enum), recipient_email, provider, message_id, status(enum), meta(json), timestamps
  - `notification_templates`: key(unique), provider_template_id, lang, status(enum), timestamps
  - `notification_rules`: scope(enum), restaurant_id?, matrix(json), timestamps
- Create Eloquent models for each.

---

## STEP 2 — Seeder (Template Mapping)
- Seeder: `NotificationTemplatesSeeder`
- Insert placeholder keys:
  - reservation.requested.manager.email
  - reservation.requested.admin.email
  - reservation.requested.client.email
  - reservation.confirmed.client.email
  - reservation.declined.client.email
  - reservation.prearrival.client.email
  - reservation.payment_succeeded.client.email
  - reservation.payment_failed.client.email

---

## STEP 3 — Config
- Update `.env`:
  ```
  MAIL_FROM_ADDRESS=no-reply@foodly.space
  MAIL_FROM_NAME="FOODLY"
  SENDGRID_API_KEY=YOUR_KEY
  QUEUE_CONNECTION=database
  APP_TIMEZONE=Asia/Tbilisi
  ```
- Update `config/mail.php` to add `sendgrid` mailer (API transport).

---

## STEP 4 — EmailDispatcher Service
- Create `App/Services/Email/EmailDispatcher.php`
- Method: `sendTemplate(string $to, string $templateKey, array $data, string $idemKey): string`
- Load template_id from `notification_templates`
- Build SendGrid API payload
- Add `custom_args.idempotency_key`
- Return `message_id` (or uuid fallback)

---

## STEP 5 — Outbox & Job
- Domain Events: ReservationRequested, ReservationConfirmed, ReservationDeclined, ReservationPreArrivalDue, ReservationPaymentSucceeded, ReservationPaymentFailed
- Listener: insert into `notification_events` with payload + idempotency_key
- Job `ProcessNotificationEvent`:
  - Resolve recipients via `notification_rules` + `restaurant_contacts`
  - Build template key
  - Call EmailDispatcher
  - Write `notification_deliveries`
  - Update event.status

---

## STEP 6 — Webhook
- Route: POST /webhooks/sendgrid
- Controller: `SendGridWebhookController`
- Parse SendGrid events (delivered, bounce, open, click, failed)
- Find delivery by message_id or custom_args.idempotency_key
- Update status + meta

---

## STEP 7 — Scheduler
- Job: `EnqueuePreArrivalForWindow`
- Kernel: run hourly
- Find reservations T-24h/T-3h and enqueue PreArrival events

---

## Acceptance Criteria
- `php artisan migrate --seed` works
- Outbox → Job → Email → Delivery log functional
- Webhook updates delivery statuses
- Scheduler enqueues PreArrival
- Queue runs with `php artisan queue:work database`

---

**Start with STEP 1 and continue sequentially.**
