# API Routes Documentation

## 🛣️ Complete API Routes Structure for New API Project

### Core API Endpoints for 12 Modules

---

## 🔐 Authentication Routes

### Public Authentication
```php
// Basic Auth Routes
POST   /api/login           // User login with email/password
POST   /api/register        // User registration
POST   /api/forgot-password // Password reset request
POST   /api/reset-password  // Password reset with token

// Phone Verification (if needed)
POST   /api/phone/send-otp  // Send OTP to phone number
POST   /api/phone/verify-otp // Verify OTP code
```

### Protected Authentication
```php
// Require auth:sanctum middleware
GET    /api/user            // Get current user info
POST   /api/logout          // Logout user
PUT    /api/user/profile    // Update user profile
PUT    /api/user/password   // Change user password
```

---

## 👥 Users API Routes

### Public Routes
```php
// No public user routes for security
```

### Protected Routes (Admin Only)
```php
// Users CRUD - require 'manage users' permission
GET    /api/admin/users              // List all users (paginated)
GET    /api/admin/users/{id}         // Show specific user
POST   /api/admin/users              // Create new user
PUT    /api/admin/users/{id}         // Update user
DELETE /api/admin/users/{id}         // Delete user

// User Role Management
GET    /api/admin/users/{id}/roles   // Get user roles
POST   /api/admin/users/{id}/roles   // Assign roles to user
DELETE /api/admin/users/{id}/roles/{role} // Remove role from user
```

---

## 🔑 Roles & Permissions API Routes

### Protected Routes (Super Admin Only)
```php
// Roles CRUD
GET    /api/admin/roles              // List all roles
GET    /api/admin/roles/{id}         // Show specific role
POST   /api/admin/roles              // Create new role
PUT    /api/admin/roles/{id}         // Update role
DELETE /api/admin/roles/{id}         // Delete role

// Permissions CRUD
GET    /api/admin/permissions        // List all permissions
GET    /api/admin/permissions/{id}   // Show specific permission
POST   /api/admin/permissions        // Create new permission
PUT    /api/admin/permissions/{id}   // Update permission
DELETE /api/admin/permissions/{id}   // Delete permission

// Role-Permission Management
GET    /api/admin/roles/{id}/permissions    // Get role permissions
POST   /api/admin/roles/{id}/permissions    // Assign permissions to role
DELETE /api/admin/roles/{id}/permissions/{permission} // Remove permission from role
```

---

## 🏨 Restaurants API Routes

### Public Routes
```php
// Restaurant Listing & Details
GET    /api/restaurants              // List restaurants (paginated, filterable)
GET    /api/restaurants/{slug}       // Show restaurant by slug
GET    /api/restaurants/featured     // Featured restaurants
GET    /api/restaurants/search       // Search restaurants

// Restaurant Relationships
GET    /api/restaurants/{slug}/cuisines    // Restaurant's cuisines
GET    /api/restaurants/{slug}/dishes      // Restaurant's dishes
GET    /api/restaurants/{slug}/spots       // Restaurant's spots
GET    /api/restaurants/{slug}/spaces      // Restaurant's spaces

// Geographic Filtering
GET    /api/restaurants/by-city/{citySlug}         // Restaurants by city
GET    /api/restaurants/by-cuisine/{cuisineSlug}   // Restaurants by cuisine
GET    /api/restaurants/by-spot/{spotSlug}         // Restaurants by spot
GET    /api/restaurants/by-space/{spaceSlug}       // Restaurants by space
```

