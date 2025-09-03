# Database Migration Files for API Project

## 📋 Core Migration Files Needed for API Project

### Authentication & Authorization
```
2014_10_12_000000_create_users_table.php
2014_10_12_100000_create_password_resets_table.php
2019_08_19_000000_create_failed_jobs_table.php
2019_12_14_000001_create_personal_access_tokens_table.php (Sanctum)
create_permission_tables.php (Spatie Permission)
```

### Core Business Tables
```bash
# Cities
2025_08_06_013145_create_cities_table.php
2025_08_06_013146_create_city_translations_table.php

# Spaces
2025_05_13_084814_create_spaces_table.php
2025_05_13_084815_create_space_translations_table.php

# Cuisines  
2025_05_07_075958_create_cuisines_table.php
2025_05_07_080003_create_cuisine_translations_table.php

# Spots
2025_05_28_210631_create_spots_table.php
2025_05_28_210632_create_spot_translations_table.php

# Restaurants
2025_05_07_122842_create_restaurants_table_unified.php
2025_05_07_122858_create_restaurant_translations_table.php

# Dishes
2025_05_19_203620_create_dishes_table.php
2025_05_19_203621_create_dish_translations_table.php

# Places
2025_05_07_124838_create_places_table.php
2025_05_07_124839_create_place_translations_table.php

# Tables
2025_05_07_205929_create_tables_table.php
2025_05_07_205930_create_table_translations_table.php

# Reservations
2025_06_01_160000_create_reservations_table.php

# Relationship Tables
2025_05_26_131612_create_cuisine_restaurant_table.php
2025_06_01_160744_create_restaurant_dish_table.php
2025_05_29_000114_create_restaurant_spot_table.php
2025_05_13_133529_create_restaurant_space_table_unified.php
```

---

## 🗂️ Migration Files to EXCLUDE (Admin Dashboard Only)

### Exclude These Migrations
```bash
❌ create_kiosks_table.php
❌ create_bog_transactions_table.php
❌ create_bog_api_tokens_table.php
❌ create_notification_logs_table.php
❌ create_notification_events_table.php
❌ create_analytics_*.php
❌ create_page_views_table.php
❌ create_menu_categories_table.php
❌ create_menu_items_table.php
❌ create_products_table.php
❌ create_categories_table.php
❌ create_failed_jobs_table.php (if not using queues)
❌ create_jobs_table.php
❌ horizon related tables
```

---

## 📝 Required Migration Content for API Project

### 1. Users Table (Standard Laravel)
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

### 2. Cities Table
```php
Schema::create('cities', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();
    $table->integer('rank')->nullable();
    $table->string('image')->nullable();
    $table->string('image_link')->nullable();
    $table->string('status')->default('active');
    $table->timestamps();
});
```

### 3. City Translations Table  
```php
Schema::create('city_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
    $table->string('locale', 10);
    $table->string('name', 100);
    $table->text('description')->nullable();
    $table->timestamps();
    $table->unique(['city_id', 'locale']);
});
```

### 4. Spaces Table
```php
Schema::create('spaces', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();
    $table->integer('rank')->nullable();
    $table->string('image')->nullable();
    $table->string('image_link')->nullable();
    $table->enum('status', ['active', 'inactive'])->default('inactive');
    $table->timestamps();
});
```

### 5. Space Translations Table
```php
Schema::create('space_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('space_id')->constrained('spaces')->cascadeOnDelete();
    $table->string('locale', 10);
    $table->string('name', 100);
    $table->text('description')->nullable();
    $table->timestamps();
    $table->unique(['space_id', 'locale']);
});
```

### 6. Cuisines Table
```php
Schema::create('cuisines', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();
    $table->enum('status', ['active', 'inactive'])->default('inactive');
    $table->integer('rank')->default(0);
    $table->string('image')->nullable();
    $table->string('image_link')->nullable();
    $table->string('icon')->nullable();
    $table->string('icon_link')->nullable();
    $table->timestamps();
});
```

### 7. Cuisine Translations Table
```php
Schema::create('cuisine_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cuisine_id')->constrained('cuisines')->cascadeOnDelete();
    $table->string('locale', 10);
    $table->string('name', 100);
    $table->text('description')->nullable();
    $table->timestamps();
    $table->unique(['cuisine_id', 'locale']);
});
```

### 8. Spots Table
```php
Schema::create('spots', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();
    $table->integer('rank')->nullable();
    $table->string('image')->nullable();
    $table->string('image_link')->nullable();
    $table->enum('status', ['active', 'inactive'])->default('inactive');
    $table->timestamps();
});
```

### 9. Spot Translations Table
```php
Schema::create('spot_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('spot_id')->constrained('spots')->cascadeOnDelete();
    $table->string('locale', 10);
    $table->string('name', 100);
    $table->text('description')->nullable();
    $table->timestamps();
    $table->unique(['spot_id', 'locale']);
});
```

