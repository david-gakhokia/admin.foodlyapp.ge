# Android API Routes Structure 📱

## 📋 Overview
Android მობილური აპლიკაციისთვის API ენდპოინტების სრული სტრუქტურა Laravel Sanctum authentication-ით.

**Base URL:** `/api/android/`  
**Authentication:** Laravel Sanctum  
**Route File:** `routes/api/android.php`  
**Route Prefix:** `android`  
**Name Prefix:** `android.`

## 🔧 Configuration

### RouteServiceProvider Registration
```php
// app/Providers/RouteServiceProvider.php
Route::middleware('api')
    ->prefix('api')
    ->android()
    ->group(base_path('routes/api/android.php'));
```

### Controller Imports
```php
use App\Http\Controllers\Api\Android\AuthController;
use App\Http\Controllers\Api\Android\RestaurantController;
use App\Http\Controllers\Api\Android\CuisineController;
use App\Http\Controllers\Api\Android\SpaceController;
use App\Http\Controllers\Api\Android\RegionController;
use App\Http\Controllers\Api\Android\CityController;
use App\Http\Controllers\Api\Android\DishController;
use App\Http\Controllers\Api\Android\SpotController;
```

## 🔓 Public Routes (No Authentication Required)

### 📱 Authentication Endpoints
```
POST   /api/android/auth/phone/send-otp       # OTP გაგზავნა
POST   /api/android/auth/phone/verify-otp     # OTP ვერიფიკაცია
POST   /api/android/auth/refresh-token        # Token განახლება
```

**Controller:** `AuthController`  
**Methods:** `sendOtp()`, `verifyOtp()`, `refreshToken()`

## 🔐 Protected Routes (Require `auth:sanctum`)

### 👤 User Profile Management
```
GET    /api/android/auth/profile              # პროფილის ნახვა
PUT    /api/android/auth/profile              # პროფილის განახლება
DELETE /api/android/auth/logout               # გამოსვლა
```

**Controller:** `AuthController`  
**Methods:** `profile()`, `updateProfile()`, `logout()`

### 🏡 1) Restaurants Module

#### Basic Restaurant Endpoints
```
GET    /api/android/restaurants                        # ყველა რესტორანი
GET    /api/android/restaurants/{slug}                 # რესტორნის მონაცემები
GET    /api/android/restaurants/{slug}/details         # დეტალური ინფორმაცია
```

#### Places Functionality
```
GET    /api/android/restaurants/{slug}/places          # რესტორნის ადგილები
GET    /api/android/restaurants/{slug}/place/{place}   # კონკრეტული ადგილი
```

#### Tables in Places
```
GET    /api/android/restaurants/{slug}/place/{place}/tables                 # ადგილის მაგიდები
GET    /api/android/restaurants/{slug}/place/{place}/table/{table}          # კონკრეტული მაგიდა
```

#### Direct Tables Access
```
GET    /api/android/restaurants/{slug}/tables          # რესტორნის ყველა მაგიდა
GET    /api/android/restaurants/{slug}/table/{table}   # კონკრეტული მაგიდა
```

#### Menu System
```
GET    /api/android/restaurants/{slug}/menu                    # მენიუ
GET    /api/android/restaurants/{slug}/full-menu              # სრული მენიუ
GET    /api/android/restaurants/{slug}/menu/categories        # მენიუ კატეგორიები
GET    /api/android/restaurants/{slug}/menu/items             # მენიუ ელემენტები
```

**Controller:** `RestaurantController`  
**Methods:** `index()`, `show()`, `showDetails()`, `showByPlaces()`, `showByPlace()`, `showTablesInPlace()`, `showTableInPlace()`, `showByTables()`, `showTable()`, `showMenu()`, `showFullMenu()`, `menuCategories()`, `menuItems()`

### 🍽️ 2) Cuisines Module
```
GET    /api/android/cuisines                           # ყველა სამზარეულო
GET    /api/android/cuisines/{slug}                    # კონკრეტული სამზარეულო
GET    /api/android/cuisines/{slug}/restaurants        # სამზარეულოს რესტორნები
GET    /api/android/cuisines/{slug}/top-10-restaurants # TOP 10 რესტორანი
```

**Controller:** `CuisineController`  
**Methods:** `index()`, `showBySlug()`, `restaurantsByCuisine()`, `top10RestaurantsByCuisine()`

