# 🏪 Kiosk API

**v1.0** | **Base URL**: `https://api.foodlyapp.ge.test/api/kiosk`

---

## � Kiosk API Documentation

Kiosk API არის სპეციალურად კიოსკ ტერმინალებისთვის შექმნილი API endpoint-ების კოლექცია. ეს API უზრუნველყოფს რესტორნების, სივრცეების, კერძების, მაგიდების და ხელმისაწვდომობის ინფორმაციას.

⚠️ **Authentication Required**  
ყველა kiosk endpoint საჭიროებს authentication token-ს (გარდა login-ისა)

---

## 🔐 Authentication

### Kiosk Login
**POST** `/api/kiosk/login`

#### Request Body:
```json
{
  "identifier": "kiosk_001", 
  "secret": "kiosk_secret_key"
}
```

#### Response:
```json
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

### Other Auth Endpoints:
- **POST** `/api/kiosk/heartbeat` - 🔒 კიოსკის active სტატუსის შენარჩუნება
- **GET** `/api/kiosk/status` - 🔒 ყველა კიოსკის სტატუსი  
- **GET** `/api/kiosk/config` - 🔒 კიოსკის კონფიგურაცია

---

## 🏡 Restaurants

- **GET** `/api/kiosk/restaurants` - ყველა რესტორანი
  - Query Parameters: `search`, `per_page`, `sort`

- **GET** `/api/kiosk/restaurants/{slug}` - რესტორანი slug-ის მიხედვით

- **GET** `/api/kiosk/restaurants/{slug}/details` - რესტორნის დეტალები

- **GET** `/api/kiosk/restaurants/{slug}/places` - რესტორნის ადგილები

- **GET** `/api/kiosk/restaurants/{slug}/tables` - რესტორნის მაგიდები

- **GET** `/api/kiosk/restaurants/{slug}/table/{table}` - კონკრეტული მაგიდა

- **GET** `/api/kiosk/restaurants/{restaurant_slug}/place/{place_slug}/tables` - კონკრეტული სივრცის ყველა მაგიდა

---

## 🍽️ Menu System

- **GET** `/api/kiosk/restaurants/{slug}/menu/categories` - მენიუს კატეგორიები

- **GET** `/api/kiosk/restaurants/{slug}/menu/items` - მენიუს ელემენტები

- **GET** `/api/kiosk/restaurants/{slug}/menu` - სრული მენიუ სტრუქტურა
  - აბრუნებს hierarchical menu-ს categories და items-ით

---

## 🏢 Spaces

- **GET** `/api/kiosk/spaces` - ყველა აქტიური სივრცე rank-ის მიხედვით

- **GET** `/api/kiosk/spaces/{slug}` - სივრცე slug-ის მიხედვით

- **GET** `/api/kiosk/spaces/{slug}/restaurants` - სივრცის რესტორნები

- **GET** `/api/kiosk/spaces/{slug}/top-10-restaurants` - ტოპ 10 რესტორანი

---

## 🍽️ Cuisines

- **GET** `/api/kiosk/cuisines` - ყველა კულინარიული მიმართულება

- **GET** `/api/kiosk/cuisines/{slug}/restaurants` - კულინარიული მიმართულების რესტორნები

- **GET** `/api/kiosk/cuisines/{slug}/top-10-restaurants` - ტოპ 10 რესტორანი

#### Common Cuisine Slugs:
`georgian` `italian` `asian` `european`

---

## 🥘 Dishes

- **GET** `/api/kiosk/dishes` - ყველა კერძი MenuCategory-ების ინფორმაციით

- **GET** `/api/kiosk/dishes/{slug}` - კერძის დეტალური ინფორმაცია

- **GET** `/api/kiosk/dishes/{slug}/restaurants` - კერძის რესტორნები
  - Query Parameters: `locale` (en, ka, ru)

- **GET** `/api/kiosk/dishes/{slug}/top-10-restaurants` - ტოპ 10 რესტორანი

---

## 🕐 Availability

რესტორნების, სივრცეების და მაგიდების ხელმისაწვდომი საათების API

- **GET** `/api/kiosk/availability/restaurant/{slug}` - რესტორნის ხელმისაწვდომობა
  - Parameters: `date` (Y-m-d format, optional)

- **GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}` - ადგილის ხელმისაწვდომობა