### Protected Routes (Admin)
```php
// Restaurant CRUD
GET    /api/admin/restaurants        // List all restaurants
GET    /api/admin/restaurants/{id}   // Show restaurant by ID
POST   /api/admin/restaurants        // Create new restaurant
PUT    /api/admin/restaurants/{id}   // Update restaurant
DELETE /api/admin/restaurants/{id}   // Delete restaurant

// Restaurant Image Management
POST   /api/admin/restaurants/{id}/images    // Upload restaurant images
DELETE /api/admin/restaurants/{id}/images/{imageId} // Delete restaurant image

// Restaurant Relationship Management
POST   /api/admin/restaurants/{id}/cuisines  // Attach cuisine to restaurant
DELETE /api/admin/restaurants/{id}/cuisines/{cuisineId} // Detach cuisine
POST   /api/admin/restaurants/{id}/dishes    // Attach dish to restaurant
DELETE /api/admin/restaurants/{id}/dishes/{dishId} // Detach dish
POST   /api/admin/restaurants/{id}/spots     // Attach spot to restaurant
DELETE /api/admin/restaurants/{id}/spots/{spotId} // Detach spot
POST   /api/admin/restaurants/{id}/spaces    // Attach space to restaurant
DELETE /api/admin/restaurants/{id}/spaces/{spaceId} // Detach space
```

---

## 🍽️ Cuisines API Routes

### Public Routes
```php
// Cuisine Listing & Details
GET    /api/cuisines                 // List all cuisines
GET    /api/cuisines/{slug}          // Show cuisine by slug
GET    /api/cuisines/featured        // Featured cuisines

// Cuisine Relationships
GET    /api/cuisines/{slug}/restaurants     // Restaurants by cuisine
GET    /api/cuisines/{slug}/top-restaurants // Top 10 restaurants by cuisine
```

### Protected Routes (Admin)
```php
// Cuisine CRUD
GET    /api/admin/cuisines           // List all cuisines
GET    /api/admin/cuisines/{id}      // Show cuisine by ID
POST   /api/admin/cuisines           // Create new cuisine
PUT    /api/admin/cuisines/{id}      // Update cuisine
DELETE /api/admin/cuisines/{id}      // Delete cuisine

// Cuisine Image Management
POST   /api/admin/cuisines/{id}/image    // Upload cuisine image
DELETE /api/admin/cuisines/{id}/image    // Delete cuisine image
```

---

## 🍜 Dishes API Routes

### Public Routes
```php
// Dish Listing & Details
GET    /api/dishes                   // List all dishes
GET    /api/dishes/{slug}            // Show dish by slug
GET    /api/dishes/featured          // Featured dishes
GET    /api/dishes/search            // Search dishes

// Dish Relationships
GET    /api/dishes/{slug}/restaurants      // Restaurants serving this dish
GET    /api/dishes/{slug}/top-restaurants  // Top 10 restaurants for this dish
```

### Protected Routes (Admin)
```php
// Dish CRUD
GET    /api/admin/dishes             // List all dishes
GET    /api/admin/dishes/{id}        // Show dish by ID
POST   /api/admin/dishes             // Create new dish
PUT    /api/admin/dishes/{id}        // Update dish
DELETE /api/admin/dishes/{id}        // Delete dish

// Dish Image Management
POST   /api/admin/dishes/{id}/image       // Upload dish image
DELETE /api/admin/dishes/{id}/image       // Delete dish image
```

---

## 📍 Spots API Routes

### Public Routes
```php
// Spot Listing & Details
GET    /api/spots                    // List all spots
GET    /api/spots/{slug}             // Show spot by slug
GET    /api/spots/featured           // Featured spots

// Spot Relationships
GET    /api/spots/{slug}/restaurants      // Restaurants in this spot
GET    /api/spots/{slug}/top-restaurants  // Top 10 restaurants in this spot
```

### Protected Routes (Admin)
```php
// Spot CRUD
GET    /api/admin/spots              // List all spots
GET    /api/admin/spots/{id}         // Show spot by ID
POST   /api/admin/spots              // Create new spot
PUT    /api/admin/spots/{id}         // Update spot
DELETE /api/admin/spots/{id}         // Delete spot

// Spot Image Management
POST   /api/admin/spots/{id}/image        // Upload spot image
DELETE /api/admin/spots/{id}/image        // Delete spot image
```

---

## 🏢 Spaces API Routes