### 🏢 3) Spaces Module
```
GET    /api/android/spaces                             # ყველა სივრცე
GET    /api/android/spaces/{slug}                      # კონკრეტული სივრცე
GET    /api/android/spaces/{slug}/restaurants          # სივრცის რესტორნები
GET    /api/android/spaces/{slug}/top-10-restaurants   # TOP 10 რესტორანი
```

**Controller:** `SpaceController`  
**Methods:** `index()`, `showBySlug()`, `restaurantsBySpace()`, `top10RestaurantsBySpace()`

### 📍 4) Regions Module
```
GET    /api/android/regions                                    # ყველა რეგიონი
GET    /api/android/regions/{slug}                             # კონკრეტული რეგიონი
GET    /api/android/regions/{slug}/restaurants                 # რეგიონის რესტორნები
GET    /api/android/regions/{slug}/top-10-restaurants          # TOP 10 რესტორანი
GET    /api/android/regions/{slug}/{categorySlug}/restaurants  # კატეგორიის მიხედვით
```

**Controller:** `RegionController`  
**Methods:** `index()`, `showBySlug()`, `restaurantsByRegion()`, `top10RestaurantsByRegion()`, `restaurantsByCategory()`

### 🏙️ 5) Cities Module
```
GET    /api/android/cities                             # ყველა ქალაქი
GET    /api/android/cities/{slug}                      # კონკრეტული ქალაქი
GET    /api/android/cities/{slug}/restaurants          # ქალაქის რესტორნები
GET    /api/android/cities/{slug}/top-10-restaurants   # TOP 10 რესტორანი
```

**Controller:** `CityController`  
**Methods:** `index()`, `showBySlug()`, `restaurantsByCity()`, `top10RestaurantsByCity()`

### 🍝 6) Dishes Module
```
GET    /api/android/dishes                                             # ყველა კერძი
GET    /api/android/dishes/{slug}                                      # კონკრეტული კერძი
GET    /api/android/dishes/{slug}/restaurants                          # კერძის რესტორნები
GET    /api/android/dishes/{slug}/top-10-restaurants                   # TOP 10 რესტორანი
GET    /api/android/dishes/{slug}/categories-items-restaurants         # სრული ინფორმაცია
GET    /api/android/dishes/{slug}/{categorySlug}                       # კატეგორიის მიხედვით
```

**Controller:** `DishController`  
**Methods:** `index()`, `showBySlug()`, `restaurantsByDish()`, `top10RestaurantsByDish()`, `categoriesItemsRestaurantsByDish()`, `restaurantsByCategory()`

### 📌 7) Spots Module
```
GET    /api/android/spots                              # ყველა ადგილი
GET    /api/android/spots/{slug}                       # კონკრეტული ადგილი
GET    /api/android/spots/{slug}/restaurants           # ადგილის რესტორნები
GET    /api/android/spots/{slug}/top-10-restaurants    # TOP 10 რესტორანი
```

**Controller:** `SpotController`  
**Methods:** `index()`, `showBySlug()`, `restaurantsBySpot()`, `top10RestaurantsBySpot()`

## 📱 Android-Specific Features

### 🔍 Search Functionality
```
GET    /api/android/search/restaurants         # რესტორნების ძიება
GET    /api/android/search/dishes              # კერძების ძიება
GET    /api/android/search/cuisines            # სამზარეულოების ძიება
GET    /api/android/search/global              # გლობალური ძიება
```

**Controllers:** `RestaurantController`, `DishController`, `CuisineController`  
**Methods:** `search()`, `globalSearch()`

### 📍 Location-Based Services
```
GET    /api/android/location/nearby-restaurants    # ახლოს მდებარე რესტორნები
POST   /api/android/location/update                # მდებარეობის განახლება
```

**Controllers:** `RestaurantController`, `AuthController`  
**Methods:** `nearbyRestaurants()`, `updateLocation()`

### ❤️ Favorites System
```
GET    /api/android/favorites                      # ფავორიტები
POST   /api/android/favorites/restaurants/{id}     # ფავორიტებში დამატება
DELETE /api/android/favorites/restaurants/{id}     # ფავორიტებიდან ამოშლა
```

**Controller:** `RestaurantController`  
**Methods:** `favorites()`, `addToFavorites()`, `removeFromFavorites()`

### 🔄 Sync for Offline Support
```
GET    /api/android/sync/restaurants           # რესტორნების სინქრონიზაცია
GET    /api/android/sync/cuisines              # სამზარეულოების სინქრონიზაცია
GET    /api/android/sync/spaces                # სივრცეების სინქრონიზაცია
GET    /api/android/sync/regions               # რეგიონების სინქრონიზაცია
GET    /api/android/sync/cities                # ქალაქების სინქრონიზაცია
GET    /api/android/sync/dishes                # კერძების სინქრონიზაცია
GET    /api/android/sync/spots                 # ადგილების სინქრონიზაცია
```

