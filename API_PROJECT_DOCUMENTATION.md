# API Project Documentation

## 📋 პროექტის მიმოხილვა

არსებული პროექტი შეიცავს როგორც Admin Dashboard ფუნქციონალობას, ასევე **მუშა Kiosk API** (`/api/kiosk/` პრეფიქსით). პროექტის უკეთესი ორგანიზაციისთვის და მართვისთვის, საჭიროა არსებული **Kiosk API სტრუქტურის** გამოტანა ცალკე პროექტად:

### 1. Admin Dashboard Project (არსებული)
ყველა არსებული ვებ ფუნქციონალობა რჩება

### 2. API Project (ახალი - Kiosk API-დან გამოტანილი)
არსებული `/api/kiosk/` endpoints-ები გადმოვიტანოთ `/api/` პრეფიქსით:

**არსებული Kiosk API სტრუქტურა:**
- ✅ `GET /api/kiosk/restaurants` → `GET /api/restaurants`
- ✅ `GET /api/kiosk/restaurants/{slug}` → `GET /api/restaurants/{slug}`
- ✅ `GET /api/kiosk/restaurants/{slug}/details` → `GET /api/restaurants/{slug}/details`
- ✅ `GET /api/kiosk/restaurants/{slug}/places` → `GET /api/restaurants/{slug}/places`
- ✅ `GET /api/kiosk/restaurants/{slug}/tables` → `GET /api/restaurants/{slug}/tables`
- ✅ Menu System, Spaces, Cuisines, Dishes, Spots ხელმისაწვდომია

---

## 🎯 API პროექტის სტრუქტურა

### Models (არსებულიდან გადმოტანილი)
```
app/Models/
├── User.php (არსებული)
├── Role.php (არსებული)
├── Permission.php (არსებული)
├── Restaurant.php (არსებული)
├── Cuisine.php (არსებული)
├── Dish.php (არსებული)
├── Spot.php (არსებული)
├── Space.php (არსებული)
├── City.php (არსებული)
├── Place.php (არსებული)
├── Table.php (არსებული)
├── Reservation.php (არსებული)
└── Translations/ (არსებული translations)
    ├── RestaurantTranslation.php
    ├── CuisineTranslation.php
    ├── DishTranslation.php
    ├── SpotTranslation.php
    ├── SpaceTranslation.php
    ├── CityTranslation.php
    ├── PlaceTranslation.php
    └── TableTranslation.php
```

### Controllers (Kiosk API-დან გამოტანილი)
```
app/Http/Controllers/Api/
├── AuthController.php (ახალი - Sanctum authentication)
├── RestaurantController.php (KioskController-ის restaurant methods)
├── MenuController.php (KioskController-ის menu methods)
├── SpaceController.php (KioskController-ის space methods)
├── CuisineController.php (KioskController-ის cuisine methods)
├── DishController.php (KioskController-ის dish methods)
├── SpotController.php (KioskController-ის spot methods)
├── PlaceController.php (KioskController-ის place methods)
├── TableController.php (KioskController-ის table methods)
├── CategoryController.php (KioskController-ის category methods)
└── ReservationController.php (ახალი - reservation system)
```

**არსებული Kiosk API methods:**
- `getAllRestaurants()` → RestaurantController@index
- `getRestaurantBySlug()` → RestaurantController@show  
- `getRestaurantDetails()` → RestaurantController@details
- `getRestaurantPlaces()` → RestaurantController@places
- `getRestaurantTables()` → RestaurantController@tables
- Menu System methods → MenuController
- და სხვა არსებული methods

### Resources (API Response Resources)
```
app/Http/Resources/
├── UserResource.php
├── RestaurantResource.php
├── RestaurantShortResource.php
├── CuisineResource.php
├── DishResource.php
├── SpotResource.php
├── SpaceResource.php
├── CityResource.php
├── PlaceResource.php
├── TableResource.php
└── ReservationResource.php
```

---

## 🛣️ API Routes Structure