### 10. Restaurants Table (Core Business)
```php
Schema::create('restaurants', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();
    
    // QR Code fields
    $table->string('qr_code')->nullable();
    $table->string('qr_code_image')->nullable();
    $table->string('qr_code_link')->nullable();
    
    $table->string('time_zone')->nullable();
    
    // Basic restaurant info
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->integer('rank')->default(0);
    $table->string('logo')->nullable();
    $table->string('image')->nullable();
    $table->string('video')->nullable();
    
    // Contact info
    $table->string('phone')->nullable();
    $table->string('whatsapp')->nullable();
    $table->string('email')->nullable();
    $table->string('website')->nullable();
    
    // Business details
    $table->integer('discount_rate')->default(0);
    $table->string('price_per_person')->nullable();
    $table->enum('price_currency', ['GEL', 'USD', 'EUR', 'AED', 'HUF', 'CZK'])->nullable()->default(null);
    $table->string('working_hours')->nullable();
    $table->integer('delivery_time')->nullable();
    $table->string('reservation_type')->nullable();
    
    // Location details
    $table->string('map_link')->nullable();
    $table->decimal('latitude', 10, 6)->nullable();
    $table->decimal('longitude', 10, 6)->nullable();
    $table->text('map_embed_link')->nullable();
    
    // Timestamps and user tracking
    $table->timestamps();
    $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
    $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
    $table->unsignedInteger('version')->default(1);
});
```

### 11. Restaurant Translations Table
```php
Schema::create('restaurant_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
    $table->string('locale');
    $table->string('name');
    $table->text('description')->nullable();
    $table->string('address')->nullable();
    $table->timestamps();
    $table->unique(['restaurant_id', 'locale']);
});
```

### 12. Dishes Table
```php
Schema::create('dishes', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();
    $table->enum('status', ['active', 'inactive'])->default('inactive');
    $table->integer('rank')->default(0);
    $table->string('image')->nullable();
    $table->string('image_link')->nullable();
    $table->timestamps();
});
```

### 13. Dish Translations Table
```php
Schema::create('dish_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('dish_id')->constrained('dishes')->cascadeOnDelete();
    $table->string('locale', 10);
    $table->string('name', 100);
    $table->text('description')->nullable();
    $table->timestamps();
    $table->unique(['dish_id', 'locale']);
});
```

### 14. Places Table
```php
Schema::create('places', function (Blueprint $table) {
    $table->id();
    $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
    $table->string('slug')->unique();
    
    // QR Code fields
    $table->string('qr_code')->nullable();
    $table->string('qr_code_image')->nullable();
    $table->string('qr_code_link')->nullable();
    
    // Basic details
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->unsignedInteger('rank')->default(0);
    $table->string('image')->nullable();       // Local image path
    $table->string('image_link')->nullable();  // External image link
    
    $table->timestamps();
});
```

### 15. Place Translations Table
```php
Schema::create('place_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('place_id')->constrained('places')->cascadeOnDelete();
    $table->string('locale', 10);
    $table->string('name', 100);
    $table->text('description')->nullable();
    $table->timestamps();
    $table->unique(['place_id', 'locale']);
});
```

### 16. Tables Table
```php
Schema::create('tables', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();
    
    // QR Code fields  
    $table->string('qr_code')->nullable();
    $table->string('qr_code_image')->nullable();
    $table->string('qr_code_link')->nullable();
    
    // Foreign keys
    $table->foreignId('restaurant_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('place_id')->nullable()->constrained('places')->onDelete('set null');
    
    // Table details
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->longText('icon')->nullable();
    $table->longText('image')->nullable();
    $table->longText('image_link')->nullable(); 
    $table->unsignedInteger('rank')->default(0);
    $table->unsignedInteger('capacity')->default(1);
    
    $table->timestamps();
});
```

### 17. Table Translations Table
```php
Schema::create('table_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('table_id')->constrained('tables')->cascadeOnDelete();
    $table->string('locale', 10);
    $table->string('name', 100);
    $table->text('description')->nullable();
    $table->timestamps();
    $table->unique(['table_id', 'locale']);
});
```

### 18. Reservations Table
```php
Schema::create('reservations', function (Blueprint $table) {
    $table->id();
    $table->string('reservation_code')->unique();
    
    // Foreign keys
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
    $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
    $table->foreignId('place_id')->nullable()->constrained('places')->onDelete('set null');
    $table->foreignId('table_id')->nullable()->constrained('tables')->onDelete('set null');
    
    // Reservation details
    $table->string('customer_name');
    $table->string('customer_phone');
    $table->string('customer_email')->nullable();
    $table->unsignedInteger('party_size');
    $table->dateTime('reservation_date');
    $table->time('reservation_time');
    $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
    $table->text('notes')->nullable();
    $table->text('special_requests')->nullable();
    
    // Payment info
    $table->decimal('deposit_amount', 10, 2)->nullable();
    $table->enum('payment_status', ['pending', 'paid', 'refunded'])->default('pending');
    
    $table->timestamps();
    
    // Indexes
    $table->index(['restaurant_id', 'reservation_date']);
    $table->index(['status', 'reservation_date']);
});
```

