# API Project Structure & Migration Plan

## 📂 ახალი API პროექტის სტრუქტურა

### Core Modules (API Project)
```
api-foodlyapp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       ├── UserController.php
│   │   │       ├── RestaurantController.php
│   │   │       ├── CuisineController.php
│   │   │       ├── DishController.php
│   │   │       ├── SpotController.php
│   │   │       ├── SpaceController.php
│   │   │       ├── CityController.php
│   │   │       └── RolePermissionController.php
│   │   ├── Resources/
│   │   │   ├── UserResource.php
│   │   │   ├── RestaurantResource.php
│   │   │   ├── CuisineResource.php
│   │   │   ├── DishResource.php
│   │   │   ├── SpotResource.php
│   │   │   ├── SpaceResource.php
│   │   │   └── CityResource.php
│   │   ├── Requests/
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Role.php
│   │   ├── Permission.php
│   │   ├── Restaurant.php
│   │   ├── Cuisine.php
│   │   ├── Dish.php
│   │   ├── Spot.php
│   │   ├── Space.php
│   │   ├── City.php
│   │   └── Translations/
│   └── Services/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── routes/
│   ├── api.php
│   └── web.php (minimal)
├── config/
├── resources/
│   └── views/ (minimal for docs)
└── tests/
```

---

## 🗂️ Files to Copy/Move to API Project

### Models (9 core models + translations)
```
FROM: app/Models/
TO: api-project/app/Models/

✅ User.php
✅ Role.php  
✅ Permission.php
✅ Restaurant.php
✅ RestaurantTranslation.php
✅ Cuisine.php
✅ CuisineTranslation.php
✅ Dish.php
✅ DishTranslation.php
✅ Spot.php
✅ SpotTranslation.php
✅ Space.php
✅ SpaceTranslation.php
✅ City.php
✅ CityTranslation.php
```

### API Controllers
```
FROM: app/Http/Controllers/Api/
TO: api-project/app/Http/Controllers/Api/

✅ AuthController.php
✅ UserController.php
✅ RestaurantController.php
✅ CuisineController.php
✅ DishController.php
✅ SpotController.php
✅ SpaceController.php
✅ CityController.php
✅ CuisineRestaurantController.php
✅ SpotRestaurantController.php
✅ RestaurantCuisineController.php
```

### Resources
```
FROM: app/Http/Resources/
TO: api-project/app/Http/Resources/

✅ UserResource.php
✅ RestaurantResource.php
✅ RestaurantShortResource.php
✅ CuisineResource.php
✅ DishResource.php
✅ SpotResource.php
✅ SpaceResource.php
✅ CityResource.php
✅ CategoryResource.php (if needed)
```

### Database Files
```
FROM: database/migrations/
TO: api-project/database/migrations/

📋 Select migrations for core 9 modules only:
- create_users_table
- create_roles_table  
- create_permissions_table
- create_role_has_permissions_table
- create_model_has_roles_table
- create_model_has_permissions_table
- create_restaurants_table
- create_restaurant_translations_table
- create_cuisines_table
- create_cuisine_translations_table
- create_dishes_table
- create_dish_translations_table
- create_spots_table
- create_spot_translations_table
- create_spaces_table
- create_space_translations_table
- create_cities_table
- create_city_translations_table
- create_cuisine_restaurant_table
- create_dish_restaurant_table
- create_spot_restaurant_table
- create_space_restaurant_table
```

### Route Files
```
FROM: routes/api.php
TO: api-project/routes/api.php

📋 Extract only relevant API routes for 9 modules
```

### Configuration Files
```
FROM: config/
TO: api-project/config/

✅ sanctum.php
✅ permission.php
✅ translatable.php
✅ cloudinary.php
✅ cors.php
📝 Modify: app.php, database.php, auth.php
```

---

## 🚫 Files NOT to Copy (Admin Dashboard Only)

### Controllers to Exclude
```
❌ app/Http/Controllers/Admin/ (all except API-related)
❌ app/Http/Controllers/Manager/
❌ app/Http/Controllers/Kiosk/ (except API parts)
❌ app/Http/Controllers/Test/
❌ app/Http/Controllers/BOG*
❌ Livewire components
❌ All non-API web controllers
```

### Models to Exclude
```
❌ Reservation.php
❌ Place.php
❌ Table.php
❌ Kiosk.php
❌ BOGTransaction.php
❌ NotificationLog.php
❌ Analytics*.php
❌ PageView.php
❌ Menu*.php
❌ Product.php
❌ Category.php (if not needed for API)
```

### Routes to Exclude
```
❌ All web.php routes (except basic auth)
❌ Kiosk-specific routes
❌ Manager routes
❌ Analytics routes
❌ BOG payment routes
❌ Reservation routes
❌ Monitoring routes
```

### Views & Frontend Assets
```
❌ resources/views/ (most of them)
❌ resources/js/
❌ resources/css/
❌ public/assets/
❌ Livewire components
```