### Authentication Routes
```php
// Basic Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
```

### Core API Routes (Kiosk API-დან გამოტანილი)
```php
Route::middleware([SetLocale::class])
    ->group(function () {

        // � Restaurants (არსებული Kiosk API)
        Route::prefix('restaurants')
            ->name('restaurants.')
            ->controller(RestaurantController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index'); // /api/kiosk/restaurants
                Route::get('/{slug}', 'show')->name('show'); // /api/kiosk/restaurants/{slug}
                Route::get('/{slug}/details', 'details')->name('details'); // /api/kiosk/restaurants/{slug}/details
                Route::get('/{slug}/places', 'places')->name('places'); // /api/kiosk/restaurants/{slug}/places
                Route::get('/{slug}/tables', 'tables')->name('tables'); // /api/kiosk/restaurants/{slug}/tables
                Route::get('/{slug}/table/{table}', 'getSpecificTable')->name('specific_table');
                Route::get('/{restaurant_slug}/place/{place_slug}/tables', 'getPlaceTables')->name('place_tables');
            });

        // 🗂 Spaces (არსებული Kiosk API)
        Route::prefix('spaces')
            ->name('spaces.')
            ->controller(SpaceController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'show')->name('show');
            });

        // 🍽 Cuisines (არსებული Kiosk API)
        Route::prefix('cuisines')
            ->name('cuisines.')
            ->controller(CuisineController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'show')->name('show');
            });

        // � Cuisines
        Route::prefix('cuisines')
            ->name('cuisines.')
            ->controller(CuisineController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsByCuisine')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByCuisine')->name('top');
            });

        // 🏡 Restaurants (Parent Level)
        Route::prefix('restaurants')
            ->name('restaurants.')
            ->controller(RestaurantController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/places', 'places')->name('places');
                Route::get('/{slug}/menu', 'menu')->name('menu');
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
    tables
      table_translations
      reservations (supports restaurant_id, place_id, table_id levels)

-- Menu Data
dishes
dish_translations

-- Relationship Tables
cuisine_restaurant
dish_restaurant
spot_restaurant
space_restaurant
```

---

## 📦 Required Packages

```json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0",
        "laravel/sanctum": "^4.1",
        "spatie/laravel-permission": "^6.17",
        "spatie/laravel-sluggable": "^3.7",
        "astrotomic/laravel-translatable": "^11.16",
        "cloudinary-labs/cloudinary-laravel": "^3.0"
    }
}
```

---

## 🔧 Configuration Files

### API-specific configs needed:
```
config/
├── app.php
├── auth.php
├── database.php
├── sanctum.php
├── translatable.php
├── permission.php
├── cloudinary.php
└── cors.php
```

---

## 📚 API Response Examples

### Restaurant List Response
```json
{
    "data": [
        {
            "id": 1,
            "name": "Restaurant Name",
            "slug": "restaurant-name",
            "description": "Restaurant description",
            "address": "Address",
            "phone": "+995...",
            "email": "email@restaurant.com",
            "image": "https://cloudinary.../image.jpg",
            "rating": 4.5,
            "status": "active",
            "cuisines": [
                {
                    "id": 1,
                    "name": "Georgian",
                    "slug": "georgian"
                }
            ],
            "city": {
                "id": 1,
                "name": "Tbilisi",
                "slug": "tbilisi"
            }
            "places": [
                {
                    "id": 1,
                    "name": "Main Hall",
                    "slug": "main-hall"
                }
            ],
            "tables": [
                {
                    "id": 1,
                    "name": "Table 1",
                    "slug": "table-1",
                    "capacity": 4
                }
            ]
}
```