### 19. Cuisine Restaurant Pivot Table
```php
Schema::create('cuisine_restaurant', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cuisine_id')->constrained()->onDelete('cascade');
    $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
    $table->integer('rank')->default(0);
    $table->enum('status', ['active', 'inactive'])->default('inactive');
    $table->timestamps();
    $table->unique(['cuisine_id', 'restaurant_id']);
});
```

### 20. Restaurant Dish Pivot Table
```php
Schema::create('restaurant_dish', function (Blueprint $table) {
    $table->id();
    $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
    $table->foreignId('dish_id')->constrained()->onDelete('cascade');
    $table->unsignedTinyInteger('rank')->default(0);
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->timestamps();
});
```

### 21. Restaurant Spot Pivot Table
```php
Schema::create('restaurant_spot', function (Blueprint $table) {
    $table->id();
    $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
    $table->foreignId('spot_id')->constrained()->cascadeOnDelete();
    $table->integer('rank')->default(0);
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->timestamps();
    $table->unique(['restaurant_id', 'spot_id']);
});
```

### 22. Restaurant Space Pivot Table
```php
Schema::create('restaurant_space', function (Blueprint $table) {
    $table->foreignId('restaurant_id')->constrained('restaurants')->cascadeOnDelete();
    $table->foreignId('space_id')->constrained('spaces')->cascadeOnDelete();
    $table->integer('rank')->default(0);
    $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
    $table->timestamps();
    $table->primary(['restaurant_id', 'space_id']);
});
```

---

## 🔧 Database Seeder Files for API Project

### Required Seeders
```php
database/seeders/
├── DatabaseSeeder.php
├── UserSeeder.php
├── RolePermissionSeeder.php (from Spatie)
├── CitySeeder.php
├── SpaceSeeder.php  
├── CuisineSeeder.php
├── SpotSeeder.php
├── RestaurantSeeder.php
├── DishSeeder.php
├── PlaceSeeder.php
├── TableSeeder.php
├── ReservationSeeder.php
└── RelationshipSeeders/
    ├── RestaurantCuisineSeeder.php
    ├── RestaurantDishSeeder.php
    ├── RestaurantSpotSeeder.php
    └── RestaurantSpaceSeeder.php
```

### Sample DatabaseSeeder.php for API Project
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users & Permissions (Authentication)
        $this->call([
            UserSeeder::class,
            RolePermissionSeeder::class,
        ]);

        // 2. Geographic & Core Data
        $this->call([
            CitySeeder::class,
            SpaceSeeder::class,
            CuisineSeeder::class,
            SpotSeeder::class,
        ]);

        // 3. Business Data
        $this->call([
            RestaurantSeeder::class,
            DishSeeder::class,
            PlaceSeeder::class,
            TableSeeder::class,
            ReservationSeeder::class,
        ]);

        // 4. Relationships
        $this->call([
            RestaurantCuisineSeeder::class,
            RestaurantDishSeeder::class,
            RestaurantSpotSeeder::class,
            RestaurantSpaceSeeder::class,
        ]);
    }
}
```

---

## 🏗️ Migration Execution Order

### Recommended Migration Order
```bash
1. create_users_table
2. create_password_resets_table  
3. create_failed_jobs_table
4. create_personal_access_tokens_table (Sanctum)
5. create_permission_tables (Spatie)

6. create_cities_table
7. create_city_translations_table

8. create_spaces_table
9. create_space_translations_table

10. create_cuisines_table
11. create_cuisine_translations_table

12. create_spots_table
13. create_spot_translations_table

14. create_restaurants_table
15. create_restaurant_translations_table

16. create_dishes_table
17. create_dish_translations_table

18. create_places_table
19. create_place_translations_table

20. create_tables_table
21. create_table_translations_table

22. create_reservations_table

23. create_cuisine_restaurant_table
24. create_restaurant_dish_table
25. create_restaurant_spot_table
26. create_restaurant_space_table
```

---

## 📊 Database Indexes for Performance

### Essential Indexes for API Performance
```php
// In migrations, add these indexes:

// Restaurants table
$table->index(['status', 'rank']);
$table->index(['created_at']);
$table->fullText(['name', 'description']); // For search

// Translation tables
$table->index(['locale']);
$table->index(['name']);