---

## 🔧 Configuration Changes for API Project

### composer.json Modifications
```json
{
    "name": "foodly/api-project",
    "description": "Foodly Restaurant API",
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0",
        "laravel/sanctum": "^4.1",
        "spatie/laravel-permission": "^6.17",
        "spatie/laravel-sluggable": "^3.7",
        "astrotomic/laravel-translatable": "^11.16",
        "cloudinary-labs/cloudinary-laravel": "^3.0"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "pestphp/pest": "^3.8",
        "pestphp/pest-plugin-laravel": "^3.2"
    }
}
```

### Remove Dependencies
```json
// Remove from composer.json:
❌ "livewire/flux"
❌ "livewire/volt"  
❌ "power-components/livewire-powergrid"
❌ "romanzipp/laravel-queue-monitor"
❌ "laravel/horizon"
❌ "sendgrid/sendgrid"
❌ "mpdf/mpdf"
❌ "endroid/qr-code"
```

### app.php Changes
```php
// Remove providers:
❌ Livewire providers
❌ PowerGrid providers
❌ Horizon providers

// Keep essential providers:
✅ Sanctum provider
✅ Permission provider
✅ Translatable provider
✅ Cloudinary provider
```

---

## 📝 New API Routes Structure

### Clean API Routes File
```php
<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    UserController,
    RestaurantController,
    CuisineController,
    DishController,
    SpotController,
    SpaceController,
    CityController
};

// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // User management
    Route::apiResource('users', UserController::class);
});

// Public API routes
Route::prefix('v1')->middleware(['throttle:api'])->group(function () {
    
    // Restaurants
    Route::prefix('restaurants')->group(function () {
        Route::get('/', [RestaurantController::class, 'index']);
        Route::get('/{slug}', [RestaurantController::class, 'showBySlug']);
        Route::get('/{slug}/menu', [RestaurantController::class, 'menu']);
    });
    
    // Cuisines
    Route::prefix('cuisines')->group(function () {
        Route::get('/', [CuisineController::class, 'index']);
        Route::get('/{slug}', [CuisineController::class, 'showBySlug']);
        Route::get('/{slug}/restaurants', [CuisineController::class, 'restaurants']);
    });
    
    // Dishes
    Route::prefix('dishes')->group(function () {
        Route::get('/', [DishController::class, 'index']);
        Route::get('/{slug}', [DishController::class, 'showBySlug']);
        Route::get('/{slug}/restaurants', [DishController::class, 'restaurants']);
    });
    
    // Spots
    Route::prefix('spots')->group(function () {
        Route::get('/', [SpotController::class, 'index']);
        Route::get('/{slug}', [SpotController::class, 'showBySlug']);
        Route::get('/{slug}/restaurants', [SpotController::class, 'restaurants']);
    });
    
    // Spaces
    Route::prefix('spaces')->group(function () {
        Route::get('/', [SpaceController::class, 'index']);
        Route::get('/{slug}', [SpaceController::class, 'showBySlug']);
        Route::get('/{slug}/restaurants', [SpaceController::class, 'restaurants']);
    });
    
    // Cities
    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index']);
        Route::get('/{slug}', [CityController::class, 'showBySlug']);
        Route::get('/{slug}/restaurants', [CityController::class, 'restaurants']);
    });
});

// Admin API routes (with authentication)
Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('restaurants', RestaurantController::class);
    Route::apiResource('cuisines', CuisineController::class);
    Route::apiResource('dishes', DishController::class);
    Route::apiResource('spots', SpotController::class);
    Route::apiResource('spaces', SpaceController::class);
    Route::apiResource('cities', CityController::class);
});
```

---

## 🗄️ Database Structure for API Project

### Core Tables Only
```sql
-- Authentication & Authorization
users
roles
permissions
role_has_permissions
model_has_roles
model_has_permissions

-- Geographic Data
cities
city_translations

-- Business Core Data
spaces
space_translations
cuisines
cuisine_translations
spots  
spot_translations
restaurants
restaurant_translations
dishes
dish_translations

-- Relationships
cuisine_restaurant
dish_restaurant
spot_restaurant
space_restaurant

-- Optional: For API tracking
personal_access_tokens (Sanctum)
```

### Tables to Exclude from API Project
```sql
❌ reservations
❌ places
❌ place_translations
❌ tables
❌ table_translations
❌ kiosks
❌ bog_transactions
❌ bog_api_tokens
❌ notification_logs
❌ notification_events
❌ analytics_*
❌ page_views
❌ menu_categories
❌ menu_items
❌ products
❌ categories
❌ reservation_slots
❌ All queue/job related tables
```

---

## 🔍 Testing Strategy for API Project

### Test Structure
```
tests/
├── Feature/
│   ├── Api/
│   │   ├── AuthApiTest.php
│   │   ├── RestaurantApiTest.php
│   │   ├── CuisineApiTest.php
│   │   ├── DishApiTest.php
│   │   ├── SpotApiTest.php
│   │   ├── SpaceApiTest.php
│   │   └── CityApiTest.php
│   └── Auth/
├── Unit/
│   ├── Models/
│   └── Services/
└── TestCase.php
```