### Public Routes
```php
// Space Listing & Details
GET    /api/spaces                   // List all spaces
GET    /api/spaces/{slug}            // Show space by slug
GET    /api/spaces/featured          // Featured spaces

// Space Relationships
GET    /api/spaces/{slug}/restaurants     // Restaurants in this space
GET    /api/spaces/{slug}/top-restaurants // Top 10 restaurants in this space
```

### Protected Routes (Admin)
```php
// Space CRUD
GET    /api/admin/spaces             // List all spaces
GET    /api/admin/spaces/{id}        // Show space by ID
POST   /api/admin/spaces             // Create new space
PUT    /api/admin/spaces/{id}        // Update space
DELETE /api/admin/spaces/{id}        // Delete space

// Space Image Management
POST   /api/admin/spaces/{id}/image       // Upload space image
DELETE /api/admin/spaces/{id}/image       // Delete space image
```

---

## � Places API Routes

### Public Routes
```php
// Place Listing & Details
GET    /api/places                   // List all places
GET    /api/places/{slug}            // Show place by slug
GET    /api/places/by-restaurant/{restaurantSlug} // Places by restaurant

// Place Relationships
GET    /api/places/{slug}/tables          // Tables in this place
GET    /api/places/{slug}/availability    // Place availability
```

### Protected Routes (Admin)
```php
// Place CRUD
GET    /api/admin/places             // List all places
GET    /api/admin/places/{id}        // Show place by ID
POST   /api/admin/places             // Create new place
PUT    /api/admin/places/{id}        // Update place
DELETE /api/admin/places/{id}        // Delete place

// Place Image Management
POST   /api/admin/places/{id}/image       // Upload place image
DELETE /api/admin/places/{id}/image       // Delete place image
```

---

## 🪑 Tables API Routes

### Public Routes
```php
// Table Listing & Details
GET    /api/tables                   // List all tables
GET    /api/tables/{slug}            // Show table by slug
GET    /api/tables/by-restaurant/{restaurantSlug} // Tables by restaurant
GET    /api/tables/by-place/{placeSlug}           // Tables by place

// Table Availability
GET    /api/tables/{slug}/availability    // Table availability
```

### Protected Routes (Admin)
```php
// Table CRUD
GET    /api/admin/tables             // List all tables
GET    /api/admin/tables/{id}        // Show table by ID
POST   /api/admin/tables             // Create new table
PUT    /api/admin/tables/{id}        // Update table
DELETE /api/admin/tables/{id}        // Delete table

// Table QR Code Management
POST   /api/admin/tables/{id}/qr-code     // Generate QR code
DELETE /api/admin/tables/{id}/qr-code     // Delete QR code
```

---

## 📅 Reservations API Routes

### Public Routes
```php
// Reservation Creation
POST   /api/reservations             // Create new reservation
GET    /api/reservations/{code}      // Show reservation by code

// Availability Check
GET    /api/availability/restaurant/{slug}     // Restaurant availability
GET    /api/availability/place/{slug}          // Place availability  
GET    /api/availability/table/{slug}          // Table availability
```

### Protected Routes (Customer)
```php
// User's Reservations (require auth:sanctum)
GET    /api/my-reservations          // User's reservations
GET    /api/my-reservations/{id}     // Show user's reservation
PUT    /api/my-reservations/{id}     // Update user's reservation
DELETE /api/my-reservations/{id}     // Cancel user's reservation
```

### Protected Routes (Admin)
```php
// Reservation Management
GET    /api/admin/reservations       // List all reservations
GET    /api/admin/reservations/{id}  // Show reservation by ID
PUT    /api/admin/reservations/{id}  // Update reservation
DELETE /api/admin/reservations/{id}  // Delete reservation

// Reservation Status Management
PUT    /api/admin/reservations/{id}/status    // Update reservation status
POST   /api/admin/reservations/{id}/confirm   // Confirm reservation
POST   /api/admin/reservations/{id}/cancel    // Cancel reservation

// Reservation Reports
GET    /api/admin/reservations/reports        // Reservation statistics
GET    /api/admin/reservations/export         // Export reservations
```

