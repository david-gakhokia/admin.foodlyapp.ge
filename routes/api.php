<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CuisineController;
use App\Http\Controllers\Api\CuisineRestaurantController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\RestaurantCuisineController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Api\PhoneVerificationController;

use App\Http\Middleware\SetLocale;
// Kiosk Controllers
use App\Http\Controllers\Kiosk\KioskAuthController;
use App\Http\Controllers\Kiosk\KioskRestaurantController;
use App\Http\Controllers\Kiosk\KioskReservationController;
use App\Http\Controllers\Kiosk\KioskSpaceController;
use App\Http\Controllers\Kiosk\KioskCuisineController;
use App\Http\Controllers\Kiosk\KioskDishController;
use App\Http\Controllers\Api\DishRestaurantApiController;
use App\Http\Controllers\Kiosk\KioskCategoryController;
use App\Http\Controllers\Kiosk\KioskSpotController;
use App\Http\Controllers\Kiosk\BookingFormController;
use App\Http\Controllers\Kiosk\BookingController;

// Admin Controllers
use App\Http\Controllers\Admin\PlaceController;

// Route::get('baro', function () {
//     return response()->json(['message' => 'Baro Baro!']);
// })->name('baro');


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);



use App\Http\Controllers\PhotoController;

Route::post('/photos', [PhotoController::class, 'store']);
Route::get('/photos', [PhotoController::class, 'index']);


Route::prefix('phone')->group(function () {
    Route::post('/send-otp', [PhoneVerificationController::class, 'send']);
    Route::post('/verify-otp', [PhoneVerificationController::class, 'verify']);
});



// 🌐 WebApp API
Route::webapp()
    ->middleware([SetLocale::class])
    ->group(function () {

        // Spaces 
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

        // 📍 Regions
        Route::prefix('regions')
            ->name('regions.')
            ->controller(RegionController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsByRegion')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByRegion')->name('top');
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
                Route::get('/', 'index')->name('index'); // ყველა რესტორანი
                Route::get('/{slug}', 'show')->name('show'); // კონკრეტული რესტორანი slug-ის მიხედვით
                Route::get('/{slug}/places', 'showByPlaces')->name('places'); // ადგილები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/tables', 'showByTables')->name('tables'); // მაგიდები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/details', 'showDetails')->name('details'); // დეტალები კონკრეტული რესტორნისთვის
                // Route::get('/{slug}/menu', 'menu')->name('menu'); // მენიუ კონკრეტული რესტორნისთვის
                // Route::get('/{slug}/impressions', 'impressions')->name('impressions'); // რესტორნის შთაბეჭდილებები
            });
    });


// 🛠 Admin API
Route::prefix('software')
    ->name('software.')
    // ->middleware(['auth:admin', SetLocale::class]) 
    ->middleware([SetLocale::class]) // დაამატე შენი admin auth ლოგიკა
    ->group(function () {

        // 🗂 Spaces Management (Admin CRUD)
        Route::prefix('spaces')
            ->name('spaces.')
            ->controller(SpaceController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');              // List spaces
                Route::get('/{slug}', 'showBySlug')->name('show');    // Show space by slug
                Route::post('/', 'store')->name('store');             // Create new space
                Route::put('/{id}', 'update')->name('update');        // Update space
                Route::delete('/{id}', 'destroy')->name('destroy');   // Delete space
            });

        // 🗂 cuisines Management (Admin CRUD)
        Route::prefix('cuisines')
            ->name('cuisines.')
            ->controller(CuisineRestaurantController::class)
            ->group(function () {
                Route::post('{cuisine}/restaurants', 'attach')->name('restaurants.attach');
                Route::put('{cuisine}/restaurants/{restaurant}', 'updatePivot')->name('restaurants.update');
                Route::delete('{cuisine}/restaurants/{restaurant}', 'detach')->name('restaurants.detach');
            });

        // 🍽️ Places Management (Admin CRUD)
        Route::prefix('places')
            ->name('places.')
            ->controller(PlaceController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{place:slug}', 'show')->name('show'); // 📌 Slug-based show
                Route::post('/', 'store')->name('store');
                Route::put('/{place}', 'update')->name('update');       // 📌 ID-based update
                Route::delete('/{place}', 'destroy')->name('destroy');  // 📌 ID-based delete
            });
    });




