<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AnalyticsSummary extends Model
{
    use HasFactory;

    protected $table = 'analytics_summary';

    protected $fillable = [
        'entity_type',
        'entity_id',
        'date',
        'period_type',
        'total_views',
        'unique_visitors',
        'booking_form_views',
        'menu_views',
        'hourly_distribution',
        'top_referrers',
        'top_countries',
    ];

    protected $casts = [
        'date' => 'date',
        'hourly_distribution' => 'array',
        'top_referrers' => 'array',
        'top_countries' => 'array',
    ];

    /**
     * Get the entity (Restaurant, Place, Table, etc.)
     */
    public function entity(): MorphTo
    {
        return $this->morphTo('entity');
    }

    /**
     * Scope for daily summaries
     */
    public function scopeDaily($query)
    {
        return $query->where('period_type', 'daily');
    }

    /**
     * Scope for monthly summaries
     */
    public function scopeMonthly($query)
    {
        return $query->where('period_type', 'monthly');
    }

    /**
     * Scope for date range
     */
    public function scopeDateRange($query, $from, $to)
    {
        return $query->whereBetween('date', [$from, $to]);
    }

    /**
     * Scope for specific entity
     */
    public function scopeForEntity($query, $entity)
    {
        return $query->where('entity_type', get_class($entity))
                    ->where('entity_id', $entity->id);
    }

    /**
     * Create or update summary for an entity and date
     */
    public static function updateSummary($entity, \Carbon\Carbon $date, string $periodType = 'daily'): self
    {
        $summary = self::firstOrCreate([
            'entity_type' => get_class($entity),
            'entity_id' => $entity->id,
            'date' => $date->format('Y-m-d'),
            'period_type' => $periodType,
        ]);

        // Calculate metrics from PageView data
        $pageViews = PageView::where('viewable_type', get_class($entity))
            ->where('viewable_id', $entity->id)
            ->whereDate('viewed_at', $date)
            ->get();

        $summary->update([
            'total_views' => $pageViews->count(),
            'unique_visitors' => $pageViews->unique('ip_address')->count(),
            'booking_form_views' => $pageViews->where('page_type', 'booking_form')->count(),
            'menu_views' => $pageViews->where('page_type', 'menu')->count(),
            'hourly_distribution' => self::calculateHourlyDistribution($pageViews),
            'top_referrers' => self::calculateTopReferrers($pageViews),
            'top_countries' => self::calculateTopCountries($pageViews),
        ]);

        return $summary;
    }

    /**
     * Calculate hourly distribution of views
     */
    private static function calculateHourlyDistribution($pageViews): array
    {
        $hourly = array_fill(0, 24, 0);
        
        foreach ($pageViews as $view) {
            $hour = $view->viewed_at->hour;
            $hourly[$hour]++;
        }

        return $hourly;
    }

    /**
     * Calculate top referrers
     */
    private static function calculateTopReferrers($pageViews): array
    {
        return $pageViews->whereNotNull('referer')
            ->groupBy('referer')
            ->map->count()
            ->sortDesc()
            ->take(10)
            ->toArray();
    }

    /**
     * Calculate top countries
     */
    private static function calculateTopCountries($pageViews): array
    {
        return $pageViews->whereNotNull('country')
            ->groupBy('country')
            ->map->count()
            ->sortDesc()
            ->take(10)
            ->toArray();
    }
}