---

## �🏙️ Cities API Routes

### Public Routes
```php
// City Listing & Details
GET    /api/cities                   // List all cities
GET    /api/cities/{slug}            // Show city by slug

// City Relationships
GET    /api/cities/{slug}/restaurants     // Restaurants in this city
GET    /api/cities/{slug}/top-restaurants // Top 10 restaurants in this city
```

### Protected Routes (Admin)
```php
// City CRUD
GET    /api/admin/cities             // List all cities
GET    /api/admin/cities/{id}        // Show city by ID
POST   /api/admin/cities             // Create new city
PUT    /api/admin/cities/{id}        // Update city
DELETE /api/admin/cities/{id}        // Delete city

// City Image Management
POST   /api/admin/cities/{id}/image       // Upload city image
DELETE /api/admin/cities/{id}/image       // Delete city image
```

---

## 🔍 Search & Filter Routes

### Universal Search
```php
// Global Search across all modules
GET    /api/search                   // Search across restaurants, cuisines, dishes, places, tables
GET    /api/search/restaurants       // Search only restaurants
GET    /api/search/cuisines          // Search only cuisines
GET    /api/search/dishes            // Search only dishes
GET    /api/search/places            // Search only places
GET    /api/search/tables            // Search only tables
GET    /api/search/reservations      // Search reservations (admin only)

// Filter Parameters for all search endpoints:
// ?q=search_term
// ?city=city_slug
// ?cuisine=cuisine_slug
// ?spot=spot_slug
// ?space=space_slug
// ?price_min=10
// ?price_max=100
// ?rating_min=4
// ?status=active
// ?sort=name|rating|created_at
// ?order=asc|desc
// ?per_page=15
// ?page=1
// ?locale=ka|en
```

---

## 📊 API Response Structure

### Standard Success Response
```json
{
    "success": true,
    "data": {
        // Resource data or collection
    },
    "message": "Success message",
    "meta": {
        // Pagination info for collections
        "current_page": 1,
        "per_page": 15,
        "total": 100,
        "last_page": 7
    },
    "links": {
        // Pagination links
        "first": "...",
        "last": "...",
        "prev": null,
        "next": "..."
    }
}
```

### Standard Error Response
```json
{
    "success": false,
    "message": "Error message",
    "errors": {
        "field_name": ["Validation error message"]
    },
    "code": 422
}
```

### Authentication Error Response
```json
{
    "success": false,
    "message": "Unauthenticated",
    "code": 401
}
```

### Authorization Error Response
```json
{
    "success": false,
    "message": "Insufficient permissions",
    "code": 403
}
```

---

## 🌍 Localization Support

### Language Parameter
All API endpoints support localization via:
```php
// Query parameter (preferred)
GET /api/restaurants?locale=ka
GET /api/restaurants?locale=en

// Header (alternative)
Accept-Language: ka, en
```

### Supported Locales
- `ka` - Georgian (default)
- `en` - English

---

## 🔒 Rate Limiting

### Rate Limits by Route Group
```php
// Public API routes
'throttle:60,1'     // 60 requests per minute

// Admin API routes  
'throttle:120,1'    // 120 requests per minute

// Authentication routes
'throttle:5,1'      // 5 requests per minute (login/register)

// Search routes
'throttle:30,1'     // 30 requests per minute
```

---

## 📱 API Versioning

### Version Strategy
```php
// Version 1 (current)
/api/v1/restaurants
/api/v1/cuisines

// Future versions
/api/v2/restaurants
/api/v2/cuisines

// Default version (no prefix = latest)
/api/restaurants    // Routes to latest version
```

---

## 🎯 API Middleware Stack

### Public Routes Middleware
```php
[
    'api',           // Laravel API middleware group
    'throttle:api',  // Rate limiting
    'localization',  // Set locale from request
    'cors'          // CORS headers
]
```