/*
|--------------------------------------------------------------------------
| Kiosk Routes
|--------------------------------------------------------------------------
|
*/


Route::prefix('kiosk')->group(function () {
    // Route::get('test1', [KioskAuthController::class, 'test'])->name('test1');
    Route::get('baro', function () {
        return response()->json(['message' => 'Baro Baro!']);
    })->name('baro');

    // PUBLIC: Kiosk–ის ლოგინისთვის
    Route::post('login', [KioskAuthController::class, 'login'])
        ->name('kiosk.login');

    // PROTECTED: ყველა დანარჩენი ტოკენით
    Route::middleware('auth:sanctum')->group(function () {
        // აპარატის „გულსცემა“
        Route::post('heartbeat', [KioskAuthController::class, 'heartbeat'])
            ->name('kiosk.heartbeat');
        // ყველა kiosks სტატუსი
        Route::get('status',    [KioskAuthController::class, 'status']);
        // აპარატის კონფიგურაცია
        Route::get('/config', [KioskAuthController::class, 'config']);
        // (სურვილისამებრ) logout
        Route::post('logout', [KioskAuthController::class, 'logout'])
            ->name('kiosk.logout');

        // რესტორნების ენდპოინტები
        // Route::get('restaurants', [KioskRestaurantController::class, 'index'])
        //     ->name('kiosk.restaurants.index');
        // Route::get('restaurants/{slug}', [KioskRestaurantController::class, 'showBySlug'])
        //     ->name('kiosk.restaurants.show');


        // Restaurants
        Route::prefix('restaurants')
            ->name('restaurants.')
            ->controller(KioskRestaurantController::class) // ჩაანაცვლეთ თქვენი რესტორნების კონტროლერით
            ->group(function () {
                Route::get('/', 'index')->name('index'); // აჩვენებს ყველა რესტორანს
                Route::get('/{slug}', 'showBySlug')->name('show'); // აჩვენებს კონკრეტულ რესტორანს slug-ით
                Route::get('/{slug}/details', 'showDetails')->name('details'); // დეტალები კონკრეტული რესტორნისთვის
                // Places
                Route::get('/{slug}/places', 'showByPlaces')->name('places'); // ადგილები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/place/{place}', 'showByPlace')->name('place.show'); // კონკრეტული ადგილის დეტალები

                Route::get('/{slug}/place/{place}/tables', 'showTablesInPlace')->name('place.tables');
                Route::get('/{slug}/place/{place}/table/{table}', 'showTableInPlace')->name('place.table.show');
                Route::get('/{slug}/{place}/{table}', 'showTableInPlace')->name('place.table.show.short');

                // Tables
                Route::get('/{slug}/tables', 'showByTables')->name('tables'); // მაგიდები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/table/{table}', 'showTable')->name('table.show'); // მაგიდის დეტალები კონკრეტული რესტორნისთვის
                // Menu
                Route::get('/{slug}/menu/categories', 'menuCategories')->name('menu.categories'); // მენიუ კატეგორები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/menu/items', 'menuItems')->name('menu.items'); // მენიუ ელემენტები კონკრეტული რესტორნისთვის
                Route::get('/{slug}/menu', 'showMenu')->name('menu'); // მენიუ კონკრეტული რესტორნისთვის

            });

        // Places
        Route::prefix('places')
            ->name('places.')
            ->controller(KioskRestaurantController::class) // ჩაანაცვლეთ თქვენი ადგილების კონტროლერით
            ->group(function () {
                Route::get('/', 'index')->name('index'); // აჩვენებს ყველა ადგილს
                Route::get('/{slug}', 'showBySlug')->name('show'); // აჩვენებს კონკრეტულ ადგილს slug-ით
                Route::get('/{slug}/restaurants', 'restaurantsByPlace')->name('restaurants'); // რესტორნები კონკრეტული ადგილისთვის
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByPlace')->name('top-10-restaurants'); // 10 საუკეთესო რესტორანი კონკრეტული ადგილისთვის
            });



        // Spaces
        Route::prefix('spaces')
            ->name('spaces.')
            ->controller(KioskSpaceController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsBySpace')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsBySpace')->name('top-10-restaurants');
            });

        // Spots
        Route::prefix('spots')
            ->name('spots.')
            ->controller(KioskSpotController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsBySpot')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsBySpot')->name('top-10-restaurants');
            });


        // 🍽 Cuisines
        Route::prefix('cuisines')
            ->name('cuisines.')
            ->controller(KioskCuisineController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsByCuisine')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByCuisine')->name('top-10-restaurants');
            });

        // Dishes
        Route::prefix('dishes')
            ->name('dishes.')
            ->controller(KioskDishController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
                Route::get('/{slug}/restaurants', 'restaurantsByDish')->name('restaurants');
                Route::get('/{slug}/top-10-restaurants', 'top10RestaurantsByDish')->name('top-10-restaurants');
            });

        // 🗂️ Categories for Kiosk
        Route::prefix('categories')
            ->name('categories.')
            ->controller(KioskCategoryController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{slug}', 'showBySlug')->name('show');
            });
    });


