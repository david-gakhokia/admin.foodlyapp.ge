<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Space extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // Status constants
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_MAINTENANCE = 'maintenance';

    protected $fillable = ['slug', 'status', 'image', 'image_link', 'rank'];

    public $translatedAttributes = ['name', 'description'];

    protected static function booted()
    {
        static::creating(function ($space) {
            if (is_null($space->rank)) {
                $space->rank = (static::max('rank') ?? 0) + 1;
            }
            if (is_null($space->status)) {
                $space->status = static::STATUS_ACTIVE;
            }
        });
    }

    /**
     * Get all available statuses
     */
    public static function getStatuses(): array
    {
        return [
            static::STATUS_ACTIVE => 'Active',
            static::STATUS_INACTIVE => 'Inactive',
            static::STATUS_MAINTENANCE => 'Maintenance',
        ];
    }

    /**
     * Get status label with color
     */
    public function getStatusLabelAttribute(): string
    {
        return static::getStatuses()[$this->status] ?? 'Unknown';
    }

    /**
     * Get status color for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            static::STATUS_ACTIVE => 'green',
            static::STATUS_INACTIVE => 'red',
            static::STATUS_MAINTENANCE => 'yellow',
            default => 'gray',
        };
    }

    /**
     * Scope for active spaces
     */
    public function scopeActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    /**
     * Scope for inactive spaces
     */
    public function scopeInactive($query)
    {
        return $query->where('status', static::STATUS_INACTIVE);
    }

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class)
            ->withPivot(['rank', 'status'])
            ->withTimestamps();
    }
}
