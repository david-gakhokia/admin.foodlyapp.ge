# FOODLYAPP API

**Laravel## 📱 Core Features

- **🏪 Restaurant Management** - Multi-language support with translations
- **📅 Reservation System** - Table booking with time slots
- **🍽️ Menu Management** - Categories, items, dishes with photos
- **👥 User Management** - Role-based permissions (Spatie)
- **📊 Analytics** - Page views and booking statistics  
- **🖥️ Kiosk System** - QR code digital menus
- **🔐 API Authentication** - Laravel Sanctum tokens

## 📬 API Testing

### Postman Collection
Import our Kiosk Availability API collection directly from GitHub:

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/create?source=rip_markdown&url=https://raw.githubusercontent.com/david-gakhokia/api.foodlyapp.ge/main/docs/postman/Kiosk_Availability_API.postman_collection.json)

**Direct URL:**
```
https://raw.githubusercontent.com/david-gakhokia/api.foodlyapp.ge/main/docs/postman/Kiosk_Availability_API.postman_collection.json
```

### API Documentation
- **Kiosk Availability API:** [docs/KIOSK_AVAILABILITY_API.md](docs/KIOSK_AVAILABILITY_API.md) for Restaurant Management & Reservations**

## 🚀 Quick Start

```bash
# Clone & Setup
git clone https://github.com/david-gakhokia/api.foodlyapp.ge.git
cd api.foodlyapp.ge

# Install Dependencies
composer install
npm install

# Environment Setup
cp .env.example .env
php artisan key:generate

# Database Setup
php artisan migrate
php artisan db:seed

# Start Development Server
php artisan serve      # Laravel (Port 8000)
npm run dev           # Vite Assets (Port 5173)
```

## 📱 Core Features

- **🏪 Restaurant Management** - Multi-language support with translations
- **📅 Reservation System** - Table booking with time slots
- **🍽️ Menu Management** - Categories, items, dishes with photos
- **👥 User Management** - Role-based permissions (Spatie)
- **📊 Analytics** - Page views and booking statistics  
- **🖥️ Kiosk System** - QR code digital menus & availability API
- **🔐 API Authentication** - Laravel Sanctum tokens
- **⏰ Availability API** - Real-time restaurant, place & table availability

## 🛠️ Tech Stack

- **Backend:** Laravel 12.19.3 + PHP 8.3.23
- **Database:** MySQL
- **Storage:** Cloudinary (Images)
- **Frontend:** Vite + Node.js
- **Auth:** Laravel Sanctum + Spatie Permissions
- **Features:** QR Codes, PDF Generation, Multi-language

## 📁 Project Structure

```
├── app/
│   ├── Models/           # 25+ Eloquent models
│   ├── Http/Controllers/ # API controllers
│   ├── Services/         # Business logic
│   └── Traits/          # Reusable functionality
├── database/
│   ├── migrations/      # 34 unified migrations
│   └── seeders/         # Essential data only
├── routes/
│   └── api.php         # Protected API endpoints
└── resources/
    └── views/          # Livewire components
```

## 🗄️ Database Overview

**45 Tables Created:**
- **Users & Auth:** 8 tables (users, roles, permissions, tokens)
- **Restaurants:** 12 tables (restaurants, places, tables, spaces)
- **Menu System:** 10 tables (categories, items, dishes, photos)
- **Reservations:** 4 tables (bookings, time slots)
- **Translations:** 15 tables (multi-language support)
- **Analytics:** 2 tables (page views, summaries)
- **System:** 4 tables (cache, jobs, migrations)

## 🔗 API Documentation

**Base URL:** `http://localhost:8000/api`

### Authentication
```http
POST /api/login
POST /api/logout  
POST /api/register
```

### Core Resources (Protected)
```http
GET    /api/restaurants
POST   /api/restaurants
GET    /api/restaurants/{id}

GET    /api/reservations
POST   /api/reservations
PUT    /api/reservations/{id}

GET    /api/menu-categories
GET    /api/menu-items
GET    /api/dishes
```

## 🔧 Development Status

✅ **Completed:**
- Git repository setup & connection
- Syntax error resolution  
- CloudinaryService optimization
- Migration consolidation (41→34 files)
- Essential seeders configuration
- NPM dependencies installation

⏳ **In Progress:**
- NPM security audit fixes
- Development server startup
- Performance optimizations

🎯 **Next Steps:**
- Laravel Cloud deployment
- Production environment setup
- Monitoring & logging configuration

## 📞 Support

**Developer:** David Gakhokia  
**Repository:** https://github.com/david-gakhokia/api.foodlyapp.ge  
**Documentation:** See [PROJECT_DOCUMENTATION.md](PROJECT_DOCUMENTATION.md) for detailed setup guide

---
*Last Updated: July 14, 2025*
