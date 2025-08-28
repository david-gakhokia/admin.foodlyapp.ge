# 📧 Email Notifications - Quick Reference

## 🚀 სწრაფი გაშვება

### 1. სტატუსის ცვლილება UI-ში
```
Admin/Manager Panel → Reservations → Status Dropdown → Select New Status
```

### 2. Queue Worker-ის გაშვება
```bash
# Development
php artisan queue:work --stop-when-empty

# Production
.\start_queue_worker.bat
```

### 3. Email-ების შემოწმება
- Client: მიღებული email-ი reservation.email მისამართზე
- Admin: admin@foodlyapp.ge
- Restaurant: restaurant specific email (თუ კონფიგურირებულია)

## 🔧 კომანდები

### ტესტირება
```bash
# მარტივი email ტესტი
php artisan test:email

# რეალური reservation email
php artisan test:real-reservation [id]

# მარტივი შეტყობინება
php artisan test:simple-notification [id]
```

### Queue მართვა
```bash
# Queue-ს შიგთავსის ნახვა
php artisan tinker --execute="echo 'Jobs: ' . \DB::table('jobs')->count();"

# Queue-ის გასუფთავება
php artisan queue:clear

# Failed jobs-ის retry
php artisan queue:retry all
```

## 📁 მთავარი ფაილები

```
app/
├── Events/ReservationStatusChanged.php
├── Listeners/
│   ├── Admin/QueueAdminReservationEmails.php
│   ├── Client/QueueClientReservationEmails.php
│   └── Restaurant/QueueRestaurantReservationEmails.php
├── Jobs/
│   ├── SendAdminReservationEmail.php
│   ├── SendClientReservationEmail.php
│   └── SendRestaurantReservationEmail.php
├── Mail/
│   ├── Admin/Admin*Email.php
│   ├── Client/Client*Email.php
│   └── Restaurant/Restaurant*Email.php
└── Livewire/ReservationStatusUpdater.php

resources/views/emails/
├── admin/*.blade.php
├── client/*.blade.php
└── restaurant/*.blade.php

app/Providers/EventServiceProvider.php
```

## 🐛 ხშირი პრობლემები

| პრობლემა | მიზეზი | გადაწყვეტა |
|---------|--------|------------|
| Emails არ მოდის | Queue worker არ მუშაობს | `php artisan queue:work` |
| Template error | არასწორი data | შეამოწმე Mailable კლასი |
| SMTP error | არასწორი credentials | შეამოწმე .env ფაილი |
| Jobs ჩერია queue-ში | Worker გაჩერებულია | რესტარტი worker-ის |

## 📊 სტატუსების რუკა

| სტატუსი | Admin Email | Client Email | Restaurant Email |
|---------|-------------|--------------|------------------|
| Pending | ✅ AdminPendingEmail | ✅ ClientPendingEmail | ✅ RestaurantPendingEmail |
| Confirmed | ✅ AdminConfirmedEmail | ✅ ClientConfirmedEmail | ✅ RestaurantConfirmedEmail |
| Completed | ✅ AdminCompletedEmail | ✅ ClientCompletedEmail | ✅ RestaurantCompletedEmail |
| Cancelled | ✅ AdminCancelledEmail | ✅ ClientCancelledEmail | ✅ RestaurantCancelledEmail |

## 🔄 მუშაობის ნაკადი

```
Status Change → Event → 3 Listeners → 3 Jobs → Queue → Email Sending
```

## ⚡ სწრაფი დიაგნოსტიკა

```bash
# 1. ლოგების შემოწმება
tail -f storage/logs/laravel.log

# 2. Queue jobs რაოდენობა
php artisan tinker --execute="echo \DB::table('jobs')->count();"

# 3. Test email
php artisan test:email

# 4. Queue worker ტესტი
php artisan queue:work --once
```

## 📞 მხარდაჭერა

- 📧 dev.foodly@gmail.com
- 📋 [დეტალური დოკუმენტაცია](./RESERVATION_EMAIL_NOTIFICATIONS.md)
- 🔧 [GitHub Issues](https://github.com/david-gakhokia/api.foodlyapp.ge/issues)
