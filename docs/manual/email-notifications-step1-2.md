# FOODLY — Email Notifications

## STEP 1 — Notification სისტემის მონაცემთა სტრუქტურა (Migrations & Models)

### მიზანი
Notification სისტემას სჭირდება ისეთი მონაცემთა ბაზის სტრუქტურა, რომელიც დაგვეხმარება:
- შევინახოთ ყველა მომხდარი მოვლენა (მაგ. ჯავშნის დადასტურება),
- დავაგენერიროთ შესაბამისი შეტყობინებები,
- დავაკვირდეთ მათი გაგზავნის სტატუსს (გაიგზავნა თუ ვერა),
- შევძლოთ მოქნილი წესების (rules) მართვა, თუ ვინ მიიღებს შეტყობინებას.

ამ ეტაპზე ვამზადებთ მხოლოდ **მონაცემთა ბაზის ცხრილებს** და **მოდელებს** Laravel-ში.  

### რა ცხრილები გვჭირდება

#### 1. `notification_events`
- აქ ვინახავთ ყველა მოვლენის ჩანაწერს (მაგ. „რეზერვაცია დადასტურდა“).
- ველებია:
  - `event_key` — მოვლენის ტიპი (`reservation.confirmed`, `reservation.requested`…).
  - `reservation_id` — რომელი რეზერვაციას უკავშირდება.
  - `payload` — მოვლენის სრული მონაცემები JSON-ში.
  - `idempotency_key` — უნიკალური გასაღები, რომ ერთი და იგივე მოვლენა ორჯერ არ გაიგზავნოს.
  - `status` — pending, processing, done, failed.
  - `retries`, `last_error`.

#### 2. `notification_deliveries`
- კონკრეტული შეტყობინების გაგზავნის ჩანაწერი.
- ველებია: `event_id`, `recipient_type`, `recipient_email`, `provider`, `message_id`, `status`, `meta`.

#### 3. `notification_templates`
- ინახება Template Mapping SendGrid-თან.
- ველებია: `key`, `provider_template_id`, `lang`, `status`.

#### 4. `notification_rules`
- წესების ცხრილი, რომელი მოვლენა რომელი არხით/მიმღებს გაეგზავნება.
- ველებია: `scope`, `restaurant_id`, `matrix`.

### რა მოდელები გვჭირდება
- `NotificationEvent`
- `NotificationDelivery`
- `NotificationTemplate`
- `NotificationRule`

### შედეგი STEP 1-ის შემდეგ
- გვაქვს 4 ძირითადი ცხრილი და შესაბამისი მოდელები.
- მზად ვართ Template Mapping-ის (Seeder) გასაკეთებლად.

---

## STEP 2 — Template Mapping (Seeder)

### მიზანი
- თითო მოვლენა დაკავშირებულია კონკრეტულ Email Template-თან.
- SendGrid Dynamic Templates-ის გამოყენებით თითო `event+recipient` უნდა იყოს მიბმული `template_id`-ზე.

### რა ცხრილს ვავსებთ
- `notification_templates`

ველები: `key`, `provider_template_id`, `lang`, `status`.

### საჭირო Template Keys
1. `reservation.requested.manager.email`
2. `reservation.requested.admin.email`
3. `reservation.requested.client.email`
4. `reservation.confirmed.client.email`
5. `reservation.declined.client.email`
6. `reservation.prearrival.client.email`
7. `reservation.payment_succeeded.client.email`
8. `reservation.payment_failed.client.email`

### Seeder Example
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

### შედეგი STEP 2-ის შემდეგ
- Template Mapping უკვე ბაზაშია.
- Processor Job შეძლებს სწორი template_id-ს ამოკითხვას.
- სისტემა მზადაა Config-ის ეტაპისთვის (STEP 3).
