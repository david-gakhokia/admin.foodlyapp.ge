# 🧪 Email Notification Testing Guide

## მზადაა სატესტო კომანდები:

### 1. კონფიგურაციის შემოწმება
```bash
php artisan email:test --step=config
```
✅ SendGrid API Key: SG.yz1qleQ...
✅ Default Provider: sendgrid
✅ Queue Connection: database
✅ Templates in DB: 7
✅ Rules in DB: 7

### 2. EmailDispatcher-ის შემოწმება
```bash
php artisan email:test --step=dispatcher
```
✅ EmailDispatcher initialized successfully
✅ Rate limit check: OK

### 3. ტემპლატების ნახვა
```bash
php artisan email:templates
```
ნაჩვენებია 7 ტემპლატი:
- reservation.requested (client/manager)
- reservation.confirmed (client/manager) 
- reservation.declined (client/manager)
- reservation.prearrival (client)

### 4. ტესტური ელ-წერილის გაგზავნა (DRY RUN)
```bash
php artisan email:send-test your-email@gmail.com --template=2 --dry-run
```

### 5. რეალური ელ-წერილის გაგზავნა
```bash
php artisan email:send-test your-email@gmail.com --template=2
```

## ⚠️ შენიშვნა:
მუშაობისთვის თქვენ უნდა:

1. **SendGrid-ში შექმნათ Dynamic Templates**:
   - შედით https://sendgrid.com → Email API → Dynamic Templates
   - შექმენით 7 ტემპლატი
   - აიღეთ Template ID-ები (მაგ: d-abc123...)

2. **განაახლეთ ტემპლატები ბაზაში**:
```bash
# ეს კომანდა დაგეხმარებათ
php artisan tinker
>>> \App\Models\NotificationTemplate::where('id', 1)->update(['provider_template_id' => 'd-your-real-template-id']);
```

3. **ან ხელით შეცვალეთ ბაზაში** provider_template_id ველები.

## 🎯 სრული ტესტი:
```bash
php artisan email:test --step=full
```

## 🔄 Event Flow ტესტი:
სისტემა ავტომატურად:
1. ReservationRequested event-ს dispatch-ს გავქნა
2. NotificationEvent ჩანაწერს ქმნის
3. ProcessNotificationEvent job-ს ხმარება
4. ელ-წერილებს აგზავნის

## ✨ შემდგომი ნაბიჯები:
1. SendGrid-ში შექმენით templates
2. ბაზაში განაახლეთ template ID-ები
3. გატესტეთ რეალური ელ-წერილები
4. Production-ზე deploy გააკეთეთ
