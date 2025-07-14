# FOODLYAPP API - პროექტის დოკუმენტაცია

## 📋 პროექტის მიმოხილვა

**პროექტის სახელი:** FOODLYAPP API  
**ტიპი:** Laravel REST API  
**ვერსია:** Laravel 12.19.3  
**PHP ვერსია:** 8.3.23  
**მონაცემთა ბაზა:** MySQL (foodlyapp_ge)  
**რეპოზიტორი:** https://github.com/david-gakhokia/api.foodlyapp.ge

## 🏗️ არქიტექტურული მიმოხილვა

### ტექნოლოგიური სტეკი
- **Backend Framework:** Laravel 12.19.3
- **PHP Version:** 8.3.23  
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **Authorization:** Spatie Laravel Permission
- **Image Management:** Cloudinary
- **Frontend Assets:** Vite + Node.js
- **QR Code Generation:** Endroid QR Code
- **PDF Generation:** mPDF
- **Translations:** Astrotomic Laravel Translatable

### ძირითადი ფუნქციონალები
1. **რესტორნების მართვა** - რესტორნების, კუზინების, და მენიუების სისტემა
2. **ბრონირების სისტემა** - მაგიდების და ადგილების ბრონირება
3. **მენიუ მენეჯმენტი** - კატეგორიები, პროდუქტები, ფასები
4. **ანალიტიკა** - გვერდების ნახვები და სტატისტიკა
5. **მომხმარებელთა მართვა** - როლები, უფლებები, ავთენტიფიკაცია
6. **კიოსკების სისტემა** - ციფრული მენიუები QR კოდებით

## 🗄️ მონაცემთა ბაზის სტრუქტურა

### ძირითადი ცხრილები (45 ცხრილი):

#### მომხმარებლები და უფლებები
- `users` - სისტემის მომხმარებლები
- `roles`, `permissions`, `role_has_permissions` - Spatie Permission სისტემა
- `personal_access_tokens` - Sanctum ტოკენები

#### რესტორნები და ადგილები  
- `restaurants` + `restaurant_translations` - რესტორნების ინფორმაცია
- `places` + `place_translations` - ადგილები რესტორნებში
- `tables` + `table_translations` - მაგიდები
- `spaces` + `space_translations` - სივრცეები
- `spots` + `spot_translations` - ცალკეული ადგილები

#### მენიუ სისტემა
- `cuisines` + `cuisine_translations` - კუზინების ტიპები
- `menu_categories` + `menu_category_translations` - მენიუს კატეგორიები  
- `menu_items` + `menu_item_translations` - მენიუს პუნქტები
- `dishes` + `dish_translations` - კერძები
- `photos` - სურათები (Cloudinary)

#### ბრონირების სისტემა
- `reservations` - ბრონირების ძირითადი ინფორმაცია
- `restaurant_reservation_slots` - რესტორნების ვადები
- `place_reservation_slots` - ადგილების ვადები  
- `table_reservation_slots` - მაგიდების ვადები

#### ანალიტიკა
- `page_views` - გვერდების ნახვები
- `analytics_summary` - შეჯამებული სტატისტიკა

#### კიოსკები
- `kiosks` - ციფრული მენიუების ტერმინალები

## 🔧 განყოფილებული პროცესები და ოპტიმიზაცია

### 1. Git რეპოზიტორის მართვა
```bash
# GitHub კავშირის წაშლა და თავიდან დაკავშირება
git remote remove origin
git remote add origin https://github.com/david-gakhokia/api.foodlyapp.ge.git
git branch -M main
git push -u origin main
```

### 2. სინტაქსური შეცდომების გამოსწორება
- **მოძებნილი პრობლემა:** `ReservationController_OLD.php` - არასწორი PHP სინტაქსი
- **გამოსწორება:** ფაილის წაშლა და route კონფლიქტების მოგვარება

### 3. CloudinaryService ოპტიმიზაცია
```php
// დამატებული null-check ები და გაუმჯობესებული error handling
public function __construct()
{
    $this->cloudName = config('cloudinary.cloud_name');
    $this->apiKey = config('cloudinary.api_key');
    $this->apiSecret = config('cloudinary.api_secret');
    
    if (empty($this->cloudName) || empty($this->apiKey) || empty($this->apiSecret)) {
        throw new \Exception('Cloudinary configuration is incomplete');
    }
}
```

### 4. Migration-ების კონსოლიდაცია
**ორიგინალი:** 41 migration ფაილი  
**ოპტიმიზებული:** 34 migration ფაილი

**გაერთიანებული migration-ები:**
- `kiosks_table_unified` - კიოსკების სისტემა
- `restaurants_table_unified` - რესტორნების სისტემა  
- `menu_categories_table_unified` - მენიუს კატეგორიები
- `restaurant_space_table_unified` - რესტორან-სივრცის კავშირი

### 5. Database Seeder-ების ოპტიმიზაცია
**წინა მდგომარეობა:** 15+ seeder ყველა ტესტური მონაცემით  
**ახლანდელი:** მხოლოდ აუცილებელი seeders:

```php
// DatabaseSeeder.php
public function run(): void
{
    $this->call([
        RolePermissionSeeder::class,  // როლები და უფლებები
        AdminUserSeeder::class,       // ადმინისტრაციული მომხმარებელი  
        KioskSeeder::class,          // კიოსკების ძირითადი კონფიგურაცია
    ]);
}
```

## 🚀 Development Environment Setup

### ლოკალური გარემოს მომზადება:

