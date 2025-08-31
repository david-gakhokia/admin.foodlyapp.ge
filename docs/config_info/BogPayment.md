# BOG გადახდის სისტემის ინტეგრაცია

## 📋 პროექტის მიმოხილვა

BOG (Bank of Georgia) გადახდის სისტემის ინტეგრაცია FOODLY reservation პლატფორმაში.

## 🎯 ბიზნეს ნაკადი

### ReservationStatus Flow:
```
1. pending → confirmed (რესტორნის დადასტურება)
2. confirmed → paid (BOG წარმატებული გადახდა)
3. paid → completed (კლიენტი მოვიდა)
   ან
   paid → no_show (კლიენტი არ გამოჩნდა)
   ან
   paid → cancelled (refund საჭიროა)
```

### Status-ების აღწერა:
- **pending** - კლიენტის მოთხოვნა გაგზავნილია
- **confirmed** - რესტორანმა დაადასტურა, გადახდის მოლოდინში
- **paid** - BOG-ით წარმატებით გადახდილია
- **completed** - კლიენტი მოვიდა, რეზერვაცია წარმატებულია ✅
- **no_show** - გადახდილი, მაგრამ კლიენტი არ გამოჩნდა ❌
- **cancelled** - გაუქმებული ნებისმიერ ეტაპზე ❌

## 🏗️ ტექნიკური სტრუქტურა

### 1. ReservationStatus Enum (განახლებული)
```php
// app/Enums/ReservationStatus.php
enum ReservationStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
    case Paid = 'paid';
    case Completed = 'completed';
    case NoShow = 'no_show';
}
```

### 2. BOG Transactions ცხრილი
```sql
CREATE TABLE bog_transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reservation_id BIGINT UNSIGNED NOT NULL,
    bog_order_id VARCHAR(255) UNIQUE NOT NULL,
    bog_payment_id VARCHAR(255) NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'GEL',
    status ENUM('pending', 'processing', 'completed', 'failed', 'cancelled', 'refunded') DEFAULT 'pending',
    bog_status VARCHAR(50) NULL,
    bog_response_data JSON NULL,
    payment_url TEXT NULL,
    callback_url TEXT NULL,
    error_message TEXT NULL,
    expires_at TIMESTAMP NULL,
    paid_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE
);
```

### 3. ფაილების სტრუქტურა
```
app/
├── Services/
│   └── BOG/
│       ├── BOGPaymentService.php
│       ├── BOGAuthService.php
│       ├── BOGWebhookService.php
│       └── BOGStatusMapper.php
├── Models/
│   ├── BOGTransaction.php
│   └── BOGApiToken.php
├── Http/
│   └── Controllers/
│       └── BOGWebhookController.php
├── Jobs/
│   └── ProcessBOGWebhook.php
├── Events/
│   └── BOGPaymentStatusChanged.php
└── Listeners/
    └── HandleBOGPaymentNotification.php

config/
└── bog.php

database/migrations/
├── create_bog_transactions_table.php
└── create_bog_api_tokens_table.php
```

## 🔧 კონფიგურაცია

### 1. Environment ცვლადები
```env
# BOG API Configuration
BOG_CLIENT_ID=your_client_id
BOG_CLIENT_SECRET=your_client_secret
BOG_ENVIRONMENT=sandbox # ან production
BOG_WEBHOOK_SECRET=your_webhook_secret

# BOG API URLs
BOG_AUTH_URL=https://api.bog.ge/oauth2/token
BOG_PAYMENT_URL=https://api.bog.ge/payments/checkout
BOG_API_URL=https://api.bog.ge

# Callback URLs
BOG_SUCCESS_URL="${APP_URL}/bog/payment/success"
BOG_FAIL_URL="${APP_URL}/bog/payment/fail"
BOG_WEBHOOK_URL="${APP_URL}/bog/webhook"
```

### 2. BOG Config ფაილი
```php
// config/bog.php
return [
    'client_id' => env('BOG_CLIENT_ID'),
    'client_secret' => env('BOG_CLIENT_SECRET'),
    'environment' => env('BOG_ENVIRONMENT', 'sandbox'),
    'webhook_secret' => env('BOG_WEBHOOK_SECRET'),
    
    'urls' => [
        'auth' => env('BOG_AUTH_URL', 'https://api.bog.ge/oauth2/token'),
        'payment' => env('BOG_PAYMENT_URL', 'https://api.bog.ge/payments/checkout'),
        'api' => env('BOG_API_URL', 'https://api.bog.ge'),
    ],
    
    'callbacks' => [
        'success' => env('BOG_SUCCESS_URL'),
        'fail' => env('BOG_FAIL_URL'),
        'webhook' => env('BOG_WEBHOOK_URL'),
    ],
    
    'currency' => 'GEL',
    'timeout' => 30, // seconds
    'payment_expiry' => 24, // hours
];
```

