<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

/**
 * 
 *
 * @property int $id
 * @property string $slug
 * @property int $status
 * @property int $rank
 * @property string|null $image
 * @property string|null $image_link
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Restaurant> $restaurants
 * @property-read int|null $restaurants_count
 * @property-read \App\Models\DishTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DishTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Dish extends Model
{
    use Translatable;

    protected $fillable = ['slug', 'status', 'rank', 'image', 'image_link', 'category_id'];

    // 1. 🏷️ აქ უთითებ, რომელი ველები ითარგმნება
    public $translatedAttributes = ['name', 'description'];

    // 2. 📎 მოდელს უკავშირებ თარგმანის კლასს
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function menuCategories()
    {
        return $this->hasMany(MenuCategory::class);
    }

    protected static function booted()
    {
        static::creating(function ($dish) {
            if (is_null($dish->rank)) {
                $dish->rank = (Dish::max('rank') ?? 0) + 1;
            }
        });
    }


    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_dish')
            ->withPivot(['rank', 'status'])
            ->withTimestamps();
    }


    // public function restaurants()
    // {
    //     return $this->belongsToMany(Restaurant::class)
    //         ->withTimestamps()
    //         ->withPivot('rank', 'status'); // სურვილისამებრ
    // }
}