#### 1. Dependencies Installation
```bash
# PHP dependencies  
composer install

# Node.js dependencies
npm install
```

#### 2. Environment Configuration
```bash
# .env ფაილის კონფიგურაცია
APP_NAME=FOODLYAPP
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=foodlyapp_ge
DB_USERNAME=root
DB_PASSWORD=

# Cloudinary
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key  
CLOUDINARY_API_SECRET=your_api_secret
```

#### 3. Database Setup
```bash
# Migration-ების გაშვება
php artisan migrate

# Essential Data Seeding
php artisan db:seed
```

#### 4. Development Server
```bash
# Laravel Server
php artisan serve

# Frontend Assets (ცალკე terminal-ში)
npm run dev
```

## 📊 მონაცემთა ბაზის შედეგები

### Migration-ების სტატისტიკა:
- **ჯამური ცხრილები:** 45
- **Translation ცხრილები:** 15 (მრავალენოვანი მხარდაჭერისთვის)
- **Pivot ცხრილები:** 8 (many-to-many კავშირებისთვის)
- **System ცხრილები:** 7 (Laravel/Sanctum/Spatie)

### Seeder შედეგები:
- **მომხმარებლები:** 1 (ადმინი)
- **როლები:** 3 (Super Admin, Admin, User)
- **უფლებები:** 56 (CRUD ოპერაციები ყველა მოდულისთვის)
- **კიოსკები:** 3 (Batumi Seaside, Tbilisi Central, Kutaisi Mall)

## 🔒 Security Configuration

### Authentication & Authorization:
- **Laravel Sanctum:** API authentication
- **Spatie Permission:** Role-based access control
- **Middleware:** ავტორიზაციის შემოწმება

### API Routes Security:
```php
// Protected routes example
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('restaurants', RestaurantController::class);
    Route::apiResource('reservations', ReservationController::class);
});
```

## 📱 API Endpoints Structure

### მთავარი API მარშრუტები:

#### Authentication
- `POST /api/login` - ავტორიზაცია
- `POST /api/logout` - გამოსვლა
- `POST /api/register` - რეგისტრაცია

#### Restaurants Management  
- `GET /api/restaurants` - რესტორნების სია
- `POST /api/restaurants` - ახალი რესტორნის დამატება
- `GET /api/restaurants/{id}` - კონკრეტული რესტორნის ინფორმაცია

#### Reservations
- `GET /api/reservations` - ბრონირების სია
- `POST /api/reservations` - ახალი ბრონირება
- `PUT /api/reservations/{id}` - ბრონირების განახლება

#### Menu Management
- `GET /api/menu-categories` - მენიუს კატეგორიები
- `GET /api/menu-items` - მენიუს პუნქტები
- `GET /api/dishes` - კერძების სია

## 🔧 Package Dependencies

### Production Dependencies:
```json
{
  "astrotomic/laravel-translatable": "^11.16",
  "cloudinary-labs/cloudinary-laravel": "^3.0", 
  "endroid/qr-code": "^6.0",
  "laravel/framework": "^12.0",
  "laravel/sanctum": "^4.1",
  "spatie/laravel-permission": "^6.17",
  "mpdf/mpdf": "^8.2"
}
```

### Development Dependencies:
```json
{
  "barryvdh/laravel-debugbar": "^3.15",
  "laravel/pail": "^1.2.2",
  "pestphp/pest": "^3.5"
}
```

## 🌐 Deployment Considerations

### Laravel Cloud Preparation:
1. **Environment Variables:** .env ფაილის მონაცემები cloud environment-ში
2. **Database:** Production MySQL database configuration
3. **Storage:** Cloudinary-ის გამოყენება file storage-ისთვის
4. **Caching:** Redis cache driver (რეკომენდებული)
5. **Queue:** Database queue driver თავდაპირველად

### Production Checklist:
- ✅ Migration-ები კონსოლიდებული
- ✅ Essential seeders მომზადებული  
- ✅ Cloudinary კონფიგურაცია
- ✅ API routes დაცული
- ✅ Error handling შემოწმებული
- ⏳ Performance optimization (cache, queue)
- ⏳ Monitoring და logging setup

## 📈 Performance Optimizations

### Database Optimizations:
- **Index-ები:** foreign keys და search fields-ზე
- **Translation tables:** Optimized queries Astrotomic package-ით
- **Eager loading:** N+1 queries თავიდან აცილება

### Caching Strategy:
- **Model caching:** რესტორნების და მენიუების cache
- **Route caching:** Production-ში route cache
- **Config caching:** Environment configuration cache

## 🐛 Known Issues & Solutions

### NPM Security Vulnerabilities:
```bash
# შეცდომა: 15 security vulnerabilities (3 low, 4 moderate, 4 high, 4 critical)
# გამოსწორება:
npm audit fix --force
```

### PowerShell Execution Policy:
```powershell
# შეცდომა: Execution policy restriction
# გამოსწორება:
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

## 📞 Technical Support

### Development Team:
- **Lead Developer:** David Gakhokia
- **Repository:** https://github.com/david-gakhokia/api.foodlyapp.ge
- **Project Path:** C:\Users\Davit\Herd\api.foodlyapp.ge

### Useful Commands:
```bash
# Status Check
php artisan route:list
php artisan migrate:status
composer show

# Development
php artisan serve
npm run dev
php artisan tinker

# Production Preparation  
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

**დოკუმენტაციის განახლების თარიღი:** 2025 ივლისი 14  
**პროექტის სტატუსი:** Development Environment Ready for Laravel Cloud Deployment