## 🔄 BOG Status Mapping

### BOG API Status → Reservation Status
```php
'success', 'captured', 'completed' → ReservationStatus::Paid
'failed', 'declined', 'insufficient_funds' → ReservationStatus::Confirmed (retry possible)
'cancelled', 'voided', 'user_cancelled' → ReservationStatus::Cancelled
'refunded', 'partially_refunded' → ReservationStatus::Cancelled
'pending', 'processing' → no status change
```

### BOG API Status → Transaction Status
```php
'success' → 'completed'
'failed' → 'failed'
'cancelled' → 'cancelled'
'refunded' → 'refunded'
'pending' → 'pending'
'processing' → 'processing'
```

## 🚀 იმპლემენტაციის ნაბიჯები

### Phase 1: ბაზური სტრუქტურა (1-2 დღე)
- [ ] Migration-ების შექმნა (`bog_transactions`, `bog_api_tokens`)
- [ ] Model-ების შექმნა (`BOGTransaction`, `BOGApiToken`)
- [ ] BOG config ფაილის შექმნა
- [ ] ReservationStatus enum-ის განახლება

### Phase 2: Authentication & API Integration (2-3 დღე)
- [ ] BOGAuthService - OAuth 2.0 token management
- [ ] BOGPaymentService - payment creation & tracking
- [ ] BOGStatusMapper - status conversion logic
- [ ] ტესტირება Sandbox-ში

### Phase 3: Frontend Integration (1-2 დღე)
- [ ] Payment form-ების განახლება
- [ ] BOG redirect logic
- [ ] Success/Fail callback გვერდები
- [ ] JavaScript validation

### Phase 4: Webhooks & Events (1-2 დღე)
- [ ] BOGWebhookController - webhook handling
- [ ] Event/Listener სისტემა
- [ ] Email notification integration
- [ ] Status synchronization

### Phase 5: Testing & Security (1-2 დღე)
- [ ] Unit tests
- [ ] Integration tests
- [ ] Security validation (webhook signatures)
- [ ] Error handling & logging

## 🔐 უსაფრთხოება

### Webhook Validation
```php
// Verify BOG webhook signature
$signature = hash_hmac('sha256', $payload, config('bog.webhook_secret'));
if (!hash_equals($signature, $receivedSignature)) {
    abort(403, 'Invalid webhook signature');
}
```

### Error Handling
- API timeout handling
- Network failure recovery
- Invalid response handling
- Retry logic for failed requests

## 📊 Monitoring & Logging

### ლოგირება
```php
Log::info('BOG Payment initiated', [
    'reservation_id' => $reservation->id,
    'bog_order_id' => $bogOrderId,
    'amount' => $amount
]);
```

### მონიტორინგი
- Payment success/failure rates
- Average payment processing time
- Webhook delivery status
- Error frequency tracking

## 🧪 ტესტირება

### Sandbox Testing
- BOG sandbox credentials გამოყენება
- Test card numbers ტესტირება
- Webhook simulation
- Error scenarios testing

### Unit Tests
- BOGPaymentService methods
- Status mapping logic
- Webhook processing
- Event/Listener functionality

## 📈 მომავალი განვითარება

### შესაძლო გაუმჯობესებები
- Recurring payments support
- Multiple payment methods
- Payment analytics dashboard
- Automated refund processing
- Customer payment history

## 🆘 Troubleshooting

### ხშირი პრობლემები
1. **Token expiration** - ავტომატური refresh
2. **Webhook timeouts** - retry mechanism
3. **Status sync issues** - manual reconciliation
4. **Payment failures** - detailed error logging

### Debug Tools
```bash
# BOG transaction status check
php artisan bog:check-transaction {bog_order_id}

# Webhook testing
php artisan bog:test-webhook

# Status synchronization
php artisan bog:sync-statuses
```

## 📞 Support

### BOG API Documentation
- Authentication: https://api.bog.ge/docs/en/payments/authentication
- Payments: https://api.bog.ge/docs/en/payments/checkout
- Webhooks: https://api.bog.ge/docs/en/payments/webhooks

### Internal Contacts
- Technical Lead: [Your Name]
- Project Manager: [PM Name]
- BOG Integration Support: support@bog.ge

---

**შენიშვნა:** ეს დოკუმენტი განახლდება პროექტის პროგრესის შესაბამისად.

**ბოლო განახლება:** 2025-08-31
**ვერსია:** 1.0
**სტატუსი:** Planning Phase
