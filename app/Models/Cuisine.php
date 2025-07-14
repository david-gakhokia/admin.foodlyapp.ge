<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

/**
 * 
 *
 * @property int $id
 * @property string $slug
 * @property string $status
 * @property int $rank
 * @property string|null $image
 * @property string|null $image_link
 * @property string|null $icon
 * @property string|null $icon_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Restaurant> $restaurants
 * @property-read int|null $restaurants_count
 * @property-read \App\Models\CuisineTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CuisineTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Database\Factories\CuisineFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereIconLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cuisine withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Cuisine extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'slug',
        'status',
        'rank',
        'image',
        'image_link',
        'icon',
        'icon_link',
    ];

    public $translatedAttributes = [
        'name',
        'description',
        'meta_title',
        'meta_desc',
    ];

    // Relationship with restaurants
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class)
            ->withPivot('rank', 'status')
            ->withTimestamps();
    }
}
