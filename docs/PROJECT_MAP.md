# FOODLY API - Project Structure Map
*განახლების თარიღი: 16 ივლისი, 2025*

## 🗺️ პროექტის არქიტექტურა

### Core Models და ურთიერთობები

```
Restaurant (მთავარი Entity)
├── Many-to-Many → Space (რესტორნების ლოკაციები)
├── Many-to-Many → Cuisine (სამზარეულო ტიპები) 
├── Many-to-Many → Dish (კერძები)
├── One-to-Many → MenuCategory (მენიუს კატეგორიები)
└── One-to-Many → MenuItem (მენიუს პუნქტები)

Space (ლოკაციები/ადგილები)
├── belongsToMany → Restaurant
└── hasMany → MenuCategory

Cuisine (სამზარეულო ტიპები)
├── belongsToMany → Restaurant
└── Translatable

Dish (კერძები)
├── belongsToMany → Restaurant
├── hasMany → MenuCategory
└── Translatable

MenuCategory (მენიუს კატეგორიები)
├── belongsTo → Restaurant
├── belongsTo → Dish
├── belongsTo → Space (არაპირდაპირი კავშირი)
└── Translatable
```

### 📊 Pivot Tables (Many-to-Many კავშირები)

#### `restaurant_space`
```sql
- restaurant_id (FK)
- space_id (FK)
- rank (ordering)
- status (active/inactive)
- created_at, updated_at
```

#### `cuisine_restaurant`
```sql
- cuisine_id (FK)
- restaurant_id (FK)
- rank (ordering)
- status (active/inactive)
- created_at, updated_at
```

#### `restaurant_dish`
```sql
- restaurant_id (FK)
- dish_id (FK)
- rank (ordering)
- status (active/inactive)
- created_at, updated_at
```

## 🎯 API ენდპოინტების სტრუქტურა

### Kiosk API Pattern
ყველა Kiosk Controller მიყვება ერთნაირ პატერნს:

```
/api/kiosk/{resource}/
├── GET / (index) - ყველა resource-ის სია
├── GET /{slug} (show) - კონკრეტული resource
├── GET /{slug}/restaurants - resource-ის რესტორნები
└── GET /{slug}/top-10-restaurants - ტოპ 10 რესტორანი
```

#### Controllers და მათი პასუხისმგებლობები:

**KioskSpaceController**
- Spaces მართვა
- Space-ის რესტორნების მიღება
- Pivot: `restaurant_space`

**KioskCuisineController**
- Cuisines მართვა  
- Cuisine-ის რესტორნების მიღება
- Pivot: `cuisine_restaurant`

**KioskDishController**
- Dishes მართვა
- Dish-ის რესტორნების მიღება
- MenuCategories ინფორმაცია
- Pivot: `restaurant_dish`

**KioskAvailabilityController**
- რესტორნების ხელმისაწვდომობა
- სივრცეების/მაგიდების availability
- რეალურ დროში სლოტების მართვა
- AvailabilityService-თან ინტეგრაცია

## 🏗️ ფაილების სტრუქტურა

### Controllers
```
app/Http/Controllers/Kiosk/
├── KioskSpaceController.php
├── KioskCuisineController.php
├── KioskDishController.php
├── KioskAvailabilityController.php
└── ... (სხვა kiosk controllers)
```

### Models
```
app/Models/
├── Restaurant.php (მთავარი Entity)
├── Space.php
├── Cuisine.php
├── Dish.php
├── MenuCategory.php
├── MenuItem.php
└── ...Translation.php (თარგმანები)
```

### Resources (API Responses)
```
app/Http/Resources/
├── RestaurantShortResource.php
├── Space/
│   ├── SpaceResource.php
│   └── SpaceShortResource.php
├── Cuisine/
│   ├── CuisineResource.php
│   └── CuisineShortResource.php
└── Dish/
    ├── DishResource.php
    └── DishShortResource.php
```

## 🔧 Technical Patterns