### Essential Tests
```php
// Example: RestaurantApiTest.php
public function test_can_list_restaurants()
public function test_can_show_restaurant_by_slug()
public function test_can_filter_restaurants_by_cuisine()
public function test_restaurant_search_works()
public function test_pagination_works()
public function test_localization_works()
public function test_requires_authentication_for_admin_routes()
public function test_requires_permissions_for_crud_operations()
```

---

## 🚀 Migration Execution Plan

### Step 1: Create New Laravel Project
```bash
composer create-project laravel/laravel api-foodlyapp
cd api-foodlyapp
```

### Step 2: Install Required Packages
```bash
composer require laravel/sanctum
composer require spatie/laravel-permission
composer require spatie/laravel-sluggable
composer require astrotomic/laravel-translatable
composer require cloudinary-labs/cloudinary-laravel
```

### Step 3: Copy Core Files
```bash
# Copy models
cp -r ../admin-foodlyapp/app/Models/{User,Role,Permission,Restaurant,Cuisine,Dish,Spot,Space,City,*Translation}.php app/Models/

# Copy API controllers
cp -r ../admin-foodlyapp/app/Http/Controllers/Api/ app/Http/Controllers/

# Copy resources
cp -r ../admin-foodlyapp/app/Http/Resources/ app/Http/Resources/

# Copy specific migrations
cp ../admin-foodlyapp/database/migrations/*_create_[core_tables]_*.php database/migrations/
```

### Step 4: Configure Authentication
```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### Step 5: Setup Database
```bash
php artisan migrate
php artisan db:seed
```

### Step 6: Create API Documentation
```bash
# Install API documentation tools if needed
# Generate OpenAPI/Swagger documentation
```

---

## 📊 Performance Considerations

### Caching Strategy
```php
// Cache frequently accessed data
Cache::remember('restaurants.featured', 3600, function () {
    return Restaurant::featured()->with(['cuisines', 'city'])->get();
});

// Cache API responses
Route::middleware(['cache.headers:public;max_age=3600'])->group(function () {
    // API routes
});
```

### Database Optimization
```php
// Eager loading relationships
Restaurant::with(['cuisines', 'city', 'translations'])->paginate(15);

// Database indexes for search
Schema::table('restaurants', function (Blueprint $table) {
    $table->fullText(['name', 'description']);
    $table->index(['status', 'rank']);
});
```

### API Rate Limiting
```php
// config/sanctum.php
'rate_limiting' => [
    'api' => 'throttle:60,1',
    'admin' => 'throttle:120,1',
],
```

---

## 🔧 Environment Configuration

### API Project .env
```env
APP_NAME="Foodly API"
APP_ENV=production  
APP_DEBUG=false
APP_URL=https://api.foodlyapp.ge

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foodly_api
DB_USERNAME=foodly_api_user
DB_PASSWORD=secure_password

SANCTUM_STATEFUL_DOMAINS=foodlyapp.ge,admin.foodlyapp.ge
SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

CLOUDINARY_URL=cloudinary://your-cloudinary-config

# Localization
APP_LOCALE=ka
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=ka_GE
```

---

## 📈 Monitoring & Logging

### API Metrics to Track
- Response times by endpoint
- Request volume per hour/day
- Error rates (4xx, 5xx)
- Authentication success/failure
- Most popular endpoints
- Geographic distribution of requests

### Logging Configuration
```php
// config/logging.php
'channels' => [
    'api' => [
        'driver' => 'daily',
        'path' => storage_path('logs/api.log'),
        'level' => 'info',
        'days' => 30,
    ],
],
```

---

## 🔄 Deployment Strategy

### Production Deployment
1. **Server Setup**: Nginx + PHP-FPM + Redis + MySQL
2. **SSL Certificate**: Let's Encrypt or commercial
3. **CDN**: CloudFlare for global distribution
4. **Monitoring**: New Relic or similar
5. **Backup**: Automated database backups

### CI/CD Pipeline
```yaml
# Example GitHub Actions
name: Deploy API
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.2
      - name: Install dependencies
        run: composer install --no-dev --optimize-autoloader
      - name: Run tests
        run: php artisan test
      - name: Deploy to production
        run: # deployment script
```

---

## 📞 Next Steps

1. **Review this documentation** and approve the separation plan
2. **Create new repository** for API project
3. **Setup development environment** for API project
4. **Begin migration** following the step-by-step plan
5. **Test API endpoints** thoroughly
6. **Update client applications** to use new API endpoints
7. **Deploy to production** with monitoring

---

*ეს დოკუმენტი მოიცავს ყველა საჭირო ინფორმაციას API პროექტის წარმატებული გამოყოფისთვის არსებული Admin Dashboard პროექტიდან.*
