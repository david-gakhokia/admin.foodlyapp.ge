# Availability API Summary

## Quick Reference

### Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/kiosk/availability/restaurant/{slug}` | Restaurant availability |
| GET | `/api/kiosk/restaurants/{restaurant_slug}/place/{place_slug}/tables` | List place tables |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}` | Place availability |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}/table/{tableSlug}` | Table availability (with place) |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/table/{tableSlug}` | Direct table availability |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/times` | All available times |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/tables-by-time` | Available tables by time |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/{placeSlug}/tables-by-time` | Available tables by time (place specific) |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/tables-overview` | All tables with status |

### Common Parameters
- `date` (optional): კონკრეტული თარიღი Y-m-d ფორმატში
- All endpoints require authentication: `Authorization: Bearer {token}`

### Response Format
```json
{
  "success": true,
  "data": {
    "restaurant": { /* restaurant info */ },
    "date": "2025-07-20",
    "day_of_week": "Sunday",
    "available_slots": ["10:00", "10:30", "11:00"],
    "weekly_hours": { /* weekly schedule */ }
  }
}
```

### Key Features
- ✅ Real-time availability checking
- ✅ 30-minute time slots (configurable)
- ✅ Automatic timezone handling (Asia/Tbilisi)
- ✅ Weekly schedule support
- ✅ Capacity management
- ✅ Reservation conflict detection

### Kiosk Workflow
1. **Page Load** → `/tables-overview` - ყველა მაგიდის სტატუსი
2. **Date Selection** → `/times?date=X` - თავისუფალი საათები
3. **Time Selection** → `/tables-by-time?date=X&time=Y` - ხელმისაწვდომი მაგიდები (ყველა სივრცე)
4. **Place Specific** → `/{placeSlug}/tables-by-time?date=X&time=Y` - კონკრეტული სივრცის მაგიდები

### Error Codes
- `200` - Success
- `404` - Resource not found
- `401` - Unauthorized
- `422` - Invalid date format
- `500` - Server error

### Usage Examples
```bash
# 1. Initial page load - Get all tables overview
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house/tables-overview

# 2. Date selection - Get available times
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house/times?date=2025-07-20

# 3. Time selection - Get available tables (all places)
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house/tables-by-time?date=2025-07-20&time=18:30

# 4. Place specific time selection - Get available tables for specific place  
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house/summer-terrace/tables-by-time?date=2025-07-20&time=18:30

# Get tables list for specific place
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/restaurants/georgian-house/place/summer-terrace/tables

# Check place availability
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house/place/summer-terrace?date=2025-07-20

# Check specific date
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house?date=2025-07-20

# Check table availability
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house/table/table-01
```

For detailed documentation see: [KIOSK_AVAILABILITY_API.md](./KIOSK_AVAILABILITY_API.md)
