# 🏪 Kiosk API - Complete Documentation

## 📋 Overview
Kiosk API არის სპეციალურად კიოსკ ტერმინალებისთვის შექმნილი API endpoint-ების კოლექცია. ეს API უზრუნველყოფს რესტორნების, სივრცეების, კერძების, მაგიდების და ხელმისაწვდომობის ინფორმაციას.

## 🔐 Authentication
ყველა Kiosk API endpoint საჭიროებს authentication (გარდა login-ისა):
```
Authorization: Bearer {kiosk_token}
```

## 🌐 Base URL
```
/api/kiosk/
```

---

## 📚 Table of Contents

1. [🔐 Authentication](#authentication-endpoints)
2. [🏡 Restaurants](#restaurant-endpoints)
3. [🍽️ Menu System](#menu-system-endpoints)
4. [🏢 Spaces](#space-endpoints)
5. [🍽️ Cuisines](#cuisine-endpoints)
6. [🥘 Dishes](#dish-endpoints)
7. [📍 Spots](#spot-endpoints)
8. [🗂️ Categories](#category-endpoints)
9. [🕐 Availability](#availability-endpoints)
10. [⚙️ Technical Details](#technical-implementation)

---

## 🔐 Authentication Endpoints

### Kiosk Login
**POST** `/api/kiosk/login`

```json
// Request
{
  "identifier": "kiosk_001",
  "secret": "kiosk_secret_key"
}

// Response
{
  "kiosk": {
    "id": 1,
    "identifier": "kiosk_001",
    "name": "Mall Kiosk 1",
    "location": "East Point Mall",
    "status": "active"
  },
  "token": "2|laravel_sanctum_token_for_kiosk"
}
```

### Kiosk Heartbeat
**POST** `/api/kiosk/heartbeat` 🔒
- აღნიშნავს რომ კიოსკი მუშაობს

### Get All Kiosks Status
**GET** `/api/kiosk/status` 🔒

### Get Kiosk Configuration
**GET** `/api/kiosk/config` 🔒

---

## 🏡 Restaurant Endpoints

### Get All Restaurants
**GET** `/api/kiosk/restaurants`
- **Query Parameters:** `search`, `per_page`, `sort`

### Get Restaurant by Slug
**GET** `/api/kiosk/restaurants/{slug}`

### Get Restaurant Details
**GET** `/api/kiosk/restaurants/{slug}/details`

### Get Restaurant Places
**GET** `/api/kiosk/restaurants/{slug}/places`

### Get Specific Place
**GET** `/api/kiosk/restaurants/{slug}/place/{place}`

### Get Tables in Place
**GET** `/api/kiosk/restaurants/{slug}/place/{place}/tables`

### Get All Restaurant Tables
**GET** `/api/kiosk/restaurants/{slug}/tables`

### Get Specific Table
**GET** `/api/kiosk/restaurants/{slug}/table/{table}`

### Get Table in Specific Place
**GET** `/api/kiosk/restaurants/{slug}/place/{place}/table/{table}`

---

## 🍽️ Menu System Endpoints

### Get Menu Categories
**GET** `/api/kiosk/restaurants/{slug}/menu/categories`

### Get Menu Items
**GET** `/api/kiosk/restaurants/{slug}/menu/items`

### Get Full Menu Structure
**GET** `/api/kiosk/restaurants/{slug}/menu`
- აბრუნებს hierarchical menu-ს categories და items-ით

---

## 🏢 Space Endpoints

### Get All Spaces
**GET** `/api/kiosk/spaces`
- აბრუნებს ყველა აქტიურ სივრცეს rank-ის მიხედვით დალაგებულს

### Get Space by Slug
**GET** `/api/kiosk/spaces/{slug}`

```json
// Response Example
{
  "id": 1,
  "slug": "shopping-mall",
  "status": "active",
  "rank": 1,
  "image": "https://example.com/space.jpg",
  "image_link": null,
  "translations": [
    {
      "locale": "en",
      "name": "Shopping Mall",
      "description": "Large shopping center"
    },
    {
      "locale": "ka",
      "name": "სავაჭრო ცენტრი",
      "description": "დიდი სავაჭრო ცენტრი"
    }
  ]
}
```

### Get Restaurants by Space
**GET** `/api/kiosk/spaces/{slug}/restaurants`
- 🔧 **Fixed:** SQL Column Ambiguity - ახლა იყენებს `restaurants.status` და `restaurant_space.rank`

### Get Top 10 Restaurants by Space
**GET** `/api/kiosk/spaces/{slug}/top-10-restaurants`

---

## 🍽️ Cuisine Endpoints

### Get All Cuisines
**GET** `/api/kiosk/cuisines`
- აბრუნებს ყველა აქტიურ სამზარეულოს ტიპს rank-ის მიხედვით

### Get Cuisine by Slug
**GET** `/api/kiosk/cuisines/{slug}`

### Get Restaurants by Cuisine
**GET** `/api/kiosk/cuisines/{slug}/restaurants`
- 🔧 **Fixed:** იყენებს `restaurants.status` და `cuisine_restaurant.rank`

**Common Cuisine Slugs:**
- `georgian` - ქართული სამზარეულო
- `italian` - იტალიური სამზარეულო
- `asian` - აზიური სამზარეულო
- `european` - ევროპული სამზარეულო

### Get Top 10 Restaurants by Cuisine
**GET** `/api/kiosk/cuisines/{slug}/top-10-restaurants`

---

## 🥘 Dish Endpoints

### Get All Dishes
**GET** `/api/kiosk/dishes`
- აბრუნებს ყველა კერძს MenuCategory-ების ინფორმაციით

### Get Dish by Slug
**GET** `/api/kiosk/dishes/{slug}`

```json
// Response Example
{
  "id": 1,
  "status": "active",
  "slug": "pizza",
  "rank": 1,
  "image": "https://example.com/pizza.jpg",
  "image_link": null,
  "icon": null,
  "icon_link": null,
  "menu_categories": [
    {
      "id": 4,
      "restaurant_id": 1,
      "slug": "pizza",
      "rank": 4,
      "status": "active",
      "image": "https://example.com/menu-pizza.jpg",
      "image_link": null,
      "translations": [
        {
          "locale": "en",
          "name": "Pizza",
          "description": ""
        },
        {
          "locale": "ka",
          "name": "პიცა",
          "description": ""
        },
        {
          "locale": "ru",
          "name": "пицца",
          "description": ""
        }
      ]
    }
  ],
  "translations": [
    {
      "locale": "en",
      "name": "Pizza"
    },
    {
      "locale": "ka", 
      "name": "პიცა"
    },
    {
      "locale": "ru",
      "name": "Pizza34"
    }
  ]
}
```

### Get Restaurants by Dish
**GET** `/api/kiosk/dishes/{slug}/restaurants`
- **Query Parameters:** `locale` (en, ka, ru)

### Get Top 10 Restaurants by Dish
**GET** `/api/kiosk/dishes/{slug}/top-10-restaurants`

---

## 📍 Spot Endpoints

### Get All Spots
**GET** `/api/kiosk/spots`

### Get Spot by Slug
**GET** `/api/kiosk/spots/{slug}`

### Get Restaurants by Spot
**GET** `/api/kiosk/spots/{slug}/restaurants`

### Get Top 10 Restaurants by Spot
**GET** `/api/kiosk/spots/{slug}/top-10-restaurants`

---

## 🗂️ Category Endpoints

### Get All Categories
**GET** `/api/kiosk/categories`

### Get Category by Slug
**GET** `/api/kiosk/categories/{slug}`

---

## 🕐 Availability Endpoints

### Restaurant Availability
**GET** `/api/kiosk/availability/restaurant/{slug}`
- **Parameters:** `date` (Y-m-d format, optional)

```json
// Response Example
{
  "success": true,
  "data": {
    "restaurant": {
      "id": 1,
      "name": "Georgian House",
      "slug": "georgian-house",
      "timezone": "Asia/Tbilisi",
      "working_hours": "10:00-22:00"
    },
    "date": "2025-07-20",
    "day_of_week": "Sunday",
    "available_slots": [
      "10:00", "10:30", "11:00", "11:30",
      "18:00", "18:30", "19:00", "19:30"
    ],
    "weekly_hours": {
      "Monday": [
        {
          "day": "Monday",
          "time_from": "10:00:00",
          "time_to": "22:00:00",
          "available": true,
          "max_guests": 50,
          "slot_interval_minutes": 30
        }
      ]
    }
  }
}
```

### Place Availability
**GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}`

### Table Availability (with Place)
**GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}/table/{tableSlug}`

### Direct Table Availability
**GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/table/{tableSlug}`

---

## ⚙️ Technical Implementation

### 🔍 Query Patterns Used

#### Spaces → Restaurants:
```php
$space->restaurants()
    ->where('restaurants.status', 'active')
    ->orderBy('restaurant_space.rank', 'asc')
```

#### Cuisines → Restaurants:
```php
$cuisine->restaurants()
    ->where('restaurants.status', 'active')
    ->orderBy('cuisine_restaurant.rank', 'asc')
```

#### Dishes → Restaurants:
```php
$dish->restaurants()
    ->where('restaurants.status', 'active')
    ->orderBy('restaurant_dish.rank', 'asc')
```

#### Availability Service:
```php
$availabilityService->generateAvailableSlots(
    $restaurant, $date, $dayOfWeek
)
```

### 🗄️ Pivot Table Structure

| Table | Columns | Purpose |
|-------|---------|---------|
| `restaurant_space` | restaurant_id, space_id, rank | Space rankings |
| `cuisine_restaurant` | cuisine_id, restaurant_id, rank | Cuisine rankings |
| `restaurant_dish` | restaurant_id, dish_id, rank | Dish rankings |

### 📊 Response Format

#### Success Response:
```json
{
  "success": true,
  "data": { /* response data */ }
}
```

#### Error Response:
```json
{
  "success": false,
  "error": "Error message",
  "message": "Detailed error message (optional)"
}
```

#### Paginated Response:
```json
{
  "data": [ /* items */ ],
  "meta": {
    "per_page": 20,
    "current_page": 1,
    "last_page": 5,
    "total": 87
  }
}
```

### 🔧 Fixed Issues (17 July, 2025)

- ✅ **SQL Column Ambiguity:** Fixed pivot table column conflicts
- ✅ **MenuCategory Integration:** Added to Dish resources
- ✅ **Pivot Relationships:** Created comprehensive connections
- ✅ **Availability API:** Added real-time availability checking
- ✅ **Documentation:** Complete Kiosk API documentation

### 🚀 Performance Features

#### Caching Strategy:
- რესტორნის მონაცემები cache-ირება 15 წუთით
- ხელმისაწვდომი სლოტები cache-ირება 5 წუთით  
- კვირეული განრიგი cache-ირება 1 საათით

#### Database Optimization:
- ინდექსები `restaurants.slug`, `places.slug`, `tables.slug`-ზე
- Eager loading-ი ნათესავი ურთიერთობებისთვის
- Query optimization პაგინაციისთვის

#### Error Handling:
- **404**: Resource not found
- **401**: Unauthorized  
- **422**: Invalid parameters
- **500**: Server error

---

## 🛠️ Usage Examples

### JavaScript/Frontend
```javascript
// Initialize kiosk API client
const kioskAPI = {
  baseURL: '/api/kiosk',
  token: localStorage.getItem('kiosk_token'),
  
  async request(endpoint, options = {}) {
    const response = await fetch(`${this.baseURL}${endpoint}`, {
      headers: {
        'Authorization': `Bearer ${this.token}`,
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        ...options.headers
      },
      ...options
    });
    return await response.json();
  },
  
  // Get restaurants
  async getRestaurants(params = {}) {
    const query = new URLSearchParams(params).toString();
    return this.request(`/restaurants?${query}`);
  },
  
  // Get availability
  async getRestaurantAvailability(slug, date = null) {
    const query = date ? `?date=${date}` : '';
    return this.request(`/availability/restaurant/${slug}${query}`);
  },
  
  // Get spaces
  async getSpaces() {
    return this.request('/spaces');
  }
};

// Usage examples
kioskAPI.getRestaurants({ search: 'georgian', per_page: 10 })
  .then(data => console.log(data));

kioskAPI.getRestaurantAvailability('georgian-house', '2025-07-20')
  .then(availability => console.log(availability));
```

### cURL Examples
```bash
# Login
curl -X POST "https://api.foodlyapp.ge/api/kiosk/login" \
  -H "Content-Type: application/json" \
  -d '{"identifier":"kiosk_001","secret":"kiosk_secret"}'

# Get restaurants
curl -X GET "https://api.foodlyapp.ge/api/kiosk/restaurants?search=georgian" \
  -H "Authorization: Bearer YOUR_TOKEN"

# Get spaces
curl -X GET "https://api.foodlyapp.ge/api/kiosk/spaces" \
  -H "Authorization: Bearer YOUR_TOKEN"

# Get availability
curl -X GET "https://api.foodlyapp.ge/api/kiosk/availability/restaurant/georgian-house" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## 📋 Business Rules

### Authentication:
- კიოსკები ავტენტიფიცირდებიან identifier + secret-ით
- Token-ები ვალიდურია 24 საათი
- Heartbeat ამოწმებს კიოსკის სტატუსს

### Data Access:
- ყველა API აბრუნებს მხოლოდ აქტიურ მონაცემებს (`status = 'active'`)
- Ranking system-ით დალაგებული შედეგები
- Pagination მხარდაჭერა დიდი მონაცემებისთვის

### Availability Rules:
- მინიმუმ 30 წუთი წინასწარ ჯავშანი
- მაქსიმუმ 30 დღე წინასწარ
- ავტომატური timezone handling (Asia/Tbilisi)

---

## 🔗 Related Documentation

- [📋 AVAILABILITY_API_SUMMARY.md](./AVAILABILITY_API_SUMMARY.md) - Availability API quick reference
- [🕐 KIOSK_AVAILABILITY_API.md](./KIOSK_AVAILABILITY_API.md) - Detailed availability documentation
- [🗺️ PROJECT_MAP.md](./PROJECT_MAP.md) - Complete project structure
- [🔧 API_FIXES_DOCUMENTATION.md](./API_FIXES_DOCUMENTATION.md) - Recent fixes and improvements

---

**ბოლო განახლება:** 17 ივლისი, 2025  
**API Version:** v1.0  
**Documentation Version:** 1.0