// � Booking API Endpoints (Data Processing, Validation, Security)
Route::prefix('booking')
    ->name('booking-api.')
    ->middleware(['throttle:60,1']) // Rate limiting for security
    ->group(function () {

        // 📌 Reservation Processing (BookingFormController)
        Route::controller(BookingFormController::class)->group(function () {
            Route::post('restaurant/{slug}/reserve', 'restaurantReserve')->name('restaurant.reserve');
            Route::post('{restaurant_slug}/place/{slug}/reserve', 'placeReserve')->name('place.reserve');
            Route::post('{restaurant_slug}/{place_slug}/table/{slug}/reserve', 'tableReserve')->name('table.reserve');
            Route::post('restaurant/{restaurant_slug}/table/{slug}/reserve', 'tableReserveDirect')->name('table.direct.reserve');
        });

        // 📌 OTP & SMS API (BookingFormController)
        Route::controller(BookingFormController::class)->group(function () {
            Route::get('restaurant/{slug}/otp', 'restaurantOTPForm')->name('restaurant.otp.form');
            Route::get('restaurant/{slug}/sms', 'restaurantSMSForm')->name('restaurant.sms.form');
            
            // OTP/SMS verification endpoints
            Route::post('restaurant/{slug}/verify-otp', 'verifyOTP')->name('restaurant.verify-otp');
            Route::post('restaurant/{slug}/send-sms', 'sendSMS')->name('restaurant.send-sms');
        });

        // 📌 სლოტების API (BookingController)
        Route::controller(BookingController::class)->group(function () {
            Route::get('{type}/{id}/available-slots', 'availableSlots')->name('available-slots');
            Route::post('{type}/{id}/create', 'createReservation')->name('create-reservation');
        });
    });

});

// Dish-Restaurant API endpoints for menu category relationships
Route::prefix('dishes')->controller(DishRestaurantApiController::class)->group(function () {
    Route::get('/', 'getDishesWithRestaurantCounts')->name('dishes.with-restaurants');
    Route::get('/{dish}/restaurants', 'getRestaurantsByDish')->name('dishes.restaurants');
    Route::get('/search', 'searchRestaurantsByDishName')->name('dishes.search-restaurants');
});
