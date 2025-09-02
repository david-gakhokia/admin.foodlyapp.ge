# API vs Admin Dashboard - Project Separation Plan

## 📋 პროექტის გაყოფის სრული გეგმა

### 🎯 მიზანი
არსებული ერთიანი პროექტის გაყოფა ორ ცალკე, დამოუკიდებელ პროექტად:
1. **Admin Dashboard Project** - სრული admin ფუნქციონალობა
2. **API Project** - მხოლოდ API endpoints-ები 9 მოდულისთვის

---

## 🗂️ მოდულების განაწილება

### 📊 Admin Dashboard Project (ყველაფერი ინარჩუნებს)
```
✅ Users Management
✅ Roles & Permissions
✅ Restaurants Management
✅ Cuisines Management  
✅ Dishes Management
✅ Spots Management
✅ Spaces Management
✅ Cities Management

✅ Places Management
✅ Tables Management
✅ Reservations Management
✅ Kiosks Management
✅ Menu Categories Management
✅ Menu Items Management
✅ Products Management
✅ Analytics & Reporting
✅ Monitoring & Logs
✅ BOG Payments
✅ Notification System
✅ Queue Management
✅ Email System
✅ Real-time Monitoring

✅ All Livewire Components
✅ All Web Routes
✅ All Blade Views
✅ All Admin Controllers
✅ All Manager Controllers
✅ All Frontend Assets
```

### 🔌 API Project (მხოლოდ 9 მოდული)
```
✅ Users (API only)
✅ Roles & Permissions (API only)
✅ Restaurants (API only)
✅ Cuisines (API only)
✅ Dishes (API only)
✅ Spots (API only) 
✅ Spaces (API only)
✅ Cities (API only)
✅ Authentication (Sanctum API)

❌ Places (არ გადაინოს)
❌ Tables (არ გადაინოს)
❌ Reservations (არ გადაინოს)
❌ Kiosks (არ გადაინოს)
❌ Menu Management (არ გადაინოს)
❌ Analytics (არ გადაინოს)
❌ BOG Payments (არ გადაინოს)
❌ Monitoring (არ გადაინოს)
❌ All Web Interface Components
```

---

## 📁 File Structure Comparison

### Admin Dashboard Project Structure (უცვლელი)
```
admin-foodlyapp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          ✅ ყველაფერი
│   │   │   ├── Manager/        ✅ ყველაფერი  
│   │   │   ├── Api/            ✅ ყველაფერი
│   │   │   ├── Kiosk/          ✅ ყველაფერი
│   │   │   └── Livewire/       ✅ ყველაფერი
│   │   ├── Livewire/           ✅ ყველაფერი
│   │   └── Resources/          ✅ ყველაფერი
│   ├── Models/                 ✅ ყველა მოდელი
│   ├── Mail/                   ✅ ყველაფერი
│   ├── Jobs/                   ✅ ყველაფერი
│   ├── Events/                 ✅ ყველაფერი
│   └── Services/               ✅ ყველაფერი
├── resources/
│   ├── views/                  ✅ ყველა view
│   ├── js/                     ✅ ყველა asset
│   └── css/                    ✅ ყველა style
├── routes/
│   ├── web.php                 ✅ ყველა web route
│   ├── api.php                 ✅ ყველა API route
│   └── analytics.php           ✅ ყველაფერი
└── database/
    ├── migrations/             ✅ ყველა migration
    └── seeders/                ✅ ყველა seeder
```

### API Project Structure (გაფილტრული)
```
api-foodlyapp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/            📋 მხოლოდ 9 მოდულის API controllers
│   │   ├── Resources/          📋 მხოლოდ 9 მოდულის resources
│   │   ├── Requests/           📋 მხოლოდ საჭირო validation rules
│   │   └── Middleware/         📋 API-specific middleware
│   ├── Models/                 📋 მხოლოდ 9 მოდულის models + User
│   └── Services/               📋 მხოლოდ API-related services
├── resources/
│   └── views/                  📋 მინიმალური (მხოლოდ docs)
├── routes/
│   ├── api.php                 📋 მხოლოდ API routes
│   └── web.php                 📋 მინიმალური (auth + docs)
├── database/
│   ├── migrations/             📋 მხოლოდ 9 მოდულის migrations
│   └── seeders/                📋 მხოლოდ 9 მოდულის seeders
├── config/                     📋 API-optimized configs
└── tests/                      📋 API-focused tests
```

