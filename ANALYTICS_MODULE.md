# 📊 Analytics & Reporting Module

Laravel-ის Analytics & Reporting მოდული გაწერილია BOG Payment, რესერვაციების და შემოსავლების ანალიტიკისთვის.

## 🎯 ძირითადი ფუნქციები

### 1. Dashboard Overview
- მთლიანი რესერვაციების სტატისტიკა
- BOG გადახდების ანალიტიკა
- შემოსავლების ზომა
- კონვერსიის მაჩვენებლები
- წინა პერიოდებთან შედარება

### 2. BOG Payment Analytics
- ტრანზაქციების სტატისტიკა
- წარმატების განაკვეთი
- შეცდომების ანალიზი
- დროის მიხედვით ბრეაქდაუნი

### 3. Reservation Analytics
- რესერვაციების ტენდენციები
- სტატუსების განაწილება
- საუკეთესო საათები/დღეები
- სტუმრების რაოდენობის ანალიზი

### 4. Revenue Analytics
- შემოსავლების ტრენდები
- რესტორნების მიხედვით განაწილება
- პროექციები მომავლისთვის
- საშუალო ტრანზაქციის ღირებულება

## 🔗 API Endpoints

### Dashboard Overview
```http
GET /admin/analytics/dashboard
```

**Parameters:**
- `from_date` (optional): დასაწყისი თარიღი (YYYY-MM-DD)
- `to_date` (optional): ბოლო თარიღი (YYYY-MM-DD)
- `restaurant_id` (optional): კონკრეტული რესტორნის ID

**Response:**
```json
{
  "success": true,
  "data": {
    "reservations": {
      "total": 150,
      "confirmed": 120,
      "cancelled": 20,
      "pending": 10,
      "conversion_rate": 80.0,
      "growth_percentage": 15.5
    },
    "payments": {
      "total_transactions": 120,
      "successful_transactions": 115,
      "failed_transactions": 5,
      "success_rate": 95.83,
      "total_revenue": 12500.50
    },
    "revenue": {
      "total": 12500.50,
      "average_per_reservation": 104.17,
      "growth_percentage": 12.3
    }
  }
}
```

### BOG Payment Analytics
```http
GET /admin/analytics/bog-payments
```

**Parameters:**
- `from_date` (optional): დასაწყისი თარიღი
- `to_date` (optional): ბოლო თარიღი
- `restaurant_id` (optional): რესტორნის ID
- `period` (optional): day, week, month, year

**Response:**
```json
{
  "success": true,
  "data": {
    "time_series": [
      {
        "period": "2024-01-01",
        "total_transactions": 25,
        "successful_transactions": 24,
        "failed_transactions": 1,
        "revenue": 2500.00
      }
    ],
    "status_breakdown": {
      "success": {
        "status": "success",
        "count": 115,
        "total_amount": 12500.50
      },
      "failed": {
        "status": "failed",
        "count": 5,
        "total_amount": 0
      }
    },
    "error_analysis": [
      {
        "error_message": "Insufficient funds",
        "count": 3
      }
    ],
    "summary": {
      "total_transactions": 120,
      "success_rate": 95.83,
      "total_revenue": 12500.50,
      "average_transaction_amount": 108.70
    }
  }
}
```

### Reservation Analytics
```http
GET /admin/analytics/reservations
```

**Parameters:**
- `from_date` (optional): დასაწყისი თარიღი
- `to_date` (optional): ბოლო თარიღი
- `restaurant_id` (optional): რესტორნის ID
- `period` (optional): day, week, month, year
- `status` (optional): სტატუსების array

### Revenue Analytics
```http
GET /admin/analytics/revenue
```

**Parameters:**
- `from_date` (optional): დასაწყისი თარიღი
- `to_date` (optional): ბოლო თარიღი
- `restaurant_id` (optional): რესტორნის ID
- `period` (optional): day, week, month, year
- `include_projections` (optional): boolean - პროექციების ჩართვა

### Top Restaurants
```http
GET /admin/analytics/top-restaurants
```

**Parameters:**
- `from_date` (optional): დასაწყისი თარიღი
- `to_date` (optional): ბოლო თარიღი
- `metric` (optional): revenue, reservations, conversion_rate
- `limit` (optional): შედეგების რაოდენობა (max: 50)

### Conversion Funnel
```http
GET /admin/analytics/conversion-funnel
```

