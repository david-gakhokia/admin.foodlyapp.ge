# API vs Admin Dashboard - Project Separation Plan

## 📋 პროექტის გაყოფის სრული გეგმა

### 🎯 მიზანი
არსებული ერთიანი პროექტის გაყოფა ორ ცალკე, დამოუკიდებელ პროექტადcp ../admin-foodlyapp/app/Models/CityTranslation.php app/Models/
cp ../admin-foodlyapp/app/Models/Place.php app/Models/
cp ../admin-foodlyapp/app/Models/PlaceTranslation.php app/Models/
cp ../admin-foodlyapp/app/Models/Table.php app/Models/
cp ../admin-foodlyapp/app/Models/TableTranslation.php app/Models/
cp ../admin-foodlyapp/app/Models/Reservation.php app/Models/

# Copy API controllers (only 12 modules)
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

### 🔌 API Project (მხოლოდ 12 მოდული)
```
✅ Users (API only)
✅ Roles & Permissions (API only)
✅ Restaurants (API only)
✅ Cuisines (API only)
✅ Dishes (API only)
✅ Spots (API only) 
✅ Spaces (API only)
✅ Cities (API only)
✅ Places (API only)
✅ Tables (API only)
✅ Reservations (API only)
✅ Authentication (Sanctum API)

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
│   │   │   └── Api/            📋 მხოლოდ 12 მოდულის API controllers
│   │   ├── Resources/          📋 მხოლოდ 12 მოდულის resources
│   │   ├── Requests/           📋 მხოლოდ საჭირო validation rules
│   │   └── Middleware/         📋 API-specific middleware
│   ├── Models/                 📋 მხოლოდ 12 მოდულის models + User
│   └── Services/               📋 მხოლოდ API-related services
├── resources/
│   └── views/                  📋 მინიმალური (მხოლოდ docs)
├── routes/
│   ├── api.php                 📋 მხოლოდ API routes
│   └── web.php                 📋 მინიმალური (auth + docs)
├── database/
│   ├── migrations/             📋 მხოლოდ 12 მოდულის migrations
│   └── seeders/                📋 მხოლოდ 12 მოდულის seeders
├── config/                     📋 API-optimized configs
└── tests/                      📋 API-focused tests
```

---

## 🔄 API Project Strategy

### 🎯 ახალი API პროექტის მიზანი
```
✅ არსებული ბაზიდან მონაცემების წაკითხვა
✅ მონაცემების განახლება API-ს მეშვეობით  
✅ მხოლოდ 12 მოდულისთვის clean API endpoints
✅ მობილური აპლიკაციებისთვის ოპტიმიზაცია
✅ სწრაფი და მარტივი API responses

❌ ახალი მიგრაციები არ ჭირდება
❌ ახალი მონაცემთა ბაზის სტრუქტურა არ ჭირდება  
❌ მონაცემების კოპირება არ ჭირდება
```

### 📊 Database Strategy  
```
არსებული Database: foodly (სრული სისტემა)
  ↓
API Project: api-foodlyapp (კითხულობს იგივე ბაზას)
  ↓
მხოლოდ 12 მოდულის tables-ზე წვდომა:
  - users, roles, permissions
  - cities, spots, spaces, cuisines  
  - restaurants, dishes, places, tables, reservations
```

### 🔧 API Project Setup
```bash
# 1. ახალი Laravel პროექტი
composer create-project laravel/laravel api-foodlyapp

# 2. საჭირო packages
composer require laravel/sanctum
composer require spatie/laravel-permission  
composer require astrotomic/laravel-translatable
composer require cloudinary-labs/cloudinary-laravel

# 3. Database კონფიგურაცია (.env)
DB_DATABASE=foodly  # არსებული ბაზა
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 4. მხოლოდ საჭირო Models-ების კოპირება (12 მოდული)
# 5. მხოლოდ API Controllers-ების შექმნა
# 6. Clean API Routes შექმნა
```

