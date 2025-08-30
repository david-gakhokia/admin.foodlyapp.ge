<?php

use App\Http\Controllers\Admin\CuisineController;
use App\Http\Controllers\Admin\DishMenuCategoryController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\RestaurantCuisineController;
use App\Http\Controllers\Admin\CuisineRestaurantController;
use App\Http\Controllers\Admin\RestaurantDishController;
use App\Http\Controllers\Admin\DishRestaurantController;
use App\Http\Controllers\Admin\RestaurantSpaceController;
use App\Http\Controllers\Admin\SpaceRestaurantController;
use App\Http\Controllers\Admin\SpotController;
use App\Http\Controllers\Admin\SpotRestaurantController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Artisan;
use Laravel\Horizon\Horizon;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\KioskController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\NotificationLogController;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\Admin\RealtimeMonitoringController;

// Admin Slot Controllers
use App\Http\Controllers\Admin\Slot\RestaurantSlotController as AdminRestaurantSlotController;
use App\Http\Controllers\Admin\Slot\PlaceSlotController as AdminPlaceSlotController;
use App\Http\Controllers\Admin\Slot\TableSlotController as AdminTableSlotController;

use App\Http\Controllers\Kiosk\KioskReservationController;
use App\Http\Controllers\DevTestQrController;
use App\Http\Controllers\ReservationManagementController;
use App\Http\Controllers\Kiosk\BookingController;
use App\Http\Controllers\Kiosk\BookingFormController;
// Manager Controllers

use App\Http\Controllers\Manager\Slot\RestaurantSlotController;
use App\Http\Controllers\Manager\Slot\PlaceSlotController;
use App\Http\Controllers\Manager\Slot\TableSlotController;
use App\Http\Controllers\Manager\Booking\OccupancyController;
use App\Http\Controllers\DocumentationController;





// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
    Route::get('/', [DocumentationController::class, 'index'])->name('home');

// Documentation Routes
Route::prefix('docs')->name('docs.')->group(function () {
    // Main documentation page
    Route::get('/', [DocumentationController::class, 'index'])->name('index');

    // API Documentation (general)
    Route::get('/api', [DocumentationController::class, 'api'])->name('api');

    // Kiosk API Documentation
    Route::get('/kiosk', function () {
        return view('docs.kiosk');
    })->name('kiosk');

    // WebApp API Documentation
    Route::get('/webapp', [DocumentationController::class, 'webapp'])->name('webapp');
});


// სხვა მარშრუტები
Route::get('/roles-demo', function () {
    return view('admin.roles-demo');
})->middleware(['auth']);


// Clear all caches route
Route::get('/clear', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return response()->json(['message' => 'All caches cleared']);
});


// 🔥 Booking Form ნაწილი — Full Clean Block:
Route::prefix('booking-form')
    ->name('booking-form.')
    ->middleware(['web']) // Web middleware for forms and sessions
    ->group(function () {

        // 📌 ფორმები (BookingFormController) - მხოლოდ GET routes
        Route::controller(BookingFormController::class)->group(function () {
            Route::get('restaurant/{slug}', 'restaurantForm')->name('restaurant.form');
            Route::get('{restaurant_slug}/place/{slug}', 'placeForm')->name('place.form');
            Route::get('{restaurant_slug}/{place_slug}/table/{slug}', 'tableForm')->name('table.form');
            Route::get('restaurant/{restaurant_slug}/table/{slug}', 'tableFormDirect')->name('table.direct.form');
        });
    });



//  Manage Routes
Route::prefix('manager/slots')->name('manager.slots.')->group(function () {

    Route::prefix('restaurant/{restaurant}')
        ->name('restaurant.')
        ->group(function () {
            Route::resource('slots', RestaurantSlotController::class)->parameters([
                'slots' => 'slot',
            ]);
        });

    Route::prefix('place/{place}')
        ->name('place.')
        ->group(function () {
            Route::resource('slots', PlaceSlotController::class)->parameters([
                'slots' => 'slot',
            ]);
        });

    Route::prefix('table/{table}')
        ->name('table.')
        ->group(function () {
            Route::resource('slots', TableSlotController::class)->parameters([
                'slots' => 'slot',
            ]);
        });
});