**All Controllers**  
**Method:** `syncData()`

### 📊 System Endpoints
```
GET    /api/android/health                     # სისტემის სტატუსი
GET    /api/android/config                     # აპლიკაციის კონფიგურაცია
```

**Response Format:**
```json
{
    "status": "ok",
    "platform": "android", 
    "timestamp": "2025-08-16T10:30:00Z"
}
```

**Controller:** `AuthController`  
**Method:** `appConfig()`

## 🎛️ Controllers Structure

```
app/Http/Controllers/Api/Android/
├── AuthController.php              # Authentication & User Profile
├── RestaurantController.php        # Restaurants, Places, Tables, Menu
├── CuisineController.php           # Cuisines Management
├── SpaceController.php             # Spaces Management
├── RegionController.php            # Regions Management
├── CityController.php              # Cities Management
├── DishController.php              # Dishes Management
└── SpotController.php              # Spots Management
```

## 📝 Required Controller Methods Summary

### AuthController
```php
// Public methods
public function sendOtp(Request $request)
public function verifyOtp(Request $request) 
public function refreshToken(Request $request)

// Protected methods
public function profile(Request $request)
public function updateProfile(Request $request)
public function logout(Request $request)
public function updateLocation(Request $request)
public function appConfig(Request $request)
```

### RestaurantController
```php
// Basic CRUD
public function index(Request $request)
public function show(Request $request, $slug)
public function showDetails(Request $request, $slug)

// Places & Tables
public function showByPlaces(Request $request, $slug)
public function showByPlace(Request $request, $slug, $place)
public function showTablesInPlace(Request $request, $slug, $place)
public function showTableInPlace(Request $request, $slug, $place, $table)
public function showByTables(Request $request, $slug)
public function showTable(Request $request, $slug, $table)

// Menu
public function showMenu(Request $request, $slug)
public function showFullMenu(Request $request, $slug)
public function menuCategories(Request $request, $slug)
public function menuItems(Request $request, $slug)

// Features
public function search(Request $request)
public function globalSearch(Request $request)
public function nearbyRestaurants(Request $request)
public function favorites(Request $request)
public function addToFavorites(Request $request, $id)
public function removeFromFavorites(Request $request, $id)
public function syncData(Request $request)
```

### Pattern for Other Controllers (Cuisine, Space, Region, City, Dish, Spot)
```php
public function index(Request $request)
public function showBySlug(Request $request, $slug)
public function restaurantsByX(Request $request, $slug)
public function top10RestaurantsByX(Request $request, $slug)
public function search(Request $request) // for applicable controllers
public function syncData(Request $request)
```

## 🚀 Implementation Steps

1. **Create Controller Directory Structure**
   ```bash
   mkdir -p app/Http/Controllers/Api/Android
   ```

2. **Generate Controllers**
   ```bash
   php artisan make:controller Api/Android/AuthController
   php artisan make:controller Api/Android/RestaurantController
   php artisan make:controller Api/Android/CuisineController
   php artisan make:controller Api/Android/SpaceController
   php artisan make:controller Api/Android/RegionController
   php artisan make:controller Api/Android/CityController
   php artisan make:controller Api/Android/DishController
   php artisan make:controller Api/Android/SpotController
   ```

3. **Create Resources (Optional)**
   ```bash
   mkdir -p app/Http/Resources/Android
   php artisan make:resource Android/RestaurantResource
   php artisan make:resource Android/CuisineResource
   # ... etc
   ```

4. **Test Routes**
   ```bash
   php artisan route:list --name=android
   ```

## 🔧 Middleware & Security

- **Authentication:** `auth:sanctum` for all protected routes
- **Rate Limiting:** Consider adding Android-specific throttling
- **CORS:** Configure for mobile app domains
- **API Versioning:** Built into route structure

## 📊 Performance Considerations

- **Pagination:** All list endpoints should support pagination
- **Eager Loading:** Optimize database queries with proper relationships
- **Caching:** Implement caching for frequently accessed data
- **Response Size:** Minimize payload for mobile bandwidth optimization
- **Image Optimization:** Serve WebP format for Android compatibility

---

**Status:** Routes structure complete ✅  
**Next Step:** Implement individual controllers starting with