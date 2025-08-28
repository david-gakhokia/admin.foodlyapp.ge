# Quick Deploy to Railway.app

## 1. Account Setup
1. Go to https://railway.app/
2. Sign in with GitHub
3. Connect your repository: `david-gakhokia/api.foodlyapp.ge`

## 2. Add Redis Service
```bash
# In Railway dashboard:
# 1. Click "New" -> "Database" -> "Redis"
# 2. This creates Redis instance automatically
# 3. Copy the REDIS_URL from Variables tab
```

## 3. Environment Variables
Add these to Railway:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
# Add your MySQL database details

REDIS_URL=${{Redis.REDIS_URL}}
QUEUE_CONNECTION=redis
CACHE_STORE=redis
SESSION_DRIVER=redis

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=admin@foodlyapp.ge
MAIL_PASSWORD=FoodlyApp_2015
MAIL_ENCRYPTION=ssl
```

## 4. Deploy Commands
Railway will auto-detect Laravel and run:
```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 5. Worker Process
Create `Procfile` in root:
```
web: php artisan serve --host=0.0.0.0 --port=$PORT
worker: php artisan queue:work redis --sleep=3 --tries=3
```

## Cost: ~$5-10/month total
- App: $5/month
- Redis: Free tier or $3/month
- MySQL: Use existing or $3/month
