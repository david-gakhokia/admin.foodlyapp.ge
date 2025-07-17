#!/bin/bash

# Kiosk API Availability Testing Script
# Replace with your actual base URL and token

BASE_URL="http://localhost/api/kiosk"
TOKEN="your_kiosk_token_here"
RESTAURANT_SLUG="georgian-house"
PLACE_SLUG="summer-terrace"
DATE="2025-07-20"
TIME="18:30"

echo "🧪 Testing Kiosk Availability Endpoints"
echo "========================================"

# 1. Test Tables Overview
echo "1. Testing Tables Overview..."
curl -H "Authorization: Bearer $TOKEN" \
     -H "Accept: application/json" \
     "$BASE_URL/availability/restaurant/$RESTAURANT_SLUG/tables-overview?date=$DATE"

echo -e "\n\n"

# 2. Test Available Times
echo "2. Testing Available Times..."
curl -H "Authorization: Bearer $TOKEN" \
     -H "Accept: application/json" \
     "$BASE_URL/availability/restaurant/$RESTAURANT_SLUG/times?date=$DATE"

echo -e "\n\n"

# 3. Test Tables by Time (All Places)
echo "3. Testing Tables by Time (All Places)..."
curl -H "Authorization: Bearer $TOKEN" \
     -H "Accept: application/json" \
     "$BASE_URL/availability/restaurant/$RESTAURANT_SLUG/tables-by-time?date=$DATE&time=$TIME"

echo -e "\n\n"

# 4. Test Tables by Time (Place Specific) - NEW ENDPOINT
echo "4. Testing Tables by Time (Place Specific) - NEW..."
curl -H "Authorization: Bearer $TOKEN" \
     -H "Accept: application/json" \
     "$BASE_URL/availability/restaurant/$RESTAURANT_SLUG/$PLACE_SLUG/tables-by-time?date=$DATE&time=$TIME"

echo -e "\n\n"

echo "✅ All tests completed!"
