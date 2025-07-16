<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

/**
 * 
 *
 * @property int $id
 * @property string $slug
 * @property int|null $rank
 * @property string|null $image
 * @property string|null $image_link
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Restaurant> $restaurants
 * @property-read int|null $restaurants_count
 * @property-read \App\Models\SpotTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SpotTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spot withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Spot extends Model
{
    use Translatable;

    // Status constants
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
    ];

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
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return static::getStatuses()[$this->status] ?? 'Unknown';
    }

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class)
            ->withPivot(['rank', 'status'])
            ->withTimestamps();
    }
}