---

## 🔄 Migration Strategy

### Phase 1: Create API Project Repository
```bash
# 1. Create new Laravel project
composer create-project laravel/laravel api-foodlyapp
cd api-foodlyapp

# 2. Install required packages
composer require laravel/sanctum
composer require spatie/laravel-permission
composer require spatie/laravel-sluggable
composer require astrotomic/laravel-translatable
composer require cloudinary-labs/cloudinary-laravel

# 3. Remove unwanted packages
composer remove livewire/flux livewire/volt power-components/livewire-powergrid
composer remove romanzipp/laravel-queue-monitor laravel/horizon
composer remove sendgrid/sendgrid mpdf/mpdf endroid/qr-code
```

### Phase 2: Copy Core Files
```bash
# Copy Models (only 9 modules + User)
cp ../admin-foodlyapp/app/Models/User.php app/Models/
cp ../admin-foodlyapp/app/Models/Role.php app/Models/
cp ../admin-foodlyapp/app/Models/Permission.php app/Models/
cp ../admin-foodlyapp/app/Models/Restaurant.php app/Models/
cp ../admin-foodlyapp/app/Models/RestaurantTranslation.php app/Models/
cp ../admin-foodlyapp/app/Models/Cuisine.php app/Models/
cp ../admin-foodlyapp/app/Models/CuisineTranslation.php app/Models/
cp ../admin-foodlyapp/app/Models/Dish.php app/Models/
cp ../admin-foodlyapp/app/Models/DishTranslation.php app/Models/
cp ../admin-foodlyapp/app/Models/Spot.php app/Models/
cp ../admin-foodlyapp/app/Models/SpotTranslation.php app/Models/
cp ../admin-foodlyapp/app/Models/Space.php app/Models/
cp ../admin-foodlyapp/app/Models/SpaceTranslation.php app/Models/
cp ../admin-foodlyapp/app/Models/City.php app/Models/
cp ../admin-foodlyapp/app/Models/CityTranslation.php app/Models/

# Copy API Controllers (only 9 modules)
cp -r ../admin-foodlyapp/app/Http/Controllers/Api/ app/Http/Controllers/

# Copy API Resources
cp -r ../admin-foodlyapp/app/Http/Resources/ app/Http/Resources/

# Copy specific migrations (only 9 modules)
# Copy database seeders (only 9 modules)
# Copy configuration files (adapted)
```

### Phase 3: Clean Up API Project
```bash
# Remove unnecessary files
rm -rf resources/views/admin/
rm -rf resources/views/livewire/
rm -rf app/Http/Livewire/
rm -rf app/Mail/
rm -rf app/Jobs/
rm -rf app/Events/

# Clean up routes
# Edit routes/api.php - keep only 9 modules
# Edit routes/web.php - minimal auth routes only

# Update configuration files
# Edit config/app.php - remove Livewire providers
# Edit composer.json - clean dependencies
```

### Phase 4: Database Setup
```bash
# Run migrations
php artisan migrate

# Seed data
php artisan db:seed

# Test API endpoints
php artisan serve
```

---

## 🗄️ Database Strategy

### Option 1: Separate Databases (Recommended)
```
admin-foodlyapp:
  Database: foodly_admin
  Contains: All tables (complete system)

api-foodlyapp:
  Database: foodly_api
  Contains: Only 9 modules + auth tables
```

### Option 2: Shared Database
```
Both projects use same database: foodly_shared
API project ignores extra tables
Admin project uses all tables
```

### Recommended: Separate Databases
**Benefits:**
- Clear separation of concerns
- Independent scaling
- Better security isolation
- Easier maintenance
- No interference between projects

---

## 🔧 Configuration Differences

### Admin Dashboard .env
```env
APP_NAME="Foodly Admin Dashboard"
APP_URL=https://admin.foodlyapp.ge

# Full feature set
LIVEWIRE_ENABLED=true
HORIZON_ENABLED=true
ANALYTICS_ENABLED=true
BOG_PAYMENTS_ENABLED=true
QUEUE_MONITORING_ENABLED=true

# Database
DB_DATABASE=foodly_admin
```