### Single Restaurant Response
```json
{
    "data": {
        "id": 1,
        "name": "Restaurant Name",
        "slug": "restaurant-name",
        "description": "Detailed description",
        "address": "Full address",
        "phone": "+995...",
        "email": "email@restaurant.com",
        "website": "https://restaurant.com",
        "image": "https://cloudinary.../image.jpg",
        "gallery": [
            "https://cloudinary.../gallery1.jpg",
            "https://cloudinary.../gallery2.jpg"
        ],
        "rating": 4.5,
        "price_range": "$$",
        "working_hours": {
            "monday": "10:00-23:00",
            "tuesday": "10:00-23:00"
        },
        "coordinates": {
            "latitude": 41.7151,
            "longitude": 44.8271
        },
        "places": [...],
        "tables": [...],
        "reservation_availability": {
            "restaurant_level": {
                "today": "available",
                "next_available": "2025-09-03 19:00:00"
            },
            "place_level": {
                "main_hall": "available",
                "terrace": "busy"
            },
            "table_level": {
                "available_tables": 15,
                "total_tables": 25
            }
        }
    }
}
```

### Reservation Response
```json
{
    "data": {
        "id": 1,
        "reservation_type": "table", 
        "restaurant": {
            "id": 1,
            "name": "Restaurant Name",
            "slug": "restaurant-name"
        },
        "place": {
            "id": 1,
            "name": "Main Hall",
            "slug": "main-hall"
        },
        "table": {
            "id": 1,
            "name": "Table 5",
            "slug": "table-5",
            "capacity": 4
        },
        "customer_name": "John Doe",
        "customer_phone": "+995...",
        "customer_email": "john@example.com",
        "guests_count": 4,
        "reservation_date": "2025-09-03",
        "reservation_time": "19:00:00",
        "duration_minutes": 120,
        "status": "confirmed",
        "special_requests": "Birthday celebration",
        "created_at": "2025-09-02T10:30:00Z"
    }
}
```

---

## 🔐 Security & Authentication

### API Authentication
- Laravel Sanctum for API token authentication
- Role-based access control using Spatie Laravel Permission
- Rate limiting on API routes

### Permissions Structure
```php
// Geographic Permissions
'view_cities'
'create_cities'
'edit_cities'
'delete_cities'

// Business Category Permissions
'view_spots'        // ბიზნეს ტიპები
'create_spots'
'edit_spots'
'delete_spots'

'view_spaces'       // რესტორნების ტიპები
'create_spaces'
'edit_spaces'
'delete_spaces'

'view_cuisines'     // კულინარიული მიმართულებები
'create_cuisines'
'edit_cuisines'
'delete_cuisines'

// Restaurant Management Permissions
'view_restaurants'
'create_restaurants'  
'edit_restaurants'
'delete_restaurants'

'view_dishes'
'create_dishes'
'edit_dishes'
'delete_dishes'

'view_places'       // რესტორნის ადგილები
'create_places'
'edit_places'
'delete_places'

'view_tables'
'create_tables'
'edit_tables'
'delete_tables'

'view_reservations'
'create_reservations'
'edit_reservations'
'delete_reservations'
```

### Roles Structure
```php
'super_admin'   // Full access
'admin'         // Most operations
'manager'       // Limited operations
'api_user'      // Read-only API access
```

---

## 🌍 Localization

### Supported Languages
- Georgian (ka)
- English (en)

### Translation Implementation
- Using `astrotomic/laravel-translatable` package
- Separate translation tables for each translatable model
- Automatic locale detection from API requests

---

## 📊 API Features

### Search & Filtering
- Full-text search across restaurants, dishes, cuisines
- Geographic filtering by cities
- Business type filtering (რესტორნები, ბარები, კაფები, კლუბები)
- Restaurant category filtering by spaces
- Cuisine-based filtering
- Price range filtering
- Rating-based filtering

### Pagination
- Standard Laravel pagination
- Configurable per-page limits
- Cursor-based pagination for large datasets

### Caching
- Redis caching for frequently accessed data
- Cache invalidation on data updates
- API response caching

### File Management
- Cloudinary integration for image management
- Automatic image optimization
- Multiple image formats support

---

## 🚀 Deployment Considerations

