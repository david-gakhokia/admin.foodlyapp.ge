# API Fixes Documentation
*თარიღი: 16 ივლისი, 2025*

## 🔧 გასწორებული პრობლემები

### 1. SQL Integrity Constraint Violation (Column Ambiguity)

**პრობლემა:** 
Many-to-Many ურთიერთობებში pivot ცხრილებსა და მთავარ ცხრილებს ერთნაირი სახელის სვეტები ჰქონდა (`status`, `rank`), რის გამოც SQL შეცდომა ხდებოდა.

**შეცდომის მაგალითი:**
```
SQLSTATE[23000]: Integrity constraint violation: 1052 Column 'status' in where clause is ambiguous
```

**გამოსავალი:**
ცხრილის სახელის მითითება query-ებში:

```php
// ❌ არასწორი
->where('status', 'active')
->orderBy('rank', 'asc')

// ✅ სწორი
->where('restaurants.status', 'active')
->orderBy('restaurant_space.rank', 'asc')
```

### 2. გასწორებული კონტროლერები

#### KioskSpaceController.php
- `restaurantsBySpace()` მეთოდი
- `top10RestaurantsBySpace()` მეთოდი
- Pivot ცხრილი: `restaurant_space`

#### KioskCuisineController.php  
- `restaurantsByCuisine()` მეთოდი
- `top10RestaurantsByCuisine()` მეთოდი
- Pivot ცხრილი: `cuisine_restaurant`

#### KioskDishController.php
- `restaurantsByDish()` მეთოდი
- `top10RestaurantsByDish()` მეთოდი
- Pivot ცხრილი: `restaurant_dish`

### 3. API Resources-ის გაუმჯობესება

**DishResource.php და DishShortResource.php:**
- დავამატეთ MenuCategory-ების ინფორმაცია
- Eager loading: `with(['menuCategories.translations'])`

```php
'menu_categories' => $this->menuCategories->map(function ($menuCategory) {
    return [
        'id' => $menuCategory->id,
        'restaurant_id' => $menuCategory->restaurant_id,
        'slug' => $menuCategory->slug,
        'rank' => $menuCategory->rank,
        'status' => $menuCategory->status,
        'image' => $menuCategory->image,
        'image_link' => $menuCategory->image_link,
        'translations' => $menuCategory->translations->map(function ($tr) {
            return [
                'locale' => $tr->locale,
                'name' => $tr->name,
                'description' => $tr->description,
            ];
        }),
    ];
}),
```

### 4. Many-to-Many ურთიერთობები

**შექმნილი კავშირი:**
- Pizza Dish (ID: 1) ↔ Exodus Restaurant (ID: 1)
- Pivot ცხრილი: `restaurant_dish`
- Pivot მონაცემები: `rank=1, status='active'`

## 📋 API ენდპოინტები

### Dish API
```
GET /api/kiosk/dishes                           # ყველა dish
GET /api/kiosk/dishes/{slug}                    # კონკრეტული dish
GET /api/kiosk/dishes/{slug}/restaurants        # dish-ის რესტორნები
GET /api/kiosk/dishes/{slug}/top-10-restaurants # ტოპ 10 რესტორანი
```

### Space API
```
GET /api/kiosk/spaces                           # ყველა space
GET /api/kiosk/spaces/{slug}                    # კონკრეტული space
GET /api/kiosk/spaces/{slug}/restaurants        # space-ის რესტორნები
GET /api/kiosk/spaces/{slug}/top-10-restaurants # ტოპ 10 რესტორანი
```

### Cuisine API
```
GET /api/kiosk/cuisines                           # ყველა cuisine
GET /api/kiosk/cuisines/{slug}                    # კონკრეტული cuisine
GET /api/kiosk/cuisines/{slug}/restaurants        # cuisine-ის რესტორნები
GET /api/kiosk/cuisines/{slug}/top-10-restaurants # ტოპ 10 რესტორანი
```

## 🔄 Pivot ცხრილების სტრუქტურა

### restaurant_space
- `restaurant_id`
- `space_id`
- `rank`
- `status`
- `created_at`
- `updated_at`

### cuisine_restaurant
- `cuisine_id`
- `restaurant_id`
- `rank`
- `status`
- `created_at`
- `updated_at`

### restaurant_dish
- `restaurant_id`
- `dish_id`
- `rank`
- `status`
- `created_at`
- `updated_at`

## 🚨 მომავალი მუშაობისთვის რჩევები

### 1. Many-to-Many Query-ების წერისას:
```php
// ყოველთვის მიუთითეთ ცხრილის სახელი ambiguous სვეტებისთვის
$model->relatedModels()
    ->where('main_table.status', 'active')  // მთავარი ცხრილი
    ->orderBy('pivot_table.rank', 'asc')    // pivot ცხრილი
    ->get();
```

### 2. API Resources-ში Eager Loading:
```php
// Controller-ში
$model = Model::with(['relationship.translations'])->find($id);

// Resource-ში
'related_data' => $this->relationship->map(function ($item) {
    return [
        'id' => $item->id,
        'name' => $item->name,
        // სხვა ველები...
    ];
})
```

### 3. Pivot კავშირების შექმნა:
```php
// კავშირის შექმნა
$model1->relatedModels()->attach($model2->id, [
    'rank' => 1,
    'status' => 'active',
    'created_at' => now(),
    'updated_at' => now()
]);

// კავშირის წაშლა
$model1->relatedModels()->detach($model2->id);
```

### 4. Debugging Commands:
```bash
# მოდელის კავშირების შემოწმება
php artisan tinker --execute="echo Model::with('relationships')->find(1)->toJson(JSON_PRETTY_PRINT);"

# Pivot ცხრილის შემოწმება
php artisan tinker --execute="echo DB::table('pivot_table_name')->get()->toJson(JSON_PRETTY_PRINT);"

# Route-ების სია
php artisan route:list --name=specific_name
```

## ✅ დასრულებული ამოცანები

1. ✅ SQL Column Ambiguity გასწორება
2. ✅ KioskSpaceController API fixes
3. ✅ KioskCuisineController API fixes  
4. ✅ KioskDishController API fixes
5. ✅ DishResource-ში MenuCategory ინფორმაცია
6. ✅ Pizza-Exodus კავშირის შექმნა
7. ✅ API ტესტირება და ვერიფიკაცია

---

**შენიშვნა:** ეს დოკუმენტაცია შექმნილია პროექტის API-ების გასწორების შემდეგ. ყველა ცვლილება ტესტირებულია და მუშაობს სწორად.
