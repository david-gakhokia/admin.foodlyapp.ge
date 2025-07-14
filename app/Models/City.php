<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Restaurant> $restaurants
 * @property-read int|null $restaurants_count
 * @property-read \App\Models\CityTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CityTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class City extends Model implements TranslatableContract
{
    use Translatable;

    // protected $connection = 'mysql2';
    // protected $table = 'cities';


    protected $guarded = ['id'];
    public $translatedAttributes = ['name'];
    protected $fillable = ['slug', 'image', 'svg', 'rank', 'status'];


    
    // Relationship with restaurants
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}