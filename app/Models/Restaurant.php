<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Restaurant extends Model
{

    use Translatable, HasFactory;

    // protected $connection = 'mysql2';
    // protected $table = 'restaurants';

    public $translatedAttributes = ['name', 'description', 'address'];

    protected $fillable = [
        'slug',
        'status',
        'rank',
        'logo',
        'image',
        'video',
        'phone',
        'email',
        'whatsapp',
        'website',
        'discount_rate',
        'latitude',
        'longitude',
        'map_link',
        'map_embed_link',
        'time_zone',
        'price_per_person',
        'price_currency',
        'working_hours',
        'delivery_time',
        'reservation_type',
        'time_zone',
        'qr_code_image',
        'qr_code_link',
        'created_by',
        'updated_by',
        'version',
    ];


    public function translations()
    {
        return $this->hasMany(RestaurantTranslation::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function tables()
    {
        return $this->hasMany(\App\Models\Table::class);
    }

    public function spaces()
    {
        return $this->belongsToMany(Space::class)
            ->withPivot(['rank', 'status'])
            ->withTimestamps();
    }

    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class)
            ->withPivot('rank', 'status')
            ->withTimestamps();
    }

    public function spots()
    {
        return $this->belongsToMany(Spot::class)
            ->withPivot(['rank', 'status'])
            ->withTimestamps();
    }


    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'restaurant_dish')
            ->withPivot(['rank', 'status'])
            ->withTimestamps();
    }

    public function menuCategories()
    {
        return $this->hasMany(MenuCategory::class)
            ->orderBy('rank')
            ->where('status', 'active');
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class)
            ->orderBy('rank')
            ->where('status', 'active');
    }
    // public function reservation_slots()
    // {
    //     return $this->hasMany(RestaurantReservationSlot::class);
    // }

    public function reservationSlots()
    {
        return $this->hasMany(RestaurantReservationSlot::class, 'restaurant_id');
    }

    public function reservations()
    {
        return $this->morphMany(Reservation::class, 'reservable');
    }

    /**
     * User who created this restaurant
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User who last updated this restaurant
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Page views for this restaurant
     */
    public function pageViews()
    {
        return $this->morphMany(PageView::class, 'viewable');
    }

    /**
     * Analytics summary for this restaurant
     */
    public function analyticsSummary()
    {
        return $this->morphMany(AnalyticsSummary::class, 'entity');
    }

    /**
     * Get total views count
     */
    public function getTotalViewsAttribute(): int
    {
        return $this->pageViews()->count();
    }

    /**
     * Get unique visitors count
     */
    public function getUniqueVisitorsAttribute(): int
    {
        return $this->pageViews()->distinct('ip_address')->count();
    }

    /**
     * Get booking form views count
     */
    public function getBookingFormViewsAttribute(): int
    {
        return $this->pageViews()->where('page_type', 'booking_form')->count();
    }

    /**
     * Track a page view for this restaurant
     */
    public function trackView(string $pageType = null, array $additionalData = []): PageView
    {
        return PageView::track($this, $pageType, $additionalData);
    }

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        // Increment version on update
        static::updating(function ($restaurant) {
            $restaurant->version = ($restaurant->version ?? 1) + 1;
        });

        // Set initial version on create
        static::creating(function ($restaurant) {
            if (!isset($restaurant->version)) {
                $restaurant->version = 1;
            }
        });
    }
}
