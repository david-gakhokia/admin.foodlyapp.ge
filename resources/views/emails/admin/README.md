# Foodly ემეილის შაბლონები 📧

## აღწერა
ახალი, მოდერნული და ტრენდული ემეილის შაბლონები რეზერვაციის სტატუსის ცვლილებებისთვის.

## შაბლონები

### 1. **Universal Template** (`reservation-universal.blade.php`)
- **ყოველმხრივი გამოყენების შაბლონი** - იყენებს `$status` ცვლადს
- ავტომატურად ირჩევს შესაბამის ფერებს და ტექსტს სტატუსის მიხედვით
- მხარს უჭერს: `confirmed`, `cancelled`, `completed`, `pending`

### 2. **Elegant Template** (`reservation-elegant.blade.php`)
- **ელეგანტური, პრემიუმ დიზაინი**
- კლასიკური ნაცრისფერი კოლორით
- ჩაშენებული ანიმაციები და ეფექტები

### 3. **Modern Status-Specific Templates**
- `confirmed-new.blade.php` - მწვანე ფერი დადასტურებულისთვის ✅
- `cancelled-new.blade.php` - ნაცრისფერი ფერი გაუქმებულისთვის ❌
- `completed-new.blade.php` - იასამნისფერი ფერი დასრულებულისთვის 🎉
- `pending-new.blade.php` - ნარინჯისფერი ფერი მოლოდინისთვის ⏳

## ფუნქციონალობა

### ✨ მოდერნული ფუნქციები
- **Responsive Design** - ყველა მოწყობილობაზე სრულყოფილად მუშაობს
- **Dark Mode Support** - მუქი თემის მხარდაჭერა
- **Email Client Compatible** - ყველა ემეილ კლიენტთან თავსებადობა
- **Print-Friendly** - ბეჭდვისთვის ოპტიმიზირებული

### 🎨 ვიზუალური ელემენტები
- გრადიენტებით ფონები
- ემოჯი იკონები სტატუსებისთვის
- მგრძნობიარე ანიმაციები
- მოდერნული ტიპოგრაფია

### 📱 მობილური ოპტიმიზაცია
- Responsive layout
- Touch-friendly ბატონები
- მობილურზე გაუმჯობესებული ფონტები
- ოპტიმიზირებული სპეისინგი

## გამოყენება

### Laravel Mailable-ში
```php
// Universal template გამოყენება
return new \Illuminate\Mail\Mailable()
    ->view('emails.admin.reservation-universal', [
        'status' => 'confirmed', // confirmed, cancelled, completed, pending
        'restaurantName' => $restaurant->name,
        'reservation' => $reservation
    ]);

// Status-specific template გამოყენება
return new \Illuminate\Mail\Mailable()
    ->view('emails.admin.confirmed-new', [
        'restaurantName' => $restaurant->name,
        'reservation' => $reservation
    ]);
```

### ცვლადები
- `$status` - სტატუსი (universal template-ისთვის)
- `$restaurantName` - რესტორნის სახელი
- `$reservation` - რეზერვაციის ობიექტი (ოფციონალური)

### რეზერვაციის ობიექტის თვისებები
```php
$reservation->id              // რეზერვაციის ID
$reservation->client_name     // კლიენტის სახელი
$reservation->email           // ელ. ფოსტა
$reservation->phone           // ტელეფონი
$reservation->guest_count     // პერსონების რაოდენობა
$reservation->reservation_date // თარიღი
$reservation->reservation_time // დრო
```

## სტატუსები

| სტატუსი | ემოჯი | ფერი | აღწერა |
|---------|-------|------|--------|
| `confirmed` | 🎯 | მწვანე | დადასტურებული |
| `cancelled` | 💔 | წითელი | გაუქმებული |
| `completed` | 🌟 | იასამნისფერი | დასრულებული |
| `pending` | 🔄 | ნარინჯისფერი | მოლოდინში |

## ფაილების სტრუქტურა
```
resources/views/emails/admin/
├── reservation-universal.blade.php    # Universal შაბლონი
├── reservation-elegant.blade.php      # Elegant შაბლონი
├── confirmed-new.blade.php           # დადასტურების შაბლონი
├── cancelled-new.blade.php           # გაუქმების შაბლონი
├── completed-new.blade.php           # დასრულების შაბლონი
└── pending-new.blade.php             # მოლოდინის შაბლონი
```

## CSS ფუნქციები

### ფერები
- Primary: `#667eea` → `#764ba2`
- Success: `#10b981` → `#059669`
- Error: `#ef4444` → `#dc2626`
- Warning: `#f59e0b` → `#d97706`
- Purple: `#8b5cf6` → `#7c3aed`

### ტიპოგრაფია
- Font Family: `-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial`
- მთავარი სათაური: `28px`, `font-weight: 700`
- ქვესათაური: `16px`, `color: #718096`
- ტექსტი: `16px`, `line-height: 1.6`

## მოწყობის ინსტრუქციები

1. **Universal Template-ის გამოყენება** (რეკომენდებული):
```php
$status = 'confirmed'; // ან 'cancelled', 'completed', 'pending'
Mail::send('emails.admin.reservation-universal', compact('status', 'restaurantName', 'reservation'), function($message) {
    $message->to($email)->subject('რეზერვაციის სტატუსი');
});
```

2. **Status-Specific Template-ების გამოყენება**:
```php
Mail::send('emails.admin.confirmed-new', compact('restaurantName', 'reservation'), function($message) {
    $message->to($email)->subject('რეზერვაცია დადასტურდა');
});
```

## ტესტირება

ემეილების ტესტირებისთვის შეგიძლიათ გამოიყენოთ:
- [Litmus](https://litmus.com/)
- [Email on Acid](https://www.emailonacid.com/)
- ან უბრალოდ გაგზავნოთ ტესტური ემეილები

## მხარდაჭერილი ემეილ კლიენტები
- ✅ Gmail
- ✅ Outlook (Desktop & Web)
- ✅ Apple Mail
- ✅ Yahoo Mail
- ✅ Thunderbird
- ✅ მობილური კლიენტები

---

**შექმნილია Foodly-ს გუნდის მიერ** 🍽️