// Pivot tables
$table->index(['rank', 'status']);
$table->index(['created_at']);

// Geographic tables
$table->index(['status']);
$table->index(['rank']);
```

---

## 🔄 Migration Script for API Project Setup

### Bash Script for Migration Setup
```bash
#!/bin/bash

echo "Setting up API Project Database..."

# Run core migrations
php artisan migrate --path=database/migrations/2014_10_12_000000_create_users_table.php
php artisan migrate --path=database/migrations/2014_10_12_100000_create_password_resets_table.php
php artisan migrate --path=database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php

# Run Spatie Permission migrations
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

# Run core business migrations in order
echo "Running core business table migrations..."
php artisan migrate --path=database/migrations/2025_08_06_013145_create_cities_table.php
php artisan migrate --path=database/migrations/2025_08_06_013146_create_city_translations_table.php
php artisan migrate --path=database/migrations/2025_05_13_084814_create_spaces_table.php
php artisan migrate --path=database/migrations/2025_05_13_084815_create_space_translations_table.php
php artisan migrate --path=database/migrations/2025_05_07_075958_create_cuisines_table.php
php artisan migrate --path=database/migrations/2025_05_07_080003_create_cuisine_translations_table.php
php artisan migrate --path=database/migrations/2025_05_28_210631_create_spots_table.php
php artisan migrate --path=database/migrations/2025_05_28_210632_create_spot_translations_table.php
php artisan migrate --path=database/migrations/2025_05_07_122842_create_restaurants_table_unified.php
php artisan migrate --path=database/migrations/2025_05_07_122858_create_restaurant_translations_table.php
php artisan migrate --path=database/migrations/2025_05_19_203620_create_dishes_table.php
php artisan migrate --path=database/migrations/2025_05_19_203621_create_dish_translations_table.php

# Run relationship migrations
echo "Running relationship table migrations..."
php artisan migrate --path=database/migrations/2025_05_26_131612_create_cuisine_restaurant_table.php
php artisan migrate --path=database/migrations/2025_06_01_160744_create_restaurant_dish_table.php
php artisan migrate --path=database/migrations/2025_05_29_000114_create_restaurant_spot_table.php
php artisan migrate --path=database/migrations/2025_05_13_133529_create_restaurant_space_table_unified.php

echo "Database migration completed!"

# Run seeders
echo "Running seeders..."
php artisan db:seed

echo "API Project database setup completed successfully!"
```

---

## 🔍 Migration Verification Checklist

### ✅ Pre-Migration Checklist
- [ ] All required migration files copied to new project
- [ ] Foreign key relationships verified
- [ ] Translation table structures match parent tables
- [ ] Pivot table unique constraints added
- [ ] Proper cascade delete rules set
- [ ] Index definitions included for performance

### ✅ Post-Migration Verification
```bash
# Verify all tables exist
php artisan tinker
>>> Schema::hasTable('users')
>>> Schema::hasTable('restaurants')
>>> Schema::hasTable('restaurant_translations')
>>> Schema::hasTable('cuisines')
>>> Schema::hasTable('cuisine_translations')
>>> Schema::hasTable('dishes')
>>> Schema::hasTable('dish_translations')
>>> Schema::hasTable('spots')
>>> Schema::hasTable('spot_translations')
>>> Schema::hasTable('spaces')
>>> Schema::hasTable('space_translations')
>>> Schema::hasTable('cities')
>>> Schema::hasTable('city_translations')
>>> Schema::hasTable('cuisine_restaurant')
>>> Schema::hasTable('restaurant_dish')
>>> Schema::hasTable('restaurant_spot')
>>> Schema::hasTable('restaurant_space')

# Test model relationships
>>> App\Models\Restaurant::with('cuisines')->first()
>>> App\Models\Cuisine::with('restaurants')->first()
>>> App\Models\Restaurant::with('translations')->first()
```

---

## 📈 Database Optimization Tips

### Performance Optimization
```sql
-- Add composite indexes for common queries
ALTER TABLE restaurants ADD INDEX idx_status_rank (status, rank);
ALTER TABLE restaurant_translations ADD INDEX idx_locale_name (locale, name);

-- Add full-text search indexes
ALTER TABLE restaurant_translations ADD FULLTEXT idx_search (name, description, address);
ALTER TABLE cuisine_translations ADD FULLTEXT idx_search (name, description);

-- Analyze table statistics
ANALYZE TABLE restaurants, restaurant_translations, cuisines, cuisine_translations;
```

### Monitoring Queries
```php
// Enable query logging in development
DB::enableQueryLog();
// Run your API endpoints
dd(DB::getQueryLog());
```

---

*ეს დოკუმენტი მოიცავს ყველა საჭირო ინფორმაციას API პროექტისთვის სწორი database migration-ების შესაქმნელად და განსახორციელებლად.*
