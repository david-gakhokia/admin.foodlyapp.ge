<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

/**
 * 
 *
 * @property-read \App\Models\ProductTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Product extends Model
{

    use Translatable;

    // თარგმნადი ველები
    public $translatedAttributes = [
        'name',
        'description', 
    ];

    // დანარჩენი fillable–ები
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'image',
        'status',
        'rank',
        'quantity',
        'discounted_price',
        'restaurant_id',
        'category_id',
    ];

    // Define relationship with translations
    public function translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }
}