- **GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/table/{tableSlug}` - მაგიდის ხელმისაწვდომობა

- **GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/times` - ყველა თავისუფალი საათი
  - Parameters: `?date=2025-07-20`

- **GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/tables-by-time` - ხელმისაწვდომი მაგიდები კონკრეტულ საათში
  - Parameters: `?date=2025-07-20&time=18:30`

- **GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/tables-overview` - ყველა მაგიდა availability status-ით

#### Response Example:
```json
{
  "success": true,
  "data": {
    "restaurant": {
      "id": 1,
      "name": "Georgian House",
      "slug": "georgian-house",
      "timezone": "Asia/Tbilisi"
    },
    "date": "2025-07-20",
    "day_of_week": "Sunday", 
    "available_slots": [
      "10:00", "10:30", "11:00", "18:00", "18:30"
    ]
  }
}
```

### � Availability Features
- **რეალურ დროში**: ამოწმებს ფაქტობრივ ჯავშნებს
- **სლოტები**: 30 წუთიანი ინტერვალები
- **კვირეული განრიგი**: თითოეული დღისთვის ცალკე
- **Cache**: Performance optimized

---

## 📍 Spots

- **GET** `/api/kiosk/spots` - ყველა spot

- **GET** `/api/kiosk/spots/{slug}/restaurants` - spot-ის რესტორნები

---

## 🗂️ Categories

- **GET** `/api/kiosk/categories` - ყველა კატეგორია

- **GET** `/api/kiosk/categories/{slug}` - კატეგორია slug-ის მიხედვით

---

## ⚙️ Technical Implementation

### 🔍 Query Patterns

**Spaces → Restaurants:**
```php
$space->restaurants()
    ->where('restaurants.status', 'active')
    ->orderBy('restaurant_space.rank', 'asc')
```

**Availability Service:**
```php
$availabilityService->generateAvailableSlots(
    $restaurant, $date, $dayOfWeek
)
```

### 🚀 Performance Features

#### Caching Strategy:
- **რესტორნები**: 15 წუთი
- **ხელმისაწვდომობა**: 5 წუთი  
- **კვირეული განრიგი**: 1 საათი

#### Database Optimization:
- Indexed slug searches
- Eager loading relationships
- Optimized pivot queries

### ❌ Error Handling

- **200** - Success
- **401** - Unauthorized (invalid token)
- **404** - Resource not found
- **422** - Invalid parameters
- **500** - Server error

### 💻 JavaScript Usage Example

```javascript
// Kiosk API Client
const kioskAPI = {
  baseURL: '/api/kiosk',
  token: localStorage.getItem('kiosk_token'),
  
  async request(endpoint, options = {}) {
    const response = await fetch(`${this.baseURL}${endpoint}`, {
      headers: {
        'Authorization': `Bearer ${this.token}`,
        'Accept': 'application/json',
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
  async getAvailability(slug, date = null) {
    const query = date ? `?date=${date}` : '';
    return this.request(`/availability/restaurant/${slug}${query}`);
  }
};

// Usage
kioskAPI.getRestaurants({ search: 'georgian' })
  .then(data => console.log(data));
```

---

## � Kiosk Workflow Examples

### 1. გვერდის ჩატვირთვა
```
GET /api/kiosk/availability/restaurant/georgian-house/tables-overview
```
აჩვენებს ყველა მაგიდას current status-ით

### 2. თარიღის შერჩევა  
```
GET /api/kiosk/availability/restaurant/georgian-house/times?date=2025-07-20
```
აჩვენებს ყველა თავისუფალ საათს

### 3. საათის შერჩევა
```
GET /api/kiosk/availability/restaurant/georgian-house/tables-by-time?date=2025-07-20&time=18:30
```
აჩვენებს ხელმისაწვდომ მაგიდებს კონკრეტულ საათში

### 4. სივრცის სპეციფიკური ძიება
```
GET /api/kiosk/availability/restaurant/georgian-house/summer-terrace/tables-by-time?date=2025-07-20&time=18:30
```
აჩვენებს კონკრეტული სივრცის ხელმისაწვდომ მაგიდებს

---

**ბოლო განახლება**: 3 სექტემბერი, 2025 | **API Version**: v1.0

📚 **დეტალური ინფორმაციისთვის**: [API Documentation](https://api.foodlyapp.ge.test/docs)