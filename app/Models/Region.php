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
 * @property-read \App\Models\RegionTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RegionTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Region extends Model implements TranslatableContract
{
    use Translatable;

    // protected $connection = 'mysql2';
    // protected $table = 'regions';

    protected $guarded = ['id'];

    public $translatedAttributes = ['name'];
    protected $fillable = ['name', 'slug', 'image', 'svg', 'rank', 'status'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }

    
}
