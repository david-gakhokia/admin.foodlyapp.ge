# Mobile API Documentation
*Android & iOS Applications*

---

## 📱 Mobile API Overview

**Base URL:** `https://api.foodlyapp.ge/api/webapp`  
**Format:** JSON REST API  
**Platform:** Android & iOS Applications  
**Authentication:** Not Required (Public API)  
**Localization:** Georgian (`ka`), English (`en`)  

---

## 🗂️ API Structure

### Authentication
No authentication required for mobile webapp endpoints.

### Content Types
- **Spaces** - Dining spaces and environments
- **Cuisines** - Food cuisine categories
- **Regions** - Geographic regions
- **Cities** - City locations
- **Restaurants** - Restaurant listings and details
- **Dishes** - Food dishes and specialties
- **Spots** - Dining spots and locations
- **Categories** - Restaurant categories

---

## 🌍 Spaces API

### Get All Spaces
```http
GET /api/webapp/spaces
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Indoor Dining",
      "slug": "indoor-dining",
      "description": "Comfortable indoor dining experience",
      "restaurants_count": 45
    }
  ]
}
```

### Get Space Details
```http
GET /api/webapp/spaces/{slug}
```

### Get Restaurants by Space
```http
GET /api/webapp/spaces/{slug}/restaurants
```

### Get Top 10 Restaurants by Space
```http
GET /api/webapp/spaces/{slug}/top-10-restaurants
```

---

## 🍽️ Cuisines API

### Get All Cuisines
```http
GET /api/webapp/cuisines
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Georgian",
      "slug": "georgian",
      "description": "Traditional Georgian cuisine",
      "restaurants_count": 120
    }
  ]
}
```

### Get Cuisine Details
```http
GET /api/webapp/cuisines/{slug}
```

### Get Restaurants by Cuisine
```http
GET /api/webapp/cuisines/{slug}/restaurants
```

### Get Top 10 Restaurants by Cuisine
```http
GET /api/webapp/cuisines/{slug}/top-10-restaurants
```

---

## 📍 Regions API

### Get All Regions
```http
GET /api/webapp/regions
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Tbilisi",
      "slug": "tbilisi",
      "restaurants_count": 250
    }
  ]
}
```

### Get Region Details
```http
GET /api/webapp/regions/{slug}
```

### Get Restaurants by Region and Category
```http
GET /api/webapp/regions/{slug}/{categorySlug}/restaurants
```

---

## 🏙️ Cities API

### Get All Cities
```http
GET /api/webapp/cities
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Tbilisi",
      "slug": "tbilisi",
      "region": "Tbilisi",
      "restaurants_count": 250
    }
  ]
}
```

### Get City Details
```http
GET /api/webapp/cities/{slug}
```

### Get Restaurants by City
```http
GET /api/webapp/cities/{slug}/restaurants
```

### Get Top 10 Restaurants by City
```http
GET /api/webapp/cities/{slug}/top-10-restaurants
```

---

## 🏡 Restaurants API

### Get All Restaurants
```http
GET /api/webapp/restaurants
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Restaurant Name",
      "slug": "restaurant-name",
      "cuisine": "Georgian",
      "city": "Tbilisi",
      "rating": 4.5,
      "price_range": "$$",
      "image": "https://example.com/image.jpg"
    }
  ]
}
```

### Get Restaurant Details
```http
GET /api/webapp/restaurants/{slug}
```

**Response:**
```json
{
  "data": {
    "id": 1,
    "name": "Restaurant Name",
    "slug": "restaurant-name",
    "description": "Restaurant description",
    "cuisine": "Georgian",
    "city": "Tbilisi",
    "address": "123 Main Street",
    "phone": "+995 555 123456",
    "rating": 4.5,
    "price_range": "$$",
    "images": [
      "https://example.com/image1.jpg",
      "https://example.com/image2.jpg"
    ],
    "opening_hours": {
      "monday": "10:00-22:00",
      "tuesday": "10:00-22:00"
    },
    "features": [
      "WiFi",
      "Parking",
      "Delivery"
    ]
  }
}
```

### Get Restaurant Places
```http
GET /api/webapp/restaurants/{slug}/places
```

### Get Restaurant Tables
```http
GET /api/webapp/restaurants/{slug}/tables
```

### Get Restaurant Details (Extended)
```http
GET /api/webapp/restaurants/{slug}/details
```

---

## 🍽️ Dishes API

### Get All Dishes
```http
GET /api/webapp/dishes
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Khachapuri",
      "slug": "khachapuri",
      "description": "Traditional Georgian cheese bread",
      "category": "Appetizers",
      "restaurants_count": 85
    }
  ]
}
```

