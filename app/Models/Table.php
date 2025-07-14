<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Table extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'slug',
        'restaurant_id',
        'place_id',
        'status',
        'icon',
        'image',
        'image_link',
        'seats',
        'capacity',
        'latitude',
        'longitude',
        'rank',
        'qr_code_image',
        'qr_code_link',
        'qr_code_url',
        'created_by',
        'updated_by',
    ];

    public $translatedAttributes = ['name', 'description'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($table) {
            if (auth()->check()) {
                $table->created_by = auth()->id();
                $table->updated_by = auth()->id();
            }
        });
        
        static::updating(function ($table) {
            if (auth()->check()) {
                $table->updated_by = auth()->id();
            }
        });
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function reservationSlots()
    {
        return $this->hasMany(TableReservationSlot::class);
    }

    public function reservations()
    {
        return $this->morphMany(Reservation::class, 'reservable');
    }

    /**
     * Page views for this table
     */
    public function pageViews()
    {
        return $this->morphMany(PageView::class, 'viewable');
    }

    /**
     * Analytics summary for this table
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
     * Track a page view for this table
     */
    public function trackView(string $pageType = null, array $additionalData = []): PageView
    {
        return PageView::track($this, $pageType, $additionalData);
    }

    /**
     * Get the capacity attribute (use seats if capacity doesn't exist)
     */
    public function getCapacityAttribute()
    {
        return $this->attributes['capacity'] ?? $this->attributes['seats'] ?? null;
    }

    /**
     * Set the capacity attribute (also set seats for backward compatibility)
     */
    public function setCapacityAttribute($value)
    {
        $this->attributes['capacity'] = $value;
        $this->attributes['seats'] = $value;
    }
}