### API Project .env
```env
APP_NAME="Foodly API"
APP_URL=https://api.foodlyapp.ge

# API only features
SANCTUM_ENABLED=true
API_RATE_LIMITING=true
CORS_ENABLED=true

# Database
DB_DATABASE=foodly_api

# Disable web features
SESSION_DRIVER=array
VIEW_CACHE=false
```

---

## 🚀 Deployment Strategy

### Production URLs
```
Admin Dashboard: https://admin.foodlyapp.ge
API Project:     https://api.foodlyapp.ge
```

### Server Requirements

#### Admin Dashboard Server
```
- Higher CPU (complex web interface)
- More RAM (Livewire components)
- Redis (sessions, caching, queues)
- MySQL (full database)
- File storage (uploads, reports)
```

#### API Server
```
- Optimized for API requests
- Lower resource requirements
- Redis (API caching, rate limiting)
- MySQL (core tables only)
- CDN integration (Cloudinary)
```

---

## 📊 Benefits of Separation

### 🎯 Performance Benefits
```
✅ API Server: Optimized for API response times
✅ Admin Server: Optimized for web interface
✅ Independent scaling based on usage
✅ Reduced memory footprint per project
✅ Faster deployments (smaller codebases)
```

### 🔒 Security Benefits
```
✅ API-only authentication (Sanctum)
✅ Separate SSL certificates
✅ Different rate limiting strategies
✅ Isolated attack surface
✅ API-specific security headers
```

### 🛠️ Development Benefits
```
✅ Cleaner, focused codebases
✅ Independent development teams
✅ Separate testing strategies
✅ Clear API documentation
✅ Better code maintainability
```

### 📈 Operational Benefits
```
✅ Independent monitoring
✅ Separate backup strategies
✅ Different update schedules
✅ API versioning flexibility
✅ Better error tracking
```

---

## 🧪 Testing Strategy

### Admin Dashboard Testing
```php
// Full feature testing
- Web interface tests
- Livewire component tests
- Admin functionality tests
- Manager workflow tests
- Analytics feature tests
- Email system tests
- Queue processing tests
- BOG payment tests
```

### API Project Testing
```php
// API-focused testing
- API endpoint tests
- Authentication tests
- Authorization tests
- Data validation tests
- Response format tests
- Rate limiting tests
- Localization tests
- Performance tests
```

---

## 📋 Migration Checklist

### ✅ Pre-Migration Tasks
- [ ] Create new repository for API project
- [ ] Set up separate development environment
- [ ] Document current API endpoints
- [ ] Identify dependencies between modules
- [ ] Plan database migration strategy
- [ ] Update CI/CD pipelines

### ✅ Migration Tasks
- [ ] Create new Laravel API project
- [ ] Install required packages only
- [ ] Copy and adapt core files
- [ ] Clean up unnecessary components
- [ ] Update configuration files
- [ ] Migrate database tables
- [ ] Seed test data
- [ ] Update route definitions

### ✅ Post-Migration Tasks
- [ ] Test all API endpoints
- [ ] Update API documentation
- [ ] Configure production servers
- [ ] Set up monitoring
- [ ] Update client applications
- [ ] Deploy to production
- [ ] Monitor performance

---

## 🔄 Ongoing Maintenance

### Synchronization Strategy
```
When adding new features:

1. Core Business Logic Changes:
   - Update both projects
   - Maintain API compatibility
   - Update shared models

2. Admin-Only Features:
   - Update only Admin Dashboard
   - No API project changes needed

3. API-Only Features:
   - Update only API project
   - Maintain backward compatibility
```

### Version Control Strategy
```
Main Repository: admin-foodlyapp (complete system)
API Repository: api-foodlyapp (API subset)

Sync Strategy:
- Core model changes: sync to both
- Admin features: admin repo only
- API features: API repo only
```

---

## 📞 Success Metrics

### Performance Metrics
- API response time < 200ms
- Admin dashboard load time < 2s
- 99.9% uptime for both systems
- Zero downtime deployments

### Development Metrics
- Reduced deployment time by 50%
- Easier testing and debugging
- Faster feature development
- Better code maintainability

---

*ეს დოკუმენტი მოიცავს API და Admin Dashboard პროექტების წარმატებული გაყოფისთვის ყველა საჭირო ინფორმაციას და ნაბიჯ-ნაბიჯ გეგმას.*
