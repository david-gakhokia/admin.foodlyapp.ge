# Kiosk Availability API Documentation

## Overview
ეს API endpoint-ები განკუთვნილია კიოსკ განყოფილებისთვის რესტორნების, სივრცეების და მაგიდების ხელმისაწვდომი საათების მისაღებად.

## Base URL
```
/api/kiosk/availability/
```

## Authentication
ყველა endpoint საჭიროებს authentication:
```
Authorization: Bearer {token}
```

## Endpoints

### 1. Restaurant Availability
რესტორნის ხელმისაწვდომი საათების მისაღება

**GET** `/api/kiosk/availability/restaurant/{slug}`

#### Parameters:
- `slug` (string, required) - რესტორნის slug
- `date` (string, optional) - კონკრეტული თარიღი (Y-m-d format), default: დღეს

#### Example Request:
```
GET /api/kiosk/availability/restaurant/restaurant-example?date=2025-07-20
```

#### Example Response:
```json
{
  "success": true,
  "data": {
    "restaurant": {
      "id": 1,
      "name": "Example Restaurant",
      "slug": "restaurant-example",
      "timezone": "Asia/Tbilisi",
      "working_hours": "10:00-22:00"
    },
    "date": "2025-07-20",
    "day_of_week": "Sunday",
    "available_slots": [
      "10:00",
      "10:30",
      "11:00",
      "11:30",
      "12:00"
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
      ],
      "Tuesday": [...]
    }
  }
}
```

### 2. Place Availability
სივრცის ხელმისაწვდომი საათების მისაღება

**GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}`

#### Parameters:
- `restaurantSlug` (string, required) - რესტორნის slug
- `placeSlug` (string, required) - სივრცის slug
- `date` (string, optional) - კონკრეტული თარიღი (Y-m-d format), default: დღეს

#### Example Request:
```
GET /api/kiosk/availability/restaurant/restaurant-example/place/terrace?date=2025-07-20
```

#### Example Response:
```json
{
  "success": true,
  "data": {
    "restaurant": {
      "id": 1,
      "name": "Example Restaurant",
      "slug": "restaurant-example"
    },
    "place": {
      "id": 5,
      "name": "Terrace",
      "slug": "terrace"
    },
    "date": "2025-07-20",
    "day_of_week": "Sunday",
    "available_slots": [
      "10:00",
      "10:30",
      "11:00"
    ],
    "weekly_hours": {
      "Monday": [...]
    }
  }
}
```

### 3. Table Availability (with Place)
მაგიდის ხელმისაწვდომი საათების მისაღება სივრცის ფარგლებში

**GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}/table/{tableSlug}`

#### Parameters:
- `restaurantSlug` (string, required) - რესტორნის slug
- `placeSlug` (string, required) - სივრცის slug
- `tableSlug` (string, required) - მაგიდის slug
- `date` (string, optional) - კონკრეტული თარიღი (Y-m-d format), default: დღეს

### 4. Direct Table Availability
მაგიდის ხელმისაწვდომი საათების მისაღება (სივრცის გარეშე)

**GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/table/{tableSlug}`

#### Parameters:
- `restaurantSlug` (string, required) - რესტორნის slug
- `tableSlug` (string, required) - მაგიდის slug
- `date` (string, optional) - კონკრეტული თარიღი (Y-m-d format), default: დღეს

## Response Format

### Success Response:
```json
{
  "success": true,
  "data": {
    // Availability data
  }
}
```

### Error Response:
```json
{
  "success": false,
  "error": "Error message",
  "message": "Detailed error message (optional)"
}
```

## HTTP Status Codes
- `200` - Success
- `404` - Resource not found
- `401` - Unauthorized
- `500` - Internal server error

## Usage Examples

### Frontend JavaScript
```javascript
// Get restaurant availability
const getRestaurantAvailability = async (slug, date = null) => {
  const url = `/api/kiosk/availability/restaurant/${slug}${date ? `?date=${date}` : ''}`;
  
  const response = await fetch(url, {
    headers: {
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json'
    }
  });
  
  return await response.json();
};

// Get place availability
const getPlaceAvailability = async (restaurantSlug, placeSlug, date = null) => {
  const url = `/api/kiosk/availability/restaurant/${restaurantSlug}/place/${placeSlug}${date ? `?date=${date}` : ''}`;
  
  const response = await fetch(url, {
    headers: {
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json'
    }
  });
  
  return await response.json();
};
```

### cURL Examples
```bash
# Restaurant availability
curl -X GET "https://api.foodlyapp.ge/api/kiosk/availability/restaurant/restaurant-example?date=2025-07-20" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"

# Place availability
curl -X GET "https://api.foodlyapp.ge/api/kiosk/availability/restaurant/restaurant-example/place/terrace" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

## Notes
- ყველა თარიღი ფორმატირებულია `Y-m-d` (მაგ: 2025-07-20)
- დროის სლოტები ბრუნდება `H:i` ფორმატში (მაგ: 10:30)
- `weekly_hours` გვიჩვენებს მთელი კვირის განრიგს
- `available_slots` გვიჩვენებს მხოლოდ კონკრეტული თარიღის ხელმისაწვდომ სლოტებს
- ყველა დრო იბეჭდება რესტორნის timezone-ში
