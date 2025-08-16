<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap route macros and route file registration.
     */
    public function boot(): void
    {
        // 💡 Custom route macros for different API consumers
        Route::macro('mobile', fn() => Route::prefix('mobile')->name('mobile.'));
        Route::macro('webapp', fn() => Route::prefix('webapp')->name('webapp.'));
        Route::macro('kiosk', fn() => Route::prefix('kiosk')->name('kiosk.'));
        Route::macro('android', fn() => Route::prefix('android')->name('android.')); // ➕ ახალი Android macro
        Route::macro('ios', fn() => Route::prefix('ios')->name('ios.')); // ➕ iOS-ისთვისაც მომავალში
        Route::macro('vendorApi', fn() => Route::prefix('vendor')->name('vendor.'));
        Route::macro('publicApi', fn() => Route::prefix('public')->name('public.'));
        Route::macro('softwareApi', fn() => Route::prefix('software')->name('software.'));

        // 🛠️ Load route groups
        $this->routes(function () {
            Route::middleware('api')->group(base_path('routes/api.php'));

            // ➕ Android API routes 
            Route::middleware('api')
                ->prefix('api')
                ->android()
                ->group(base_path('routes/api/android.php'));

            Route::middleware('web')->group(base_path('routes/web.php'));
        });
    }
}