### Environment Variables
```env
APP_NAME="Foodly API"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://api.foodlyapp.ge

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foodly_api
DB_USERNAME=foodly_user
DB_PASSWORD=secure_password

SANCTUM_STATEFUL_DOMAINS=foodlyapp.ge,www.foodlyapp.ge
SESSION_DOMAIN=.foodlyapp.ge

CLOUDINARY_URL=cloudinary://...
```

### Production Optimizations
- Route caching
- Config caching  
- View caching
- Database query optimization
- API response caching
- CDN integration

---

## 📈 Monitoring & Analytics

### Metrics to Track
- API response times
- Request volume by endpoint
- Error rates
- Authentication success/failure rates
- Most accessed resources

### Logging
- Structured logging for API requests
- Error tracking and alerting
- Performance monitoring

---

## 🧪 Testing Strategy

### API Testing
- Feature tests for all endpoints
- Authentication testing
- Permission testing
- Validation testing
- Performance testing

### Test Structure
```
tests/
├── Feature/
│   ├── Api/
│   │   ├── RestaurantApiTest.php
│   │   ├── CuisineApiTest.php
│   │   ├── PlaceApiTest.php
│   │   ├── TableApiTest.php
│   │   ├── ReservationApiTest.php
│   │   └── AuthApiTest.php
│   └── Unit/
└── TestCase.php
```

---

## 📋 Migration Plan (Kiosk API-დან გამოტანა)

### Phase 1: API Project Setup
1. **Create new Laravel project** for API
2. **Install required packages** (Sanctum, Spatie, Translatable, etc.)
3. **Copy existing models** from current project (unchanged)
4. **Copy existing migrations** and run them (unchanged database structure)
5. **Configure Sanctum** for API authentication

### Phase 2: Extract Kiosk API Logic  
1. **Extract KioskController methods:**
   - `getAllRestaurants()` → `RestaurantController@index`
   - `getRestaurantBySlug()` → `RestaurantController@show`
   - `getRestaurantDetails()` → `RestaurantController@details`
   - `getRestaurantPlaces()` → `RestaurantController@places`
   - `getRestaurantTables()` → `RestaurantController@tables`
   - Menu System methods → `MenuController`
   - Space, Cuisine, Dish, Spot methods → respective controllers

2. **Update route prefixes:** `/api/kiosk/` → `/api/`
3. **Copy existing API resources** (unchanged)
4. **Copy existing validation rules** (unchanged)
5. **Setup clean API middleware**

### Phase 3: Database & Testing
1. **Use same database** or copy existing database
2. **Test all extracted endpoints:**
   - GET /api/restaurants ✅
   - GET /api/restaurants/{slug} ✅
   - GET /api/restaurants/{slug}/details ✅
   - GET /api/restaurants/{slug}/places ✅
   - GET /api/restaurants/{slug}/tables ✅
   - All Menu System endpoints ✅
3. **Add reservation endpoints** (new functionality)

### Phase 4: Deployment & Migration
1. **Setup production environment** for API project
2. **Deploy API project** with `/api/` prefix
3. **Update mobile applications** to use new API URL
4. **Monitor performance** and optimize
5. **Optional:** Remove `/api/kiosk/` routes from original project

### Phase 5: Enhancements
1. **Add reservation system** (3-level: Restaurant/Place/Table)
2. **Add authentication endpoints** for mobile apps
3. **Add push notifications** support
4. **Optimize for mobile performance**

---

## 📞 Support Information

### Development Team Contacts
- Lead Developer: [Email]
- DevOps Engineer: [Email]
- QA Engineer: [Email]

### Documentation Updates
This documentation should be updated with each major release and maintained in the project repository.

---

## 🔄 Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0.0   | 2025-01-01 | Initial API project documentation |

---

*ეს დოკუმენტაცია შექმნილია API პროექტის ახალი სტრუქტურისთვის და უნდა განახლდეს ყოველი მნიშვნელოვანი ცვლილების შემდეგ.*