### Protected Routes Middleware
```php
[
    'auth:sanctum',  // Sanctum authentication
    'throttle:api',  // Rate limiting
    'localization',  // Set locale from request
    'cors'          // CORS headers
]
```

### Admin Routes Middleware
```php
[
    'auth:sanctum',     // Sanctum authentication
    'role:admin',       // Require admin role
    'throttle:admin',   // Higher rate limit
    'localization',     // Set locale from request
    'cors'             // CORS headers
]
```

---

## 📝 Complete routes/api.php File

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    UserController,
    RestaurantController,
    CuisineController,
    DishController,
    SpotController,
    SpaceController,
    CityController,
    SearchController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Authentication Routes
Route::prefix('auth')->middleware(['throttle:5,1'])->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

// Phone Verification
Route::prefix('phone')->middleware(['throttle:5,1'])->group(function () {
    Route::post('send-otp', [AuthController::class, 'sendOtp']);
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
});

// Protected Authentication Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::put('user/profile', [AuthController::class, 'updateProfile']);
    Route::put('user/password', [AuthController::class, 'updatePassword']);
});

// Public API Routes v1
Route::prefix('v1')->middleware(['throttle:60,1', 'localization'])->group(function () {
    
    // Restaurants
    Route::prefix('restaurants')->group(function () {
        Route::get('/', [RestaurantController::class, 'index']);
        Route::get('featured', [RestaurantController::class, 'featured']);
        Route::get('search', [RestaurantController::class, 'search']);
        Route::get('{slug}', [RestaurantController::class, 'showBySlug']);
        Route::get('{slug}/cuisines', [RestaurantController::class, 'cuisines']);
        Route::get('{slug}/dishes', [RestaurantController::class, 'dishes']);
        Route::get('{slug}/spots', [RestaurantController::class, 'spots']);
        Route::get('{slug}/spaces', [RestaurantController::class, 'spaces']);
        
        // Geographic filtering
        Route::get('by-city/{citySlug}', [RestaurantController::class, 'byCity']);
        Route::get('by-cuisine/{cuisineSlug}', [RestaurantController::class, 'byCuisine']);
        Route::get('by-spot/{spotSlug}', [RestaurantController::class, 'bySpot']);
        Route::get('by-space/{spaceSlug}', [RestaurantController::class, 'bySpace']);
    });
    
    // Cuisines
    Route::prefix('cuisines')->group(function () {
        Route::get('/', [CuisineController::class, 'index']);
        Route::get('featured', [CuisineController::class, 'featured']);
        Route::get('{slug}', [CuisineController::class, 'showBySlug']);
        Route::get('{slug}/restaurants', [CuisineController::class, 'restaurants']);
        Route::get('{slug}/top-restaurants', [CuisineController::class, 'topRestaurants']);
    });
    
    // Dishes
    Route::prefix('dishes')->group(function () {
        Route::get('/', [DishController::class, 'index']);
        Route::get('featured', [DishController::class, 'featured']);
        Route::get('search', [DishController::class, 'search']);
        Route::get('{slug}', [DishController::class, 'showBySlug']);
        Route::get('{slug}/restaurants', [DishController::class, 'restaurants']);
        Route::get('{slug}/top-restaurants', [DishController::class, 'topRestaurants']);
    });
    
    // Spots
    Route::prefix('spots')->group(function () {
        Route::get('/', [SpotController::class, 'index']);
        Route::get('featured', [SpotController::class, 'featured']);
        Route::get('{slug}', [SpotController::class, 'showBySlug']);
        Route::get('{slug}/restaurants', [SpotController::class, 'restaurants']);
        Route::get('{slug}/top-restaurants', [SpotController::class, 'topRestaurants']);
    });
    
    // Spaces
    Route::prefix('spaces')->group(function () {
        Route::get('/', [SpaceController::class, 'index']);
        Route::get('featured', [SpaceController::class, 'featured']);
        Route::get('{slug}', [SpaceController::class, 'showBySlug']);
        Route::get('{slug}/restaurants', [SpaceController::class, 'restaurants']);
        Route::get('{slug}/top-restaurants', [SpaceController::class, 'topRestaurants']);
    });
    
    // Cities
    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index']);
        Route::get('{slug}', [CityController::class, 'showBySlug']);
        Route::get('{slug}/restaurants', [CityController::class, 'restaurants']);
        Route::get('{slug}/top-restaurants', [CityController::class, 'topRestaurants']);
    });
    
    // Places
    Route::prefix('places')->group(function () {
        Route::get('/', [PlaceController::class, 'index']);
        Route::get('{slug}', [PlaceController::class, 'showBySlug']);
        Route::get('{slug}/tables', [PlaceController::class, 'tables']);
        Route::get('{slug}/availability', [PlaceController::class, 'availability']);
        Route::get('by-restaurant/{restaurantSlug}', [PlaceController::class, 'byRestaurant']);
    });
    
    // Tables
    Route::prefix('tables')->group(function () {
        Route::get('/', [TableController::class, 'index']);
        Route::get('{slug}', [TableController::class, 'showBySlug']);
        Route::get('{slug}/availability', [TableController::class, 'availability']);
        Route::get('by-restaurant/{restaurantSlug}', [TableController::class, 'byRestaurant']);
        Route::get('by-place/{placeSlug}', [TableController::class, 'byPlace']);
    });
    
    // Reservations (Public)
    Route::prefix('reservations')->group(function () {
        Route::post('/', [ReservationController::class, 'store']);
        Route::get('{code}', [ReservationController::class, 'showByCode']);
    });
    
    // Availability Check
    Route::prefix('availability')->group(function () {
        Route::get('restaurant/{slug}', [ReservationController::class, 'restaurantAvailability']);
        Route::get('place/{slug}', [ReservationController::class, 'placeAvailability']);
        Route::get('table/{slug}', [ReservationController::class, 'tableAvailability']);
    });
    
    // Search
    Route::prefix('search')->middleware(['throttle:30,1'])->group(function () {
        Route::get('/', [SearchController::class, 'global']);
        Route::get('restaurants', [SearchController::class, 'restaurants']);
        Route::get('cuisines', [SearchController::class, 'cuisines']);
        Route::get('dishes', [SearchController::class, 'dishes']);
        Route::get('places', [SearchController::class, 'places']);
        Route::get('tables', [SearchController::class, 'tables']);
    });
});

