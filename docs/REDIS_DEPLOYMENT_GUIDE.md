# Redis Deployment Guide - FOODLY

## 1. Laravel Forge + DigitalOcean (რეკომენდირებული)

### ნაბიჯები:
1. **Laravel Forge Account**: https://forge.laravel.com
2. **DigitalOcean Droplet** შექმნა Forge-ის მეშვეობით
3. **Redis Service** დამატება

### Forge Configuration:
```bash
# Server Type: App Server
# Provider: DigitalOcean
# Region: Frankfurt (ყველაზე ახლოს საქართველოსთან)
# Size: $12/month (2GB RAM, 1 vCPU)
# PHP Version: 8.2
# Database: MySQL 8.0
# Redis: ✅ Enable
```

### .env Production Settings:
```env
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_DB=0

QUEUE_CONNECTION=redis
CACHE_STORE=redis
SESSION_DRIVER=redis
```

## 2. Railway.app (სწრაფი deployment)

### ნაბიჯები:
1. https://railway.app/
2. GitHub repo connection
3. Add Redis service
4. Environment variables

### Railway Redis Config:
```env
REDIS_URL=${{Redis.REDIS_URL}}
QUEUE_CONNECTION=redis
CACHE_STORE=redis
```

## 3. Heroku + Redis To Go

### Add-ons:
```bash
heroku addons:create redistogo:nano
heroku config:get REDISTOGO_URL
```

### Config:
```env
REDIS_URL=$REDISTOGO_URL
QUEUE_CONNECTION=redis
```

## 4. AWS Elastic Beanstalk + ElastiCache

### ElastiCache Redis:
- Node Type: cache.t3.micro (Free Tier)
- Engine: Redis 7.x
- Multi-AZ: No (for cost saving)

### .env AWS:
```env
REDIS_HOST=your-cluster.cache.amazonaws.com
REDIS_PORT=6379
QUEUE_CONNECTION=redis
```

## 5. Local Development (Docker)

### docker-compose.yml:
```yaml
version: '3.8'
services:
  redis:
    image: redis:alpine
    ports:
      - "6379:6379"
    volumes:
      - redis_data:/data
    command: redis-server --appendonly yes

volumes:
  redis_data:
```

### Commands:
```bash
docker-compose up -d redis
```

## რეკომენდაცია FOODLY-სთვის:

### Development:
- **Docker Redis** (ლოკალურად)

### Production:
- **Laravel Forge + DigitalOcean** 
- Cost: ~$12-15/month
- მარტივი setup
- Automatic backups
- SSL certificates
- Queue monitoring

### Budget Option:
- **Railway.app**
- Cost: ~$5-10/month
- GitHub integration
- Redis included

## Queue Worker Setup (Production):

### Supervisor Configuration:
```ini
[program:foodly-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/forge/api.foodlyapp.ge/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=forge
numprocs=2
redirect_stderr=true
stdout_logfile=/home/forge/api.foodlyapp.ge/worker.log
stopwaitsecs=3600
```

### Commands:
```bash
# Start workers
sudo supervisorctl start foodly-worker:*

# Monitor
sudo supervisorctl status
php artisan queue:monitor redis:default --max=100
```

## Email Queue Performance:

### Redis Benefits:
- **Speed**: 10x faster than database queue
- **Reliability**: Persistent storage
- **Monitoring**: Real-time job tracking
- **Scaling**: Multiple workers

### Expected Performance:
- Database Queue: ~50 emails/minute
- Redis Queue: ~500+ emails/minute
- Failed job retry: Exponential backoff
- Memory usage: ~2MB per 1000 jobs

## Monitoring Commands:

```bash
# Check Redis connection
php artisan tinker
>>> Redis::ping()

# Queue stats
php artisan queue:monitor
php artisan horizon:status

# Clear failed jobs
php artisan queue:flush
php artisan queue:restart
```
