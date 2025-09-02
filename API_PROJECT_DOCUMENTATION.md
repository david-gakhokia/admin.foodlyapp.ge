# API Project Documentation

## 📋 პროექტის მიმოხილვა

არსებული პროექტი საკმაოდ გაფართოვდა და შეიცავს როგორც Admin Dashboard ფუნქციონალობას, ასევე API endpoints-ებს. პროექტის უკეთესი ორგანიზაციისთვის და მართვისთვის, მოეწყობა ორ ცალკე პროექტად გაყოფა:

### 1. Admin Dashboard Project
ყველა არსებული მოდული მნარჩუნდება

### 2. API Project 
მხოლოდ API endpoints-ები და შემდეგი მოდულები:
- Users
- Permissions 
- Roles
- Restaurants
- Cuisines
- Dishes
- Spots
- Spaces
- Cities

---

## 🎯 API პროექტის სტრუქტურა

### Models (შენარჩუნებული)
```
app/Models/
├── User.php
├── Role.php
├── Permission.php
├── Restaurant.php
├── Cuisine.php
├── Dish.php
├── Spot.php
├── Space.php
├── City.php
└── Translations/
    ├── RestaurantTranslation.php
    ├── CuisineTranslation.php
    ├── DishTranslation.php
    ├── SpotTranslation.php
    ├── SpaceTranslation.php
    └── CityTranslation.php
```

### Controllers (API მხოლოდ)
```
app/Http/Controllers/Api/
├── AuthController.php
├── UserController.php
├── RestaurantController.php
├── CuisineController.php
├── DishController.php
├── SpotController.php
├── SpaceController.php
├── CityController.php
├── CuisineRestaurantController.php
├── SpotRestaurantController.php
└── RestaurantCuisineController.php
```

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
└── CityResource.php
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

### Core API Routes
```php
Route::webapp()
    ->middleware([SetLocale::class])
    ->group(function () {

        // 🗂 Spaces
        Route::prefix('spaces')
            ->name('spaces.')
            ->controller(SpaceController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsBySpace')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsBySpace')->name('top');
            });

        // 🍽 Cuisines
        Route::prefix('cuisines')
            ->name('cuisines.')
            ->controller(CuisineController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsByCuisine')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByCuisine')->name('top');
            });

        // 🏙 Cities
        Route::prefix('cities')
            ->name('cities.')
            ->controller(CityController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsByCity')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByCity')->name('top');
            });

        // 🏡 Restaurants
        Route::prefix('restaurants')
            ->name('restaurants.')
            ->controller(RestaurantController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/places', 'places')->name('places');
                Route::get('/{slug}/menu', 'menu')->name('menu');
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

        // 📍 Spots
        Route::prefix('spots')
            ->name('spots.')
            ->controller(SpotController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsBySpot')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsBySpot')->name('top');
            });
    });
```

### Admin API Routes (CRUD Operations)
```php
Route::prefix('software')
    ->name('software.')
    ->middleware([SetLocale::class])
    ->group(function () {

        // Spaces Management
        Route::apiResource('spaces', SpaceController::class);
        
        // Cuisines Management  
        Route::apiResource('cuisines', CuisineController::class);
        
        // Cities Management
        Route::apiResource('cities', CityController::class);
        
        // Restaurants Management
        Route::apiResource('restaurants', RestaurantController::class);
        
        // Dishes Management
        Route::apiResource('dishes', DishController::class);
        
        // Spots Management
        Route::apiResource('spots', SpotController::class);
        
        // Users Management
        Route::apiResource('users', UserController::class);
        
        // Roles Management
        Route::apiResource('roles', RoleController::class);
        
        // Permissions Management
        Route::apiResource('permissions', PermissionController::class);
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

-- Business Data  
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
        }
    ],
    "links": {...},
    "meta": {...}
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
        "cuisines": [...],
        "dishes": [...],
        "spaces": [...],
        "spots": [...]
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
// Basic Permissions
'view_restaurants'
'create_restaurants'  
'edit_restaurants'
'delete_restaurants'

'view_cuisines'
'create_cuisines'
'edit_cuisines'
'delete_cuisines'

// Similar pattern for all modules
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
- Geographic filtering by city/region
- Category-based filtering
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
│   │   └── AuthApiTest.php
│   └── Unit/
└── TestCase.php
```

---

## 📋 Migration Plan

### Phase 1: API Project Setup
1. Create new Laravel project
2. Install required packages
3. Copy and adapt models
4. Setup database migrations
5. Configure authentication

### Phase 2: API Controllers & Routes  
1. Create API controllers
2. Setup API routes
3. Implement API resources
4. Add validation rules
5. Setup middleware

### Phase 3: Testing & Documentation
1. Write comprehensive tests
2. Create API documentation
3. Setup monitoring
4. Performance optimization

### Phase 4: Deployment
1. Setup production environment
2. Database migration
3. Deploy API project
4. Update client applications
5. Monitor and optimize

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
