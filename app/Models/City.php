<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class City extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_MAINTENANCE = 'maintenance';

    protected $fillable = [
        'slug',
        'rank',
        'image',
        'image_link',
        'status',
    ];

    public $translatedAttributes = [
        'name',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected static function booted()
    {
        static::creating(function ($city) {
            if (is_null($city->rank)) {
                $city->rank = (static::max('rank') ?? 0) + 1;
            }
            if (is_null($city->status)) {
                $city->status = static::STATUS_ACTIVE;
            }
        });
    }

    public static function getStatuses(): array
    {
        return [
            static::STATUS_ACTIVE => 'Active',
            static::STATUS_INACTIVE => 'Inactive',
            static::STATUS_MAINTENANCE => 'Maintenance',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return static::getStatuses()[$this->status] ?? 'Unknown';
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            static::STATUS_ACTIVE => 'green',
            static::STATUS_INACTIVE => 'red',
            static::STATUS_MAINTENANCE => 'yellow',
            default => 'gray',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', static::STATUS_INACTIVE);
    }

    // Example relationship (change as needed)
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class)
            ->withPivot(['rank', 'status'])
            ->withTimestamps();
    }
}