### 📋 Models რომლებიც ჭირდება
```php
// User Management
User.php
Role.php  
Permission.php

// Geographic & Categories
City.php + CityTranslation.php
Spot.php + SpotTranslation.php
Space.php + SpaceTranslation.php
Cuisine.php + CuisineTranslation.php

// Restaurant System
Restaurant.php + RestaurantTranslation.php
Dish.php + DishTranslation.php
Place.php + PlaceTranslation.php
Table.php + TableTranslation.php
Reservation.php
```

---

## 🗄️ Database Strategy

### ✅ Shared Database (რეკომენდებული)
```
არსებული Database: foodly
  ↓
Admin Project: admin-foodlyapp (იყენებს სრულ ბაზას)
API Project: api-foodlyapp (იყენებს იგივე ბაზას, მხოლოდ 12 მოდული)

Benefits:
✅ არ ჭირდება მონაცემების კოპირება
✅ Real-time data sync ორივე პროექტს შორის  
✅ ერთი ბაზის მხოლოდ ერთი backup
✅ უფრო მარტივი development
✅ მონაცემები ყოველთვის სინქრონიზებული
```

### Database Access Control
```php
// API Project Models - მხოლოდ საჭირო tables
API Project იყენებს:
- users, roles, permissions  
- cities, city_translations
- spots, spot_translations  
- spaces, space_translations
- cuisines, cuisine_translations
- restaurants, restaurant_translations
- dishes, dish_translations
- places, place_translations
- tables, table_translations
- reservations

API Project არ იყენებს:
- kiosks, menu_categories, products
- analytics, monitoring tables
- bog_payments, queue_jobs
- notifications, email_logs
```

---

## 🔧 Configuration Differences

### Admin Dashboard .env (უცვლელი)
```env
APP_NAME="Foodly Admin Dashboard"
APP_URL=https://admin.foodlyapp.ge

# სრული feature set
LIVEWIRE_ENABLED=true
HORIZON_ENABLED=true
ANALYTICS_ENABLED=true
BOG_PAYMENTS_ENABLED=true
QUEUE_MONITORING_ENABLED=true

# Database (არსებული)
DB_DATABASE=foodly
DB_HOST=127.0.0.1
DB_PORT=3306
```

### API Project .env (ახალი)
```env
APP_NAME="Foodly API"
APP_URL=https://api.foodlyapp.ge

# API only features
SANCTUM_ENABLED=true
API_RATE_LIMITING=true
CORS_ENABLED=true

# იგივე Database - მხოლოდ read/write access 12 მოდულზე
DB_DATABASE=foodly
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=api_user  # შესაძლოა ცალკე user
DB_PASSWORD=api_password

# Disable web features
SESSION_DRIVER=array
VIEW_CACHE=false
CACHE_DRIVER=redis
QUEUE_CONNECTION=sync
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

## 📋 API Project Setup Checklist

### ✅ Pre-Setup Tasks
- [ ] Create new repository for API project
- [ ] Set up separate development environment
- [ ] Document არსებული Kiosk API endpoints
- [ ] Plan database connection strategy
- [ ] Update CI/CD pipelines for API project

### ✅ Setup Tasks
- [ ] Create new Laravel API project
- [ ] Install required packages only (Sanctum, Spatie, etc.)
- [ ] Copy core Models (12 მოდული)
- [ ] Create clean API Controllers
- [ ] Remove unnecessary components (Livewire, etc.)
- [ ] Update configuration files (.env, config files)
- [ ] Connect to existing database
- [ ] Create clean API routes

### ✅ Testing Tasks  
- [ ] Test database connection
- [ ] Test all API endpoints
- [ ] Verify data access for 12 modules
- [ ] Test API authentication (Sanctum)
- [ ] Test rate limiting
- [ ] Performance testing

### ✅ Deployment Tasks
- [ ] Configure production servers
- [ ] Set up monitoring for API
- [ ] Deploy to production (api.foodlyapp.ge)
- [ ] Update mobile applications
- [ ] Monitor API performance
- [ ] Document new API endpoints

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
