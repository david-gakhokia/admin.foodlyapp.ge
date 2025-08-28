@echo off
title Process Email Queue - Foodly App
echo Processing Email Notification Queue...
echo ======================================

php artisan tinker --execute="echo 'Jobs in queue: ' . \Illuminate\Support\Facades\DB::table('jobs')->count();"

echo.
echo Processing all pending jobs...
php artisan queue:work --stop-when-empty

echo.
echo Queue processing completed!
php artisan tinker --execute="echo 'Remaining jobs: ' . \Illuminate\Support\Facades\DB::table('jobs')->count();"

echo.
echo Press any key to exit...
pause >nul
