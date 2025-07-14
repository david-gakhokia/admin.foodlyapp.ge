<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Place extends Model
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['name', 'description'];

    protected $fillable = [
        'restaurant_id',
        'slug',
        'image',
        'image_link',
        'rank',
        'status',
        'qr_code',
        'qr_code_image',
        'qr_code_link',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getRouteKeyName(): string
    {
        $request = request();

        // Admin-ის GET სლაგის მხარდაჭერა
        if ($request->is('api/admin/places/*') && $request->isMethod('get')) {
            return 'slug';
        }

        // Kiosk-ის restaurants/{slug}/place/{place} სლაგზე მხარდაჭერა
        if ($request->is('api/kiosk/restaurants/*/place/*')) {
            return 'slug';
        }

        return 'id';
    }



    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function reservationSlots()
    {
        return $this->hasMany(PlaceReservationSlot::class);
    }


    public function reservations()
    {
        return $this->morphMany(Reservation::class, 'reservable');
    }

    /**
     * Page views for this place
     */
    public function pageViews()
    {
        return $this->morphMany(PageView::class, 'viewable');
    }

    /**
     * Analytics summary for this place
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
     * Track a page view for this place
     */
    public function trackView(string $pageType = null, array $additionalData = []): PageView
    {
        return PageView::track($this, $pageType, $additionalData);
    }

}