// Protected User Routes
Route::middleware('auth:sanctum')->group(function () {
    // User's Reservations
    Route::prefix('my-reservations')->group(function () {
        Route::get('/', [ReservationController::class, 'userReservations']);
        Route::get('{id}', [ReservationController::class, 'userReservation']);
        Route::put('{id}', [ReservationController::class, 'updateUserReservation']);
        Route::delete('{id}', [ReservationController::class, 'cancelUserReservation']);
    });
});

// Admin API Routes
Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin', 'throttle:120,1'])->group(function () {
    
    // Users Management
    Route::apiResource('users', UserController::class);
    Route::prefix('users/{user}')->group(function () {
        Route::get('roles', [UserController::class, 'roles']);
        Route::post('roles', [UserController::class, 'assignRoles']);
        Route::delete('roles/{role}', [UserController::class, 'removeRole']);
    });
    
    // Roles & Permissions (Super Admin only)
    Route::middleware('role:super_admin')->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);
        Route::prefix('roles/{role}')->group(function () {
            Route::get('permissions', [RoleController::class, 'permissions']);
            Route::post('permissions', [RoleController::class, 'assignPermissions']);
            Route::delete('permissions/{permission}', [RoleController::class, 'removePermission']);
        });
    });
    
    // Restaurants Management
    Route::apiResource('restaurants', RestaurantController::class);
    Route::prefix('restaurants/{restaurant}')->group(function () {
        Route::post('images', [RestaurantController::class, 'uploadImage']);
        Route::delete('images/{image}', [RestaurantController::class, 'deleteImage']);
        Route::post('cuisines', [RestaurantController::class, 'attachCuisine']);
        Route::delete('cuisines/{cuisine}', [RestaurantController::class, 'detachCuisine']);
        Route::post('dishes', [RestaurantController::class, 'attachDish']);
        Route::delete('dishes/{dish}', [RestaurantController::class, 'detachDish']);
        Route::post('spots', [RestaurantController::class, 'attachSpot']);
        Route::delete('spots/{spot}', [RestaurantController::class, 'detachSpot']);
        Route::post('spaces', [RestaurantController::class, 'attachSpace']);
        Route::delete('spaces/{space}', [RestaurantController::class, 'detachSpace']);
    });
    
    // Cuisines Management
    Route::apiResource('cuisines', CuisineController::class);
    Route::prefix('cuisines/{cuisine}')->group(function () {
        Route::post('image', [CuisineController::class, 'uploadImage']);
        Route::delete('image', [CuisineController::class, 'deleteImage']);
    });
    
    // Dishes Management
    Route::apiResource('dishes', DishController::class);
    Route::prefix('dishes/{dish}')->group(function () {
        Route::post('image', [DishController::class, 'uploadImage']);
        Route::delete('image', [DishController::class, 'deleteImage']);
    });
    
    // Spots Management
    Route::apiResource('spots', SpotController::class);
    Route::prefix('spots/{spot}')->group(function () {
        Route::post('image', [SpotController::class, 'uploadImage']);
        Route::delete('image', [SpotController::class, 'deleteImage']);
    });
    
    // Spaces Management
    Route::apiResource('spaces', SpaceController::class);
    Route::prefix('spaces/{space}')->group(function () {
        Route::post('image', [SpaceController::class, 'uploadImage']);
        Route::delete('image', [SpaceController::class, 'deleteImage']);
    });
    
    // Cities Management
    Route::apiResource('cities', CityController::class);
    Route::prefix('cities/{city}')->group(function () {
        Route::post('image', [CityController::class, 'uploadImage']);
        Route::delete('image', [CityController::class, 'deleteImage']);
    });
    
    // Places Management
    Route::apiResource('places', PlaceController::class);
    Route::prefix('places/{place}')->group(function () {
        Route::post('image', [PlaceController::class, 'uploadImage']);
        Route::delete('image', [PlaceController::class, 'deleteImage']);
    });
    
    // Tables Management
    Route::apiResource('tables', TableController::class);
    Route::prefix('tables/{table}')->group(function () {
        Route::post('qr-code', [TableController::class, 'generateQrCode']);
        Route::delete('qr-code', [TableController::class, 'deleteQrCode']);
    });
    
    // Reservations Management
    Route::apiResource('reservations', ReservationController::class);
    Route::prefix('reservations/{reservation}')->group(function () {
        Route::put('status', [ReservationController::class, 'updateStatus']);
        Route::post('confirm', [ReservationController::class, 'confirm']);
        Route::post('cancel', [ReservationController::class, 'cancel']);
    });
    
    // Reservation Reports
    Route::prefix('reservations')->group(function () {
        Route::get('reports', [ReservationController::class, 'reports']);
        Route::get('export', [ReservationController::class, 'export']);
    });
});

// Default routes (latest version)
Route::middleware(['throttle:60,1', 'localization'])->group(function () {
    Route::get('restaurants', [RestaurantController::class, 'index']);
    Route::get('cuisines', [CuisineController::class, 'index']);
    Route::get('dishes', [DishController::class, 'index']);
    Route::get('spots', [SpotController::class, 'index']);
    Route::get('spaces', [SpaceController::class, 'index']);
    Route::get('cities', [CityController::class, 'index']);
    Route::get('places', [PlaceController::class, 'index']);
    Route::get('tables', [TableController::class, 'index']);
});
```

---

*ეს დოკუმენტი მოიცავს API პროექტისთვის ყველა საჭირო route-ს, რომელიც უზრუნველყოფს 12 ძირითადი მოდულის სრულ ფუნქციონალობას.*