// Route::prefix('manager/occupancy')->name('manager.occupancy.')->group(function () {
//     Route::get('/restaurant/{restaurant}', [OccupancyController::class, 'show'])->name('show');
// });

// Manager რეზერვაციები
// Route::get('/manager/reservations/{restaurantId}', [ReservationManagementController::class, 'manager'])->name('manager.reservations');

// Manager - by Place
// Route::get('/manager/reservations/place/{placeId}', [ReservationManagementController::class, 'byPlace'])->name('manager.reservations.by_place');

// Manager - by Table
// Route::get('/manager/reservations/table/{tableId}', [ReservationManagementController::class, 'byTable'])->name('manager.reservations.by_table');



// Test route for notification system
Route::get('/test-notification', [App\Http\Controllers\Test\NotificationTestController::class, 'testNotification'])
    ->name('test.notification');

// გაერთიანებული Admin Routes
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('users', UserController::class)
            ->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);

        Route::resource('roles', RoleController::class)
            ->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);

        Route::resource('permissions', PermissionController::class)
            ->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);

        Route::resource('kiosks', KioskController::class)
            ->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);


        // Spots
        Route::resource('spots', SpotController::class)
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

        // Spot image delete route
        Route::delete('spots/{spot}/image', [SpotController::class, 'deleteImage'])
            ->name('spots.image.delete');

        // Spot-Restaurant Management (from Spot perspective)
        Route::prefix('spots/{spot}/restaurants')->name('spots.restaurants.')->group(function () {
            Route::get('/', [SpotRestaurantController::class, 'index'])->name('index');
            Route::get('create', [SpotRestaurantController::class, 'create'])->name('create');
            Route::post('/', [SpotRestaurantController::class, 'store'])->name('store');
            Route::get('{restaurant}/edit', [SpotRestaurantController::class, 'edit'])->name('edit');
            Route::put('{restaurant}', [SpotRestaurantController::class, 'update'])->name('update');
            Route::delete('{restaurant}', [SpotRestaurantController::class, 'destroy'])->name('destroy');
            Route::put('/', [SpotRestaurantController::class, 'bulkUpdate'])->name('bulk-update');
        });


        Route::resource('cuisines', CuisineController::class)
            ->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);

        // Cuisine-Restaurant Management
        Route::prefix('cuisines/{cuisine}/restaurants')->name('cuisines.restaurants.')->group(function () {
            Route::get('/', [CuisineRestaurantController::class, 'index'])->name('index');
            Route::get('create', [CuisineRestaurantController::class, 'create'])->name('create');
            Route::post('/', [CuisineRestaurantController::class, 'store'])->name('store');
            Route::get('{restaurant}/edit', [CuisineRestaurantController::class, 'edit'])->name('edit');
            Route::put('{restaurant}', [CuisineRestaurantController::class, 'update'])->name('update');
            Route::delete('{restaurant}', [CuisineRestaurantController::class, 'destroy'])->name('destroy');
            Route::put('/', [CuisineRestaurantController::class, 'bulkUpdate'])->name('bulk-update');
        });

        // Dishes
        Route::resource('dishes', DishController::class)
            // ->only(['index']);    
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

        Route::delete('dishes/{dish}/image', [DishController::class, 'deleteOnlyImage'])
            ->name('dishes.image.delete');



        // Dish-Restaurant Management (from Dish perspective)
        Route::prefix('dishes/{dish}/restaurants')->name('dishes.restaurants.')->group(function () {
            Route::get('/', [DishRestaurantController::class, 'index'])->name('index');
            Route::get('create', [DishRestaurantController::class, 'create'])->name('create');
            Route::post('/', [DishRestaurantController::class, 'store'])->name('store');
            Route::get('{restaurant}/edit', [DishRestaurantController::class, 'edit'])->name('edit');
            Route::put('{restaurant}', [DishRestaurantController::class, 'update'])->name('update');
            Route::delete('{restaurant}', [DishRestaurantController::class, 'destroy'])->name('destroy');
            Route::put('/', [DishRestaurantController::class, 'bulkUpdate'])->name('bulk-update');
        });

        // Dish-MenuCategory Management (from Dish perspective)  
        Route::prefix('dishes/{dish}/menu-categories')->name('dishes.menu-categories.')->group(function () {
            Route::get('/', [DishMenuCategoryController::class, 'index'])->name('index');
            Route::get('create', [DishMenuCategoryController::class, 'create'])->name('create');
            Route::post('/', [DishMenuCategoryController::class, 'store'])->name('store');
            Route::get('{menuCategory}/edit', [DishMenuCategoryController::class, 'edit'])->name('edit');
            Route::put('{menuCategory}', [DishMenuCategoryController::class, 'update'])->name('update');
            Route::delete('{menuCategory}', [DishMenuCategoryController::class, 'destroy'])->name('destroy');
            Route::put('/', [DishMenuCategoryController::class, 'bulkUpdate'])->name('bulk-update');
        });

        // Dish-MenuCategory Overview
        Route::get('dishes-menu-categories-overview', [DishMenuCategoryController::class, 'overview'])
            ->name('dishes.menu-categories.overview');

        // Spaces
        Route::resource('spaces', \App\Http\Controllers\Admin\SpaceController::class)
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

        Route::delete('spaces/{space}/image', [\App\Http\Controllers\Admin\SpaceController::class, 'deleteImage'])
            ->name('spaces.image.delete');

        // Notification Logs (failed notifications)
        Route::prefix('notification-logs')->name('notification-logs.')->group(function () {
            Route::get('/', [NotificationLogController::class, 'index'])->name('index');
            Route::get('{notificationLog}', [NotificationLogController::class, 'show'])->name('show');
            // Create a sample log for testing (admin only)
            Route::post('sample', [NotificationLogController::class, 'sample'])->name('sample');
        });

        // Space-Restaurant Management (from Space perspective)
        Route::prefix('spaces/{space}/restaurants')->name('spaces.restaurants.')->group(function () {
            Route::get('/', [SpaceRestaurantController::class, 'index'])->name('index');
            Route::get('create', [SpaceRestaurantController::class, 'create'])->name('create');
            Route::post('/', [SpaceRestaurantController::class, 'store'])->name('store');
            Route::get('{restaurant}/edit', [SpaceRestaurantController::class, 'edit'])->name('edit');
            Route::put('{restaurant}', [SpaceRestaurantController::class, 'update'])->name('update');
            Route::delete('{restaurant}', [SpaceRestaurantController::class, 'destroy'])->name('destroy');
            Route::put('/', [SpaceRestaurantController::class, 'bulkUpdate'])->name('bulk-update');
        });


        // Cities
        Route::resource('cities', CityController::class)
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

        Route::delete('cities/{city}/image', [CityController::class, 'deleteImage'])
            ->name('cities.image.delete');

        // City-Restaurant Management (from City perspective)
        // Route::prefix('cities/{city}/restaurants')->name('cities.restaurants.')->group(function () {
        //     Route::get('/', [CityRestaurantController::class, 'index'])->name('index');
        //     Route::get('create', [CityRestaurantController::class, 'create'])->name('create');
        //     Route::post('/', [CityRestaurantController::class, 'store'])->name('store');
        //     Route::get('{restaurant}/edit', [CityRestaurantController::class, 'edit'])->name('edit');
        //     Route::put('{restaurant}', [CityRestaurantController::class, 'update'])->name('update');
        //     Route::delete('{restaurant}', [CityRestaurantController::class, 'destroy'])->name('destroy');
        //     Route::put('/', [CityRestaurantController::class, 'bulkUpdate'])->name('bulk-update');
        // });

        // Menu Module
        Route::prefix('menu')->name('menu.')->group(function () {

            // Categories
            Route::prefix('categories')->name('categories.')->group(function () {
                Route::resource('/', MenuCategoryController::class)
                    ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy'])
                    ->parameters(['' => 'menuCategory']);
                // ->except('show');
            });

            // Items
            Route::prefix('items')->name('items.')->group(function () {
                Route::get('/', [MenuItemController::class, 'index'])->name('index');
                Route::get('/create', [MenuItemController::class, 'create'])->name('create');
                Route::post('/', [MenuItemController::class, 'store'])->name('store');
                Route::get('/{menuItem}/edit', [MenuItemController::class, 'edit'])->name('edit');
                Route::put('/{menuItem}', [MenuItemController::class, 'update'])->name('update');
                Route::delete('/{menuItem}', [MenuItemController::class, 'destroy'])->name('destroy');

                Route::delete('/{menuItem}/image', [MenuItemController::class, 'deleteImage'])->name('image.delete');
                Route::post('/sort', [MenuItemController::class, 'sort'])->name('sort');
            });
        });






        // Restaurants
        Route::resource('restaurants', RestaurantController::class)
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

        // Restaurant-Space Management
        Route::prefix('restaurants/{restaurant}/spaces')->name('restaurants.spaces.')->group(function () {
            Route::get('/', [RestaurantSpaceController::class, 'index'])->name('index');
            Route::get('create', [RestaurantSpaceController::class, 'create'])->name('create');
            Route::post('/', [RestaurantSpaceController::class, 'store'])->name('store');
            Route::get('{space}/edit', [RestaurantSpaceController::class, 'edit'])->name('edit');
            Route::put('{space}', [RestaurantSpaceController::class, 'update'])->name('update');
            Route::delete('{space}', [RestaurantSpaceController::class, 'destroy'])->name('destroy');
            Route::put('/', [RestaurantSpaceController::class, 'bulkUpdate'])->name('bulk-update');
        });

        // Restaurant-Dish Management (from Restaurant perspective)
        Route::prefix('restaurants/{restaurant}/dishes')->name('restaurants.dishes.')->group(function () {
            Route::get('/', [RestaurantDishController::class, 'index'])->name('index');
            Route::get('create', [RestaurantDishController::class, 'create'])->name('create');
            Route::post('/', [RestaurantDishController::class, 'store'])->name('store');
            Route::get('{dish}/edit', [RestaurantDishController::class, 'edit'])->name('edit');
            Route::put('{dish}', [RestaurantDishController::class, 'update'])->name('update');
            Route::delete('{dish}', [RestaurantDishController::class, 'destroy'])->name('destroy');
            Route::put('/', [RestaurantDishController::class, 'bulkUpdate'])->name('bulk-update');
        });

        // Restaurant-Cuisine Management
        Route::prefix('restaurants/{restaurant}/cuisines')->name('restaurants.cuisines.')->group(function () {
            Route::get('/', [RestaurantCuisineController::class, 'index'])->name('index');
            Route::get('create', [RestaurantCuisineController::class, 'create'])->name('create');
            Route::post('/', [RestaurantCuisineController::class, 'store'])->name('store');
            Route::get('{cuisine}/edit', [RestaurantCuisineController::class, 'edit'])->name('edit');
            Route::put('{cuisine}', [RestaurantCuisineController::class, 'update'])->name('update');
            Route::delete('{cuisine}', [RestaurantCuisineController::class, 'destroy'])->name('destroy');
            Route::put('/', [RestaurantCuisineController::class, 'bulkUpdate'])->name('bulk-update');
        });

        // Restaurant Slots
        Route::prefix('restaurants/{restaurant}')->name('restaurants.')->group(function () {
            Route::resource('slots', AdminRestaurantSlotController::class)
                ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
                ->parameters(['slots' => 'slot']);
        });

        // Restaurant Reservations
        Route::prefix('restaurants/{restaurant}')->name('restaurants.')->group(function () {
            Route::get('reservations/calendar', [ReservationController::class, 'calendar'])
                ->name('reservations.calendar');
            // JSON events endpoint for FullCalendar (placed before resource to avoid route conflicts)
            Route::get('reservations/events', [ReservationController::class, 'events'])
                ->name('reservations.events');
            // Status update route
            Route::patch('reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])
                ->name('reservations.status');
            Route::resource('reservations', ReservationController::class)
                ->only(['index', 'show', 'edit', 'update', 'destroy']);
        });

        // Restaurant Menu Categories - Hierarchical Structure
        Route::prefix('restaurants/{restaurant}')->name('restaurants.')->group(function () {
            Route::prefix('menu/categories')->name('menu.categories.')->group(function () {

                // დონე 1 - ძირითადი კატეგორიები
                Route::get('/', [MenuCategoryController::class, 'indexByRestaurant'])->name('index');
                Route::get('create', [MenuCategoryController::class, 'createForRestaurant'])->name('create');
                Route::post('/', [MenuCategoryController::class, 'storeForRestaurant'])->name('store');

                // დონე 2 - ქვეკატეგორიები (parent-ის შვილები)
                Route::get('level/{parent}', [MenuCategoryController::class, 'showChildren'])->name('children');
                Route::get('level/{parent}/create', [MenuCategoryController::class, 'createChildForParent'])->name('children.create');
                Route::post('level/{parent}', [MenuCategoryController::class, 'storeChildForParent'])->name('children.store');

                // დონე 3 - მესამე დონე (parent/child-ის შვილები)  
                Route::get('level/{parent}/sub/{child}', [MenuCategoryController::class, 'showSubChildren'])->name('subchildren');
                Route::get('level/{parent}/sub/{child}/create', [MenuCategoryController::class, 'createSubChildForChild'])->name('subchildren.create');
                Route::post('level/{parent}/sub/{child}', [MenuCategoryController::class, 'storeSubChildForChild'])->name('subchildren.store');

                // კატეგორიის CRUD ოპერაციები (ყველა დონისთვის)
                Route::get('{menuCategory}', [MenuCategoryController::class, 'showForRestaurant'])->name('show');
                Route::get('{menuCategory}/edit', [MenuCategoryController::class, 'editForRestaurant'])->name('edit');
                Route::put('{menuCategory}', [MenuCategoryController::class, 'updateForRestaurant'])->name('update');
                Route::delete('{menuCategory}', [MenuCategoryController::class, 'destroyForRestaurant'])->name('destroy');

                // კატეგორიის Items მართვა (ყველა დონის კატეგორიისთვის)
                Route::prefix('{category}/items')->name('items.')->group(function () {
                    Route::get('/', [MenuItemController::class, 'indexByCategory'])->name('index');
                    Route::get('create', [MenuItemController::class, 'createForCategory'])->name('create');
                    Route::post('/', [MenuItemController::class, 'storeForCategory'])->name('store');
                    Route::get('{item}', [MenuItemController::class, 'showForCategory'])->name('show');
                    Route::get('{item}/edit', [MenuItemController::class, 'editForCategory'])->name('edit');
                    Route::put('{item}', [MenuItemController::class, 'updateForCategory'])->name('update');
                    Route::delete('{item}', [MenuItemController::class, 'destroyForCategory'])->name('destroy');
                    Route::delete('{item}/image', [MenuItemController::class, 'deleteImageForCategory'])->name('image.delete');
                    Route::post('sort', [MenuItemController::class, 'sortForCategory'])->name('sort');
                });
            });

            // Parent categories route
            Route::get('menu/category/{menuCategory}/parents', [MenuCategoryController::class, 'showParents'])->name('menu.category.parents');

            // Notification Logs (failed notifications) — moved to top-level admin routes
        });

        // Restaurant Places - Nested routes
        Route::prefix('restaurants/{restaurant}')->name('restaurants.')->group(function () {
            // Places index for specific restaurant
            Route::get('places', [PlaceController::class, 'indexByRestaurant'])->name('places.index');
            Route::get('places/create', [PlaceController::class, 'createForRestaurant'])->name('places.create');
            Route::post('places', [PlaceController::class, 'storeForRestaurant'])->name('places.store');

            // Individual place operations
            Route::prefix('places/{place}')->name('places.')->group(function () {
                Route::get('/', [PlaceController::class, 'showForRestaurant'])->name('show');
                Route::get('edit', [PlaceController::class, 'editForRestaurant'])->name('edit');
                Route::put('/', [PlaceController::class, 'updateForRestaurant'])->name('update');
                Route::delete('/', [PlaceController::class, 'destroyForRestaurant'])->name('destroy');
                Route::delete('delete-image', [PlaceController::class, 'deleteOnlyImageForRestaurant'])->name('delete-image');

                // Place Slots
                Route::resource('slots', AdminPlaceSlotController::class)
                    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
                    ->parameters(['slots' => 'slot']);

                // Place Tables
                Route::get('tables', [TableController::class, 'indexByPlace'])->name('tables.index');
                Route::get('tables/create', [TableController::class, 'createForPlace'])->name('tables.create');
                Route::post('tables', [TableController::class, 'storeForPlace'])->name('tables.store');

                // Individual table operations
                Route::prefix('tables/{table}')->name('tables.')->group(function () {
                    Route::get('/', [TableController::class, 'showForPlace'])->name('show');
                    Route::get('edit', [TableController::class, 'editForPlace'])->name('edit');
                    Route::put('/', [TableController::class, 'updateForPlace'])->name('update');
                    Route::delete('/', [TableController::class, 'destroyForPlace'])->name('destroy');
                    Route::delete('delete-image', [TableController::class, 'deleteOnlyImageForPlace'])->name('delete-image');

                    // Table Slots (resource, correct binding, no duplicates)
                    Route::resource('slots', AdminTableSlotController::class)
                        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
                        ->parameters(['slots' => 'slot']);
                });
            });
        });

        // AJAX Routes for form interactions
        Route::get('/restaurants/{restaurant}/menu-categories', [MenuItemController::class, 'getRestaurantCategories'])
            ->name('restaurants.menu-categories');
        Route::get('/restaurants/{restaurant}/parent-categories', [MenuCategoryController::class, 'getRestaurantParentCategories'])
            ->name('restaurants.parent-categories');
        Route::get('/restaurants/{restaurant}/places-ajax', [TableController::class, 'getRestaurantPlaces'])
            ->name('restaurants.places-ajax');

        // Top-level Admin Reservations (list and calendar across all restaurants)
        Route::get('reservations/list', [ReservationController::class, 'list'])
            ->name('reservations.list');

        Route::get('reservation/calendar', [ReservationController::class, 'calendarAll'])
            ->name('reservation.calendar');

        // Queue Management Routes
        Route::prefix('queue')->name('queue.')->group(function () {
            Route::get('dashboard', [\App\Http\Controllers\Admin\QueueController::class, 'dashboard'])->name('dashboard');
            Route::get('jobs', [\App\Http\Controllers\Admin\QueueController::class, 'jobs'])->name('jobs');
            Route::get('failed', [\App\Http\Controllers\Admin\QueueController::class, 'failed'])->name('failed');
            Route::get('retry-failed/{id}', [\App\Http\Controllers\Admin\QueueController::class, 'retryFailed'])->name('retry-failed');
            Route::delete('delete-failed/{id}', [\App\Http\Controllers\Admin\QueueController::class, 'deleteFailed'])->name('delete-failed');
            Route::post('clear-failed', [\App\Http\Controllers\Admin\QueueController::class, 'clearFailed'])->name('clear-failed');
            Route::post('restart', [\App\Http\Controllers\Admin\QueueController::class, 'restart'])->name('restart');
            Route::get('api', [\App\Http\Controllers\Admin\QueueController::class, 'api'])->name('api');
        });

        // Real-time Monitoring Routes
        Route::prefix('monitoring')->name('monitoring.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\RealtimeMonitoringController::class, 'dashboard'])->name('dashboard');
            Route::get('api', [\App\Http\Controllers\Admin\RealtimeMonitoringController::class, 'api'])->name('api');
            Route::get('reservations-feed', [\App\Http\Controllers\Admin\RealtimeMonitoringController::class, 'reservationsFeed'])->name('reservations-feed');
            Route::get('email-activities', [\App\Http\Controllers\Admin\RealtimeMonitoringController::class, 'emailActivities'])->name('email-activities');
            Route::get('system-health', [\App\Http\Controllers\Admin\RealtimeMonitoringController::class, 'systemHealth'])->name('system-health');
            Route::get('performance-metrics', [\App\Http\Controllers\Admin\RealtimeMonitoringController::class, 'performanceMetrics'])->name('performance-metrics');
        });
    });




Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
