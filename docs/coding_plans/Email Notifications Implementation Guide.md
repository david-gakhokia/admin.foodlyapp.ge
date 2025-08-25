# FOODLY — Email Notifications Implementation Guide
**GitHub Copilot სახელმძღვანელო ნაბიჯ-ნაბიჯ განხორციელებისთვის**

---

## 🎯 მიზანი
ეს დოკუმენტი არის GitHub Copilot-ისთვის სრული სახელმძღვანელო FOODLY-ის Email Notification სისტემის განსახორციელებლად. ყველა ნაბიჯი, ფაილი და კოდი დეტალურადაა აღწერილი.

---

## 📋 შესასრულებელი ნაბიჯები

### PHASE 1: Foundation Setup
1. **STEP 1-2**: Migrations & Models Creation
2. **STEP 3**: Environment & SendGrid Configuration  
3. **STEP 4**: EmailDispatcher Service
4. **Testing Setup**: Pest Framework Configuration

### PHASE 2: Core Logic
5. **STEP 5**: Outbox Pattern & Processor Job
6. **Advanced Testing**: Email Flow Tests

### PHASE 3: Monitoring & Automation
7. **STEP 6**: SendGrid Webhook Handler
8. **STEP 7**: Scheduler for Pre-Arrival Notifications
9. **Admin Dashboard**: Basic monitoring interface

---

## 🔧 შესასრულებელი ფაილები პრიორიტეტით

### 1. Database Layer (STEP 1-2)
```
database/migrations/
├── create_notification_events_table.php
├── create_notification_deliveries_table.php
├── create_notification_templates_table.php
└── create_notification_rules_table.php

app/Models/
├── NotificationEvent.php
├── NotificationDelivery.php
├── NotificationTemplate.php
└── NotificationRule.php
```

### 2. Configuration (STEP 3)
```
.env (განახლება)
config/mail.php (SendGrid mailer)
config/notifications.php (ახალი)
```

### 3. Services (STEP 4)
```
app/Services/Email/
├── EmailDispatcher.php
├── RecipientResolver.php
└── TemplateDataBuilder.php
```

### 4. Events & Jobs (STEP 5)
```
app/Domain/Reservations/Events/
├── ReservationRequested.php
├── ReservationConfirmed.php
├── ReservationDeclined.php
└── ReservationPreArrivalDue.php

app/Listeners/
└── NotificationEventListener.php

app/Jobs/
├── ProcessNotificationEvent.php
└── EnqueuePreArrivalForWindow.php
```

### 5. Webhooks & Scheduler (STEP 6-7)
```
app/Http/Controllers/Webhooks/
└── SendGridWebhookController.php

routes/api.php (webhook routes)
app/Console/Kernel.php (scheduler)
```

### 6. Testing (Throughout)
```
tests/Feature/
├── EmailNotificationTest.php
├── SchedulerTest.php
└── WebhookTest.php

tests/Unit/
├── EmailDispatcherTest.php
└── RecipientResolverTest.php
```

### 7. Admin Interface
```
app/Http/Controllers/Admin/
└── NotificationController.php

resources/views/admin/notifications/
├── index.blade.php
└── show.blade.php
```

---

## 🎛️ ტექნიკური მოთხოვნები

### Framework & Packages
- **Laravel 10+** (მიმდინარე პროექტი)
- **Pest Testing Framework** (PHPUnit-ის ნაცვლად)
- **SendGrid PHP SDK** (`sendgrid/sendgrid`)
- **Queue: Database** (Redis-ის გარეშე ამ ეტაპზე)

### Environment Variables (.env)
```env
# SendGrid
SENDGRID_API_KEY=your_api_key_here
SENDGRID_TEMPLATE_RESERVATION_REQUESTED_MANAGER=d-xxxxx
SENDGRID_TEMPLATE_RESERVATION_CONFIRMED_CLIENT=d-xxxxx
SENDGRID_TEMPLATE_RESERVATION_DECLINED_CLIENT=d-xxxxx
SENDGRID_TEMPLATE_RESERVATION_PREARRIVAL_CLIENT=d-xxxxx

# Queue
QUEUE_CONNECTION=database

# Mail
MAIL_FROM_ADDRESS=no-reply@foodly.space
MAIL_FROM_NAME="FOODLY"

# App
APP_TIMEZONE=Asia/Tbilisi
```

---

## 📊 მონაცემთა ნაკადი (Data Flow)

