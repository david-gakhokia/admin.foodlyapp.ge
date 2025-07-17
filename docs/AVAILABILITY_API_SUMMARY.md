# Availability API Summary

## Quick Reference

### Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/kiosk/availability/restaurant/{slug}` | Restaurant availability |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}` | Place availability |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}/table/{tableSlug}` | Table availability (with place) |
| GET | `/api/kiosk/availability/restaurant/{restaurantSlug}/table/{tableSlug}` | Direct table availability |

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

### Error Codes
- `200` - Success
- `404` - Resource not found
- `401` - Unauthorized
- `422` - Invalid date format
- `500` - Server error

### Usage Examples
```bash
# Check restaurant availability for today
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house

# Check specific date
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house?date=2025-07-20

# Check table availability
curl -H "Authorization: Bearer TOKEN" \
  /api/kiosk/availability/restaurant/georgian-house/table/table-01
```

For detailed documentation see: [KIOSK_AVAILABILITY_API.md](./KIOSK_AVAILABILITY_API.md)
