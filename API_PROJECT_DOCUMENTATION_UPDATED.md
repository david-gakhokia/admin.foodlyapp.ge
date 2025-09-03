# 🚀 Food.ly API Project Documentation (Updated)

## მიზანი და სტრუქტურა
ეს არის API-only პროექტი mobile applications-ისთვის (Android/iOS), რომელიც წაკითხავს არსებული `foodly` database-დან და მოემსახურება Sanctum authentication-ით.

## 📋 პროექტის მდგომარეობა

### ✅ განხორციელებული
- **არსებული პროექტი**: Admin Dashboard სრულყოფილი Laravel პროექტი
- **Database**: `foodly` database უკვე არსებობს და მუშაობს
- **Kiosk API**: ნაწილობრივ განხორციელებული API routes

### 🎯 ახალი API პროექტი
- **პროექტის სახელი**: `api.foodly`
- **მიზანი**: მხოლოდ API endpoints მობილური აპლიკაციებისთვის
- **Database**: გამოიყენებს არსებული `foodly` database-ს
- **Authentication**: Laravel Sanctum

---

## 🗂️ API Modules (12 Total)

### 1. 🏪 **Restaurants** (Parent Level)
რესტორნების სრული მენეჯმენტი და ინფორმაცია

### 2. 🏢 **Spaces** (რესტორნების კატეგორიები)
სივრცეების ტიპები (Fine Dining, Casual, Fast Food, ბარები, etc.)

### 3. 🍽️ **Cuisines** (კულინარიული მიმართულებები)
ქართული, იტალიური, იაპონური, etc.

### 4. 🍽️ **Places** (Child of Restaurants)
რესტორნის შიგნით არსებული ადგილები/დარბაზები

### 5. 🪑 **Tables** (Child of Places)
მაგიდების მენეჯმენტი თითოეული Place-ისთვის

### 6. 🍽️ **Dishes** (კერძები)
ყველა კერძი ყველა რესტორნიდან

### 7. 📅 **Reservations** (დაჯავშნები)
მაგიდების დაჯავშნების სისტემა

### 8. 👥 **Users** (მომხმარებლები)
მობილური აპის მომხმარებლები

### 9. 🎭 **Events** (ღონისძიებები)
რესტორნების ღონისძიებები და ფესტივალები

### 10. ⭐ **Reviews** (შეფასებები)
მომხმარებლების შეფასებები და კომენტარები

### 11. 🎁 **Promotions** (აქციები)
ფასდაკლებები და სპეციალური შეთავაზებები

### 12. 📊 **Analytics** (ანალიტიკა)
API usage statistics და business insights

---

## 🔐 Authentication

### Laravel Sanctum Configuration
```php
// Basic Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
```