### 1. Event Trigger
```
User Action → Domain Event → EventListener → Outbox (notification_events)
```

### 2. Processing
```
Queue Job → RecipientResolver → TemplateDataBuilder → EmailDispatcher → SendGrid API
```

### 3. Tracking
```
SendGrid Response → notification_deliveries → Webhook Updates → Status Tracking
```

### 4. Scheduling
```
Cron → Scheduler → PreArrival Job → Domain Event → Processing Flow
```

---

## 🧪 ტესტირების სტრატეგია

### Unit Tests
- **EmailDispatcher**: SendGrid API ინტეგრაცია
- **RecipientResolver**: მიმღებების განსაზღვრა
- **TemplateDataBuilder**: Template data generation

### Feature Tests  
- **Email Flow**: End-to-end email sending
- **Webhook Processing**: SendGrid webhook handling
- **Scheduler**: Pre-arrival notification timing

### Integration Tests
- **Queue Processing**: Job execution
- **Database**: Outbox pattern integrity
- **Event Dispatching**: Domain events

---

## 🚀 განხორციელების რიგი

### Day 1: Foundation
1. Run migrations (STEP 1-2)
2. Create models with relationships
3. Configure SendGrid (.env, config)
4. Setup Pest testing framework

### Day 2: Core Services
1. Build EmailDispatcher service
2. Create RecipientResolver
3. Implement TemplateDataBuilder
4. Write unit tests for services

### Day 3: Event Processing
1. Create domain events
2. Build notification listener
3. Implement processor job
4. Test email flow end-to-end

### Day 4: Monitoring
1. Setup SendGrid webhook
2. Create admin dashboard basics
3. Implement scheduler for pre-arrival
4. Add comprehensive logging

### Day 5: Production Ready
1. Error handling improvements
2. Rate limiting implementation
3. Security hardening
4. Performance optimization

---

## 📝 მიმდინარე სტატუსი

### ✅ დასრულებული
- [x] Database migrations
- [x] Models creation
- [x] SendGrid configuration
- [x] EmailDispatcher service
- [x] Pest framework setup

### ✅ მიმდინარე
- [x] Event system implementation
- [x] Queue job processing
- [x] Testing framework

### ✅ მომავალი
- [x] Webhook handling
- [x] Scheduler implementation
- [x] Admin dashboard
- [x] Template seeding
- [ ] Production deployment

---

## 🔍 ხშირი შეცდომები და მათი თავიდან აცილება

### 1. Timezone Issues
```php
// ❌ არასწორი
$reservation->datetime_local = now();

// ✅ სწორი
$reservation->datetime_local = now()->setTimezone(config('app.timezone'));
```

### 2. Duplicate Emails
```php
// ✅ Idempotency key-ის გამოყენება
$idempotencyKey = "reservation.{$reservationId}.{$eventType}";
```

### 3. SendGrid Rate Limiting
```php
// ✅ Rate limiting implementation
if ($this->exceedsRateLimit()) {
    throw new RateLimitExceededException();
}
```

---

## 📞 დახმარების რესურსები

### SendGrid Documentation
- [Dynamic Templates](https://docs.sendgrid.com/ui/sending-email/how-to-send-an-email-with-dynamic-transactional-templates)
- [Event Webhook](https://docs.sendgrid.com/for-developers/tracking-events/event)

### Laravel Resources
- [Queue Documentation](https://laravel.com/docs/queues)
- [Event System](https://laravel.com/docs/events)
- [Task Scheduling](https://laravel.com/docs/scheduling)

### Testing with Pest
- [Pest Documentation](https://pestphp.com/docs)
- [Laravel Plugin](https://pestphp.com/docs/plugins/laravel)

---

## 🎯 წარმატების კრიტერიუმები

### Technical Metrics
- [ ] 100% email delivery rate (SendGrid)
- [ ] <5 second average processing time
- [ ] Zero duplicate notifications
- [ ] 99.9% webhook processing success

### Business Metrics  
- [ ] Manager notifications: <1 minute delivery
- [ ] Client confirmations: <30 seconds
- [ ] Pre-arrival reminders: Precise timing
- [ ] Admin monitoring: Real-time visibility

---

**შენიშვნა**: ეს დოკუმენტი უნდა განახლდეს ყოველი ნაბიჯის შემდეგ, რათა ასახავდეს რეალურ მდგომარეობას და მომავალ