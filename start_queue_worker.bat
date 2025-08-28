@echo off
title Queue Worker - Foodly App
echo Starting Queue Worker for Email Notifications...
echo ================================================

:start
php artisan queue:work --sleep=3 --tries=3 --timeout=90
echo Queue worker stopped. Restarting in 5 seconds...
timeout /t 5 /nobreak >nul
goto start