### Core API Routes (არსებული WebApp API სტრუქტურიდან)
```php
Route::middleware([SetLocale::class])
    ->group(function () {

        // 🏡 Restaurants (არსებული WebApp API სტრუქტურა)
        Route::prefix('restaurants')
            ->name('restaurants.')
            ->controller(RestaurantController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index'); // ყველა რესტორანი
                Route::get('/{slug}', 'show')->name('show'); // კონკრეტული რესტორანი slug-ის მიხედვით
                Route::get('/{slug}/places', 'showByPlaces')->name('places'); // ადგილები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/tables', 'showByTables')->name('tables'); // მაგიდები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/details', 'showDetails')->name('details'); // დეტალები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/menu', 'menu')->name('menu'); // მენიუ კონკრეტული რესტორნისთვის
                Route::get('/{slug}/impressions', 'impressions')->name('impressions'); // რესტორნის შთაბეჭდილებები
            });

        // 🗂 Spaces (არსებული WebApp API)
        Route::prefix('spaces')
            ->name('spaces.')
            ->controller(SpaceController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsBySpace')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsBySpace')->name('top');
            });

        // 🍽 Cuisines (არსებული WebApp API)
        Route::prefix('cuisines')
            ->name('cuisines.')
            ->controller(CuisineController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsByCuisine')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByCuisine')->name('top');
            });

        // 🍽️ Places (Child of Restaurants)
        Route::prefix('places')
            ->name('places.')
            ->controller(PlaceController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/tables', 'tables')->name('tables');
                Route::get('/{slug}/availability', 'availability')->name('availability');
            });

        // 🪑 Tables (Child of Places)
        Route::prefix('tables')
            ->name('tables.')
            ->controller(TableController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/availability', 'availability')->name('availability');
            });

        // 🍽️ Dishes
        Route::prefix('dishes')
            ->name('dishes.')
            ->controller(DishController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsByDish')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByDish')->name('top');
            });

        // 📅 Reservations
        Route::prefix('reservations')
            ->name('reservations.')
            ->controller(ReservationController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
                Route::post('/', 'store')->name('store');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('destroy');
                
                // Restaurant level reservations
                Route::get('/restaurant/{restaurant_slug}', 'byRestaurant')->name('by_restaurant');
                Route::post('/restaurant/{restaurant_slug}', 'storeForRestaurant')->name('store_restaurant');
                
                // Place level reservations  
                Route::get('/place/{place_slug}', 'byPlace')->name('by_place');
                Route::post('/place/{place_slug}', 'storeForPlace')->name('store_place');
                
                // Table level reservations
                Route::get('/table/{table_slug}', 'byTable')->name('by_table');
                Route::post('/table/{table_slug}', 'storeForTable')->name('store_table');
            });

        // 👥 Users
        Route::prefix('users')
            ->name('users.')
            ->controller(UserController::class)
            ->middleware('auth:sanctum')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });

        // 🎭 Events
        Route::prefix('events')
            ->name('events.')
            ->controller(EventController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/restaurant/{restaurant_slug}', 'byRestaurant')->name('by_restaurant');
            });

        // ⭐ Reviews
        Route::prefix('reviews')
            ->name('reviews.')
            ->controller(ReviewController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
                Route::get('/restaurant/{restaurant_slug}', 'byRestaurant')->name('by_restaurant');
                Route::post('/', 'store')->name('store')->middleware('auth:sanctum');
                Route::put('/{id}', 'update')->name('update')->middleware('auth:sanctum');
                Route::delete('/{id}', 'destroy')->name('destroy')->middleware('auth:sanctum');
            });

        // 🎁 Promotions
        Route::prefix('promotions')
            ->name('promotions.')
            ->controller(PromotionController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/restaurant/{restaurant_slug}', 'byRestaurant')->name('by_restaurant');
                Route::get('/active', 'active')->name('active');
            });

        // 📊 Analytics (Protected)
        Route::prefix('analytics')
            ->name('analytics.')
            ->controller(AnalyticsController::class)
            ->middleware('auth:sanctum')
            ->group(function () {
                Route::get('/restaurant/{restaurant_slug}', 'restaurantStats')->name('restaurant_stats');
                Route::get('/reservations', 'reservationStats')->name('reservation_stats');
                Route::get('/popular-dishes', 'popularDishes')->name('popular_dishes');
            });
    });
```

---

## 🗃️ Database Tables

### Core Tables
```sql
-- Users & Authorization
users
roles  
permissions
role_has_permissions
model_has_roles
model_has_permissions

-- Geographic Data
cities
city_translations

-- Business Categories
spots (რესტორნები, ბარები, კაფები, კლუბები)
spot_translations
spaces (რესტორნების ტიპები)
space_translations
cuisines (კულინარიული მიმართულებები)
cuisine_translations

-- Restaurant Hierarchy
restaurants
restaurant_translations
places (რესტორნის ადგილები/დარბაზები)
place_translations
tables (მაგიდები)
table_translations

-- Menu & Dishes
dishes
dish_translations
restaurant_dishes (რა კერძი რომელ რესტორანშია)

-- Reservations
reservations
reservation_statuses

-- Reviews & Events
reviews
events
event_translations

-- Promotions
promotions
promotion_translations
```

### Database Configuration
```json
{
  "connection": "mysql",
  "database": "foodly",
  "shared_with": "admin_dashboard_project",
  "access_level": "read_write"
}
```

---

## 🏗️ Models Structure

