# Kiosk Availability API Documentation

## Overview
ეს API endpoint-ები განკუთვნილია კიოსკ განყოფილებისთვის რესტორნების, სივრცეების და მაგიდების ხელმისაწვდომი საათების მისაღებად. API უზრუნველყოფს რეალურ დროში მონაცემებს ჯავშნების ხელმისაწვდომობის შესახებ.

## Base URL
```
/api/kiosk/availability/
```

## Authentication
ყველა endpoint საჭიროებს authentication:
```
Authorization: Bearer {token}
```

## Features
- ✅ რესტორნის ხელმისაწვდომი საათების მისაღება
- ✅ სივრცის/ადგილის ხელმისაწვდომობა  
- ✅ მაგიდის ხელმისაწვდომობა (სივრცის ფარგლებში და მის გარეშე)
- ✅ რეალურ დროში ჯავშნების სტატუსი
- ✅ კვირეული განრიგის მონაცემები
- ✅ ავტომატური დროის ზონის დამუშავება

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
      "name": "Georgian House",
      "slug": "georgian-house",
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
      "12:00",
      "12:30",
      "13:00",
      "18:00",
      "18:30",
      "19:00",
      "19:30",
      "20:00",
      "20:30",
      "21:00",
      "21:30"
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
      "Tuesday": [
        {
          "day": "Tuesday", 
          "time_from": "10:00:00",
          "time_to": "22:00:00",
          "available": true,
          "max_guests": 50,
          "slot_interval_minutes": 30
        }
      ],
      "Wednesday": [
        {
          "day": "Wednesday",
          "time_from": "10:00:00", 
          "time_to": "22:00:00",
          "available": true,
          "max_guests": 50,
          "slot_interval_minutes": 30
        }
      ],
      "Thursday": [
        {
          "day": "Thursday",
          "time_from": "10:00:00",
          "time_to": "22:00:00", 
          "available": true,
          "max_guests": 50,
          "slot_interval_minutes": 30
        }
      ],
      "Friday": [
        {
          "day": "Friday",
          "time_from": "10:00:00",
          "time_to": "23:00:00",
          "available": true,
          "max_guests": 60,
          "slot_interval_minutes": 30
        }
      ],
      "Saturday": [
        {
          "day": "Saturday", 
          "time_from": "10:00:00",
          "time_to": "23:00:00",
          "available": true,
          "max_guests": 60,
          "slot_interval_minutes": 30
        }
      ],
      "Sunday": [
        {
          "day": "Sunday",
          "time_from": "11:00:00",
          "time_to": "21:00:00",
          "available": true,
          "max_guests": 40,
          "slot_interval_minutes": 30
        }
      ]
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
#### Example Response:
```json
{
  "success": true,
  "data": {
    "restaurant": {
      "id": 1,
      "name": "Georgian House",
      "slug": "georgian-house"
    },
    "place": {
      "id": 5,
      "name": "Summer Terrace",
      "slug": "summer-terrace",
      "description": "Beautiful outdoor terrace with city view",
      "capacity": 20
    },
    "date": "2025-07-20",
    "day_of_week": "Sunday",
    "available_slots": [
      "11:00",
      "11:30",
      "12:00",
      "12:30",
      "18:00",
      "18:30",
      "19:00",
      "19:30",
      "20:00"
    ],
    "weekly_hours": {
      "Monday": [
        {
          "day": "Monday",
          "time_from": "12:00:00",
          "time_to": "21:00:00",
          "available": true,
          "max_guests": 20,
          "slot_interval_minutes": 30
        }
      ],
      "Tuesday": [
        {
          "day": "Tuesday",
          "time_from": "12:00:00", 
          "time_to": "21:00:00",
          "available": true,
          "max_guests": 20,
          "slot_interval_minutes": 30
        }
      ],
      "Wednesday": [
        {
          "day": "Wednesday",
          "time_from": "12:00:00",
          "time_to": "21:00:00",
          "available": true,
          "max_guests": 20,
          "slot_interval_minutes": 30
        }
      ],
      "Thursday": [
        {
          "day": "Thursday",
          "time_from": "12:00:00",
          "time_to": "21:00:00",
          "available": true,
          "max_guests": 20,
          "slot_interval_minutes": 30
        }
      ],
      "Friday": [
        {
          "day": "Friday",
          "time_from": "12:00:00",
          "time_to": "22:00:00",
          "available": true,
          "max_guests": 20,
          "slot_interval_minutes": 30
        }
      ],
      "Saturday": [
        {
          "day": "Saturday",
          "time_from": "12:00:00",
          "time_to": "22:00:00",
          "available": true,
          "max_guests": 20,
          "slot_interval_minutes": 30
        }
      ],
      "Sunday": [
        {
          "day": "Sunday",
          "time_from": "12:00:00",
          "time_to": "20:00:00",
          "available": true,
          "max_guests": 20,
          "slot_interval_minutes": 30
        }
      ]
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

#### Example Request:
```
GET /api/kiosk/availability/restaurant/georgian-house/place/summer-terrace/table/table-01?date=2025-07-20
```

#### Example Response:
```json
{
  "success": true,
  "data": {
    "restaurant": {
      "id": 1,
      "name": "Georgian House",
      "slug": "georgian-house"
    },
    "place": {
      "id": 5,
      "name": "Summer Terrace",
      "slug": "summer-terrace"
    },
    "table": {
      "id": 15,
      "name": "Table 01",
      "slug": "table-01",
      "capacity": 4,
      "is_available": true,
      "description": "Corner table with beautiful view"
    },
    "date": "2025-07-20",
    "day_of_week": "Sunday", 
    "available_slots": [
      "11:00",
      "11:30",
      "12:00",
      "18:00",
      "18:30",
      "19:00",
      "19:30"
    ],
    "reserved_slots": [
      "12:30",
      "13:00",
      "13:30",
      "20:00",
      "20:30"
    ]
  }
}
```

### 4. Direct Table Availability
მაგიდის ხელმისაწვდომი საათების მისაღება (სივრცის გარეშე)

**GET** `/api/kiosk/availability/restaurant/{restaurantSlug}/table/{tableSlug}`

#### Parameters:
- `restaurantSlug` (string, required) - რესტორნის slug
- `tableSlug` (string, required) - მაგიდის slug
- `date` (string, optional) - კონკრეტული თარიღი (Y-m-d format), default: დღეს

#### Example Request:
```
GET /api/kiosk/availability/restaurant/georgian-house/table/table-05?date=2025-07-20
```

#### Example Response:
```json
{
  "success": true,
  "data": {
    "restaurant": {
      "id": 1,
      "name": "Georgian House", 
      "slug": "georgian-house"
    },
    "table": {
      "id": 18,
      "name": "Table 05",
      "slug": "table-05",
      "capacity": 6,
      "is_available": true,
      "description": "Large family table"
    },
    "date": "2025-07-20",
    "day_of_week": "Sunday",
    "available_slots": [
      "11:00",
      "11:30",
      "12:00",
      "12:30",
      "13:00",
      "18:00",
      "18:30",
      "19:00"
    ],
    "reserved_slots": [
      "19:30",
      "20:00"
    ]
  }
}
```

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
curl -X GET "https://api.foodlyapp.ge/api/kiosk/availability/restaurant/georgian-house/place/summer-terrace" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"

# Table availability (with place)
curl -X GET "https://api.foodlyapp.ge/api/kiosk/availability/restaurant/georgian-house/place/summer-terrace/table/table-01" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"

# Direct table availability
curl -X GET "https://api.foodlyapp.ge/api/kiosk/availability/restaurant/georgian-house/table/table-05?date=2025-07-20" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

## Technical Implementation Details

### Database Relations
- `restaurants` → `reservation_slots` (კვირეული განრიგი)
- `restaurants` → `places` → `tables` (იერარქიული სტრუქტურა)
- `tables` → `reservations` (რეალურ დროში ჯავშნები)

### Availability Logic
1. **Restaurant Level**: ამოწმებს მთლიან რესტორანს არის თუ არა ღია კონკრეტულ თარიღზე
2. **Place Level**: ფილტრავს სივრცის მიხედვით
3. **Table Level**: ამოწმებს კონკრეტული მაგიდის ხელმისაწვდომობას

### Time Slot Generation
- ავტომატურად გენერირებს სლოტებს `slot_interval_minutes`-ის მიხედვით
- ეს იღებს უკვე ჯავშნილ დროებს
- აბრუნებს მხოლოდ ხელმისაწვდომ სლოტებს

### Error Handling
- **404**: რესტორანი, სივრცე ან მაგიდა ვერ მოიძებნა
- **401**: ავტორიზაცია საჭიროა
- **422**: არასწორი თარიღის ფორმატი
- **500**: სერვერის შიდა შეცდომა

## Business Rules

### Reservation Time Limits
- მინიმუმ 30 წუთი წინასწარ
- მაქსიმუმ 30 დღე წინასწარ
- სლოტების ხანგრძლივობა: 30 წუთი (კონფიგურაციაში შეცვლადი)

### Working Hours
- თითოეული რესტორანი შეიძლება ჰქონდეს განსხვავებული განრიგი
- შეძლებს კვირის განსხვავებულ დღეებზე განსხვავებული საათები
- შესვენების დროები ავტომატურად გაითვალისწინება

### Capacity Management
- `max_guests` კონტროლირებს მთლიან ტევადობას
- მაგიდის `capacity` განსაზღვრავს მაქსიმალურ სტუმრების რაოდენობას
- ავტომატური ოვერბუკინგის პრევენცია

## Performance Considerations

### Caching Strategy
- რესტორნის მონაცემები cache-ირება 15 წუთით
- ხელმისაწვდომი სლოტები cache-ირება 5 წუთით  
- კვირეული განრიგი cache-ირება 1 საათით

### Database Optimization
- ინდექსები `restaurants.slug`, `places.slug`, `tables.slug`-ზე
- Eager loading-ი ნათესავი ურთიერთობებისთვის
- Query optimization პაგინაციისთვის

## Monitoring & Analytics

### Metrics Tracked
- API response times
- Availability check frequency
- Popular time slots
- Booking conversion rates

### Logging
- ყველა availability request-ი ლოგება
- Error tracking Sentry-ს მეშვეობით
- Performance monitoring

## Future Enhancements

### Planned Features
- ✨ Dynamic pricing based on demand
- ✨ Weather-based availability (ღია ჰაერის სივრცეებისთვის)
- ✨ Special events impact on availability
- ✨ Bulk availability check for multiple restaurants

## Notes
- ყველა თარიღი ფორმატირებულია `Y-m-d` (მაგ: 2025-07-20)
- დროის სლოტები ბრუნდება `H:i` ფორმატში (მაგ: 10:30)
- `weekly_hours` გვიჩვენებს მთელი კვირის განრიგს
- `available_slots` გვიჩვენებს მხოლოდ კონკრეტული თარიღის ხელმისაწვდომ სლოტებს
- ყველა დრო იბეჭდება რესტორნის timezone-ში
