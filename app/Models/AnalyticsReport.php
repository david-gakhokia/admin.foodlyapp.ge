<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class AnalyticsReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description',
        'filters',
        'data',
        'generated_at',
        'generated_by',
        'file_path',
        'expires_at'
    ];

    protected $casts = [
        'filters' => 'array',
        'data' => 'array',
        'generated_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    /**
     * Analytics report types
     */
    const TYPE_BOG_PAYMENTS = 'bog_payments';
    const TYPE_RESERVATIONS = 'reservations';
    const TYPE_REVENUE = 'revenue';
    const TYPE_OVERVIEW = 'overview';
    const TYPE_CONVERSION_FUNNEL = 'conversion_funnel';
    const TYPE_REAL_TIME = 'real_time';

    /**
     * Get available report types
     */
    public static function getReportTypes(): array
    {
        return [
            self::TYPE_BOG_PAYMENTS => 'BOG Payment Analytics',
            self::TYPE_RESERVATIONS => 'Reservation Analytics', 
            self::TYPE_REVENUE => 'Revenue Analytics',
            self::TYPE_OVERVIEW => 'Dashboard Overview',
            self::TYPE_CONVERSION_FUNNEL => 'Conversion Funnel',
            self::TYPE_REAL_TIME => 'Real-time Analytics'
        ];
    }

    /**
     * Check if report is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Get user who generated the report
     */
    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    /**
     * Scope for active reports
     */
    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    /**
     * Scope for reports by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute(): ?string
    {
        if (!$this->file_path || !file_exists(storage_path('app/' . $this->file_path))) {
            return null;
        }

        $bytes = filesize(storage_path('app/' . $this->file_path));
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Generate download URL
     */
    public function getDownloadUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        return route('admin.analytics.download', ['report' => $this->id]);
    }
}