### Parent-Child Relationships
```
Restaurant (Parent)
  ├── Places (Children)
  │   └── Tables (Grandchildren)
  ├── Dishes (Children)
  ├── Events (Children)
  ├── Promotions (Children)
  └── Reviews (Children)
```

### Key Models

#### Restaurant Model
```json
{
  "fields": ["id", "slug", "name", "description", "address", "phone", "status"],
  "relationships": ["spaces", "cuisines", "places", "dishes", "events", "reviews"],
  "translatable": ["name", "description"]
}
```

#### Place Model  
```json
{
  "fields": ["id", "slug", "restaurant_id", "name", "capacity", "status"],
  "relationships": ["restaurant", "tables"],
  "translatable": ["name", "description"]
}
```

#### Table Model
```json
{
  "fields": ["id", "slug", "place_id", "name", "seats", "status"],
  "relationships": ["place", "reservations"],
  "translatable": ["name"]
}
```

#### Reservation Model
```json
{
  "fields": ["id", "user_id", "table_id", "date", "time", "guests", "status"],
  "relationships": ["user", "table", "place", "restaurant"],
  "fillable": ["user_id", "table_id", "date", "time", "guests", "status"]
}
```

---

## 🚀 Implementation Plan

### 1. ახალი Laravel Project
```bash
composer create-project laravel/laravel api.foodly
cd api.foodly
```

### 2. Dependencies Installation
```bash
composer require laravel/sanctum
composer require spatie/laravel-permission
composer require astrotomic/laravel-translatable
composer require cloudinary-labs/cloudinary-laravel
```

### 3. Database Configuration
```php
// .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foodly
DB_USERNAME=root
DB_PASSWORD=
```

### 4. File Copying Strategy
```bash
# Models (მხოლოდ API-related)
cp ../foodly_admin/app/Models/* ./app/Models/

# Controllers (API Resource Controllers)
mkdir app/Http/Controllers/Api
# Copy and modify controllers for API responses

# Resources (API Resource Classes)
php artisan make:resource RestaurantResource
php artisan make:resource PlaceResource
php artisan make:resource TableResource
# ... და ა.შ
```

### 5. Configuration Files
```bash
# Copy necessary config files
cp ../foodly_admin/config/translatable.php ./config/
cp ../foodly_admin/config/permission.php ./config/
# Modify as needed for API-only project
```

---

## 📱 Expected API Endpoints

### Public Endpoints
- `GET /api/restaurants` - ყველა რესტორანი
- `GET /api/restaurants/{slug}` - კონკრეტული რესტორანი
- `GET /api/restaurants/{slug}/places` - რესტორნის ადგილები
- `GET /api/restaurants/{slug}/menu` - რესტორნის მენიუ
- `GET /api/spaces` - ყველა space
- `GET /api/cuisines` - ყველა cuisine

### Protected Endpoints (auth:sanctum)
- `POST /api/reservations` - ახალი დაჯავშნა
- `GET /api/reservations` - მომხმარებლის დაჯავშნები
- `POST /api/reviews` - შეფასების დამატება
- `PUT /api/users/profile` - პროფილის განახლება

---

## 🔧 Technical Considerations

### Response Format
```json
{
  "success": true,
  "data": {...},
  "message": "Success message",
  "meta": {
    "pagination": {...}
  }
}
```

### Error Handling
```json
{
  "success": false,
  "message": "Error message",
  "errors": {...}
}
```

### Localization
- ქართული (ka)
- English (en)
- Using Translatable package

---

## 🎯 Next Steps

1. **Create New Laravel Project** - API only structure
2. **Database Connection** - Connect to existing `foodly` database  
3. **Copy Models** - Import existing models with API modifications
4. **Create API Controllers** - Resource controllers for each module
5. **Define Routes** - Based on the structure above
6. **API Resources** - JSON response formatting
7. **Authentication** - Sanctum setup for mobile apps
8. **Testing** - API endpoint testing

---

**📅 Estimated Timeline**: 2-3 weeks for complete API implementation
**👥 Team**: Laravel Backend Developer + Mobile App Developer
**🔄 Status**: Ready to start implementation
