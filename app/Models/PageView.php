<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewable_type',
        'viewable_id',
        'page_type',
        'ip_address',
        'user_agent',
        'referer',
        'session_id',
        'user_id',
        'country',
        'city',
        'metadata',
        'viewed_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'viewed_at' => 'datetime',
    ];

    /**
     * Get the viewable entity (Restaurant, Place, Table, etc.)
     */
    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who viewed the page (if logged in)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for specific page types
     */
    public function scopePageType($query, string $pageType)
    {
        return $query->where('page_type', $pageType);
    }

    /**
     * Scope for date range
     */
    public function scopeDateRange($query, $from, $to)
    {
        return $query->whereBetween('viewed_at', [$from, $to]);
    }

    /**
     * Scope for unique visitors (by IP)
     */
    public function scopeUniqueVisitors($query)
    {
        return $query->distinct('ip_address');
    }

    /**
     * Static method to track a page view
     */
    public static function track($viewable, string $pageType = null, array $additionalData = []): self
    {
        $request = request();
        
        return self::create(array_merge([
            'viewable_type' => get_class($viewable),
            'viewable_id' => $viewable->id,
            'page_type' => $pageType,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referer' => $request->header('referer'),
            'session_id' => session()->getId(),
            'user_id' => Auth::id(),
            'viewed_at' => now(),
        ], $additionalData));
    }
}