### 1. Many-to-Many Query Pattern
```php
// ✅ სწორი მიდგომა
$model->relatedModels()
    ->where('main_table.status', 'active')
    ->orderBy('pivot_table.rank', 'asc')
    ->get();
```

### 2. Eager Loading Pattern
```php
// Controller-ში
Model::with(['relationship.translations'])

// Resource-ში eager loaded data-ს გამოყენება
'related_data' => $this->relationship->map(...)
```

### 3. Translatable Pattern
ყველა მთავარი მოდელი იყენებს Astrotomic/Translatable:
- `$translatedAttributes = ['name', 'description']`
- თარგმანები ცალკე ცხრილებში ინახება
- API Resources-ში translations array ან locale-specific data

### 4. Resource Response Pattern
```php
// Short Resource - სიებისთვის
return [
    'id' => $this->id,
    'slug' => $this->slug,
    'name' => $this->name,
    // მინიმალური ინფორმაცია
];

// Full Resource - დეტალური ნახვისთვის  
return [
    'id' => $this->id,
    'slug' => $this->slug,
    'name' => $this->name,
    'related_data' => $this->relationship->map(...),
    'translations' => $this->translations->map(...),
    // სრული ინფორმაცია
];
```

## 📋 ტიპური პრობლემები და გამოსავლები

### Column Ambiguity
**პრობლემა:** Pivot ცხრილებში status/rank სვეტების კონფლიქტი
**გამოსავალი:** ცხრილის სახელის მითითება

### Missing Relationships
**პრობლემა:** API-ში related data არ მოდის
**გამოსავალი:** Eager loading + Resource-ში mapping

### Empty Results
**პრობლემა:** Pivot ცხრილში კავშირები არ არსებობს
**გამოსავალი:** Manual attachment ან Seeder-ები

## 🎨 Development Workflow

### 1. ახალი Feature-ის დამატება
```bash
1. Model შექმნა migrations-ით
2. Relationships დაწერა
3. Controller შექმნა (Kiosk pattern-ის გამოყენებით)
4. Resource Classes შექმნა
5. Routes რეგისტრაცია
6. API ტესტირება
```

### 2. Debugging Process
```bash
# მოდელის შემოწმება
php artisan tinker --execute="Model::with('relationships')->find(1)"

# Pivot კავშირების შემოწმება  
php artisan tinker --execute="DB::table('pivot_table')->get()"

# Routes ვერიფიკაცია
php artisan route:list --name=pattern
```

## 🚀 Next Steps Checklist

### ახალი Controller-ის დამატებისას:
- [ ] Model relationships გადამოწმება
- [ ] Pivot ცხრილების სტრუქტურა
- [ ] Column ambiguity თავიდან არიდება
- [ ] Eager loading სწორად დაწერა
- [ ] Resource Classes შექმნა
- [ ] API endpoint pattern-ის შენარჩუნება
- [ ] Error handling დამატება
- [ ] ტესტირება

### ახალი Model-ის დამატებისას:
- [ ] Migration სწორად დაწერა
- [ ] Translatable setup (თუ საჭიროა)
- [ ] Relationships სწორად აღწერა
- [ ] Pivot ცხრილები (თუ many-to-many)
- [ ] Model constants (STATUS_* და სხვა)
- [ ] Scope methods
- [ ] Accessor/Mutator methods

## 📖 ცნობარი

### სასარგებლო Commands
```bash
# Models სია
php artisan model:show ModelName

# Migration რევერტი
php artisan migrate:rollback

# Cache გასუფთავება
php artisan cache:clear && php artisan config:clear

# DB Refresh + Seed
php artisan migrate:fresh --seed
```

### კოდის სტანდარტები
- PSR-12 formatting
- Laravel naming conventions
- Georgian კომენტარები/დოკუმენტაცია
- Consistent error responses
- RESTful API principles

---

**შენიშვნა:** ეს არის მუშაობის პრინციპების დოკუმენტი. ყოველი განახლების შემდეგ ასევე განაახლეთ ეს ფაილი.