### Get Dish Details
```http
GET /api/webapp/dishes/{slug}
```

### Get Restaurants by Dish
```http
GET /api/webapp/dishes/{slug}/restaurants
```

### Get Top 10 Restaurants by Dish
```http
GET /api/webapp/dishes/{slug}/top-10-restaurants
```

---

## 📍 Spots API

### Get All Spots
```http
GET /api/webapp/spots
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Old Town",
      "slug": "old-town",
      "description": "Historic old town area",
      "restaurants_count": 30
    }
  ]
}
```

### Get Spot Details
```http
GET /api/webapp/spots/{slug}
```

### Get Restaurants by Spot
```http
GET /api/webapp/spots/{slug}/restaurants
```

### Get Top 10 Restaurants by Spot
```http
GET /api/webapp/spots/{slug}/top-10-restaurants
```

---

## 🗂️ Categories API

### Get All Categories
```http
GET /api/webapp/categories
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Fine Dining",
      "slug": "fine-dining",
      "description": "Upscale dining experience"
    }
  ]
}
```

### Get Category Details
```http
GET /api/webapp/categories/{slug}
```

---

## 📱 Android Test API

### Test Android Connection
```http
GET /api/android/test
```

**Response:**
```json
{
  "message": "Android API Working!",
  "platform": "android"
}
```

---

## 🚀 Implementation Examples

### Android (Kotlin)
```kotlin
// Retrofit interface
interface FoodlyApiService {
    @GET("api/webapp/restaurants")
    suspend fun getRestaurants(): Response<RestaurantsResponse>
    
    @GET("api/webapp/restaurants/{slug}")
    suspend fun getRestaurant(@Path("slug") slug: String): Response<RestaurantResponse>
}

// Usage
class RestaurantRepository {
    private val api = RetrofitInstance.api
    
    suspend fun getRestaurants() = api.getRestaurants()
    suspend fun getRestaurant(slug: String) = api.getRestaurant(slug)
}
```

### iOS (Swift)
```swift
// API Service
class FoodlyAPIService {
    private let baseURL = "https://api.foodlyapp.ge/api/webapp"
    
    func getRestaurants() async throws -> RestaurantsResponse {
        let url = URL(string: "\(baseURL)/restaurants")!
        let (data, _) = try await URLSession.shared.data(from: url)
        return try JSONDecoder().decode(RestaurantsResponse.self, from: data)
    }
    
    func getRestaurant(slug: String) async throws -> RestaurantResponse {
        let url = URL(string: "\(baseURL)/restaurants/\(slug)")!
        let (data, _) = try await URLSession.shared.data(from: url)
        return try JSONDecoder().decode(RestaurantResponse.self, from: data)
    }
}
```

---

## 🔧 Technical Details

### Rate Limiting
- No rate limiting applied to webapp endpoints
- Recommended: Implement client-side caching

### Error Handling
```json
{
  "error": {
    "code": 404,
    "message": "Resource not found",
    "details": "Restaurant with slug 'invalid-slug' not found"
  }
}
```

### Pagination
Most list endpoints support pagination:
```
GET /api/webapp/restaurants?page=1&per_page=20
```

### Localization
Add language preference:
```
GET /api/webapp/restaurants
Headers: Accept-Language: ka
```

### Response Format
All responses follow consistent structure:
```json
{
  "data": [...],
  "meta": {
    "total": 100,
    "per_page": 20,
    "current_page": 1,
    "last_page": 5
  }
}
```

---

## 🔄 Data Synchronization

### Recommended Update Frequency
- **Restaurants List:** Every 24 hours
- **Restaurant Details:** Every 12 hours  
- **Categories/Cuisines:** Every 7 days
- **Cities/Regions:** Every 30 days

### Offline Capabilities
Store essential data locally:
- Restaurant basic info
- Categories and cuisines
- City/region data
- Recent search results

---

## 📊 Performance Optimization

### Caching Strategy
```kotlin
// Android - Room Database
@Entity
data class Restaurant(
    @PrimaryKey val id: Int,
    val name: String,
    val slug: String,
    val lastUpdated: Long
)

// Cache implementation
class RestaurantCache {
    fun shouldRefresh(restaurant: Restaurant): Boolean {
        return System.currentTimeMillis() - restaurant.lastUpdated > 12.hours
    }
}
```

### Image Loading
```swift
// iOS - Kingfisher
import Kingfisher

imageView.kf.setImage(
    with: URL(string: restaurant.imageURL),
    placeholder: UIImage(named: "placeholder"),
    options: [
        .transition(.fade(0.3)),
        .cacheMemoryOnly
    ]
)
```

---

*Last updated: December 2024*  
*API Version: 1.0*  
*Support: api@foodlyapp.ge*
