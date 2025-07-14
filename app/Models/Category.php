<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

/**
 * 
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $slug
 * @property int $status
 * @property int $rank
 * @property string|null $image
 * @property string|null $image_svg
 * @property string|null $icon
 * @property int $restaurant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\CategoryTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CategoryTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereImageSvg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use Translatable;
    // მეორე DB
    // protected $connection = 'mysql2';

    // categories ცხრილის სახელი
    // protected $table = 'categories';

    // ამ კოლექციაში ჩამოთვლილი ველები აიცვლება translations ცხრილში
    public $translatedAttributes = ['name', 'description'];

    protected $fillable = [
        'parent_id',
        'slug',
        'status',
        'rank',
        'image',
        'image_link',
        'icon',
        'restaurant_id',
    ];
    // შვილეული კატეგორიები
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('rank');
    }

    // მშობელი (არა აუცილებელი, მაგრამ ხარს)
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // ამ კატეგორიასთან დაკავშირებული პროდუქტი
    public function products()
    {
        return $this->hasMany(Product::class)
            ->orderBy('rank');
    }
}
