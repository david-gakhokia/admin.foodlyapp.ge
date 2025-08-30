# 🚀 Memurai Redis Installation Guide for Windows

## Option 1: Manual Download (რეკომენდებული)

### 1. Download Memurai:
1. გადადით: https://www.memurai.com/
2. Click "Download" 
3. Choose "Memurai for Windows" (Free Developer Edition)
4. Download `.msi` ფაილი

### 2. Install:
1. Run downloaded `.msi` file
2. Follow installation wizard
3. Default port: 6379 (Laravel-ის default)

### 3. Verify Installation:
```powershell
# Check if Memurai service is running
Get-Service Memurai

# Test connection
memurai-cli ping
# Should return: PONG
```

## Option 2: Docker Redis (ალტერნატივა)

```powershell
# Install Docker Desktop (if not installed)
# Then run:
docker run -d --name redis-server -p 6379:6379 redis:alpine

# Test connection
docker exec redis-server redis-cli ping
```

## Option 3: Windows Subsystem for Linux (WSL)

```bash
# In WSL Ubuntu
sudo apt update
sudo apt install redis-server

# Start Redis
sudo service redis-server start

# Test
redis-cli ping
```

## 🔧 Laravel Configuration after Memurai/Redis Installation:

### 1. Update .env:
```env
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 2. Test Laravel Redis Connection:
```powershell
php artisan tinker
# In tinker:
Redis::ping();
# Should return: "+PONG"
```

### 3. Start Laravel Horizon:
```powershell
php artisan horizon
```

### 4. Access Horizon Dashboard:
```
http://api.foodlyapp.ge.test/horizon
```

## 🎯 After Installation Commands:

```powershell
# Clear config cache
php artisan config:clear

# Test Redis connection
php test_redis_connection.php

# Start Horizon
php artisan horizon

# Create test jobs
php test_create_queue_jobs.php
```

## 🔍 Troubleshooting:

### If Memurai service not starting:
```powershell
# Start Memurai service manually
net start Memurai

# Check port 6379
netstat -an | findstr :6379
```

### If Laravel can't connect to Redis:
```powershell
# Check Laravel Redis config
php artisan config:show queue
php artisan config:show database.redis
```

## 🎉 Success Indicators:

✅ Memurai service running  
✅ `memurai-cli ping` returns PONG  
✅ `Redis::ping()` works in Laravel  
✅ Laravel Horizon dashboard accessible  
✅ Queue jobs processing  

## 📊 Monitoring URLs:

- **Laravel Horizon**: http://api.foodlyapp.ge.test/horizon
- **Custom Dashboard**: http://api.foodlyapp.ge.test/admin/queue/dashboard (backup)

---

**მომავალში Custom Queue Dashboard შეგვიძლია წავშალოთ, რადგან Horizon ყველაფერს უკეთესად აკეთებს!** 🚀