**Response:**
```json
{
  "success": true,
  "data": {
    "steps": [
      {
        "name": "Reservation Created",
        "count": 150,
        "percentage": 100,
        "drop_off": 0
      },
      {
        "name": "Payment Initiated",
        "count": 125,
        "percentage": 83.33,
        "drop_off": 25
      },
      {
        "name": "Payment Completed",
        "count": 120,
        "percentage": 80.0,
        "drop_off": 5
      },
      {
        "name": "Reservation Confirmed",
        "count": 120,
        "percentage": 80.0,
        "drop_off": 0
      }
    ],
    "overall_conversion_rate": 80.0,
    "payment_conversion_rate": 96.0
  }
}
```

### Real-time Analytics
```http
GET /admin/analytics/real-time
```

**Parameters:**
- `restaurant_id` (optional): რესტორნის ID
- `hours` (optional): საათების რაოდენობა (1-24)

### Export Analytics
```http
POST /admin/analytics/export
```

**Parameters:**
- `type` (required): bog_payments, reservations, revenue, overview
- `from_date` (optional): დასაწყისი თარიღი
- `to_date` (optional): ბოლო თარიღი
- `restaurant_id` (optional): რესტორნის ID
- `format` (optional): csv, xlsx, pdf

**Response:**
```json
{
  "success": true,
  "message": "Report generation started. You will receive a notification when it's ready.",
  "data": {
    "estimated_completion": "2024-01-01T12:35:00Z"
  }
}
```

## 📊 Reports Management

### List Reports
```http
GET /admin/analytics/reports
```

### View Report
```http
GET /admin/analytics/reports/{id}
```

### Delete Report
```http
DELETE /admin/analytics/reports/{id}
```

### Download Report
```http
GET /admin/analytics/download/{id}
```

## 🛠️ Technical Implementation

### Services
- `AnalyticsService`: ძირითადი ანალიტიკის ლოგიკა
- Caching: Redis cache 5 წუთით
- Queue Jobs: რეპორტების გენერაცია background-ში

### Models
- `AnalyticsReport`: გენერირებული რეპორტების შენახვა
- `BOGTransaction`: BOG გადახდების ტრანზაქციები
- `Reservation`: რესერვაციების მონაცემები

### Jobs
- `GenerateAnalyticsReport`: რეპორტების ასინქრონული გენერაცია

### Commands
- `analytics:cleanup`: ძველი რეპორტების გაწმენდა

## 🔧 Configuration

### Cache Settings
```php
// config/cache.php
'analytics' => [
    'ttl' => 300, // 5 minutes
]
```

### Queue Settings
```php
// config/queue.php
'analytics' => [
    'connection' => 'redis',
    'queue' => 'analytics',
]
```

## 📝 Usage Examples

### Dashboard Data
```php
use App\Services\AnalyticsService;

$analytics = new AnalyticsService();
$overview = $analytics->getDashboardOverview('2024-01-01', '2024-01-31');
```

### Generate Report
```php
use App\Jobs\GenerateAnalyticsReport;

GenerateAnalyticsReport::dispatch(
    'revenue',
    ['from_date' => '2024-01-01', 'to_date' => '2024-01-31'],
    auth()->id(),
    'csv'
);
```

### Cleanup Old Reports
```bash
php artisan analytics:cleanup --days=7
```

## 🚀 Features

- ✅ Real-time analytics
- ✅ Time series data
- ✅ Export to CSV/Excel/PDF
- ✅ Caching for performance
- ✅ Background report generation
- ✅ Automatic cleanup
- ✅ Conversion funnel analysis
- ✅ Growth trend calculations
- ✅ Restaurant comparison

## 🔐 Security

- Authentication required for all endpoints
- User-specific report access
- File download protection
- Input validation and sanitization

## 📱 Frontend Integration

```javascript
// Get dashboard data
const getDashboardData = async (filters = {}) => {
  const response = await fetch('/admin/analytics/dashboard?' + new URLSearchParams(filters));
  return response.json();
};

// Export report
const exportReport = async (type, filters, format = 'csv') => {
  const response = await fetch('/admin/analytics/export', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ type, ...filters, format })
  });
  return response.json();
};
```

## 🎨 Chart.js Integration Example

```javascript
// Revenue trend chart
const revenueData = await fetch('/admin/analytics/revenue').then(r => r.json());

new Chart(ctx, {
  type: 'line',
  data: {
    labels: revenueData.data.time_series.map(d => d.period),
    datasets: [{
      label: 'Revenue',
      data: revenueData.data.time_series.map(d => d.revenue),
      borderColor: 'rgb(75, 192, 192)',
      tension: 0.1
    }]
  }
});
```

ეს მოდული უზრუნველყოფს კომპლექსურ ანალიტიკას და რეპორტებს თქვენი ბიზნესისთვის.
