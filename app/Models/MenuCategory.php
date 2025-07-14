<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @mixin \Eloquent
 */
class MenuCategory extends Model
{
    use Translatable, HasSlug;

    protected $fillable = [
        'restaurant_id',
        'parent_id',
        'dish_id',
        'rank',
        'slug',
        'image',
        'image_link',
        'icon',
        'icon_link',
        'status',
    ];

    public $translatedAttributes = ['name', 'description'];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model) {
                // Astrotomic/Translatable-ის best practice:
                // slug-ის წყაროდ ავიღოთ ინგლისური თარგმანი, თუ არ არსებობს - fallback ლოკალი, ბოლოს - პირველი ხელმისაწვდომი თარგმანი

                $slugSource = $model->getTranslation('name', 'en', false);

                if (empty($slugSource)) {
                    $slugSource = $model->getTranslation('name', config('app.fallback_locale'), false);
                }

                if (empty($slugSource)) {
                    foreach (config('translatable.locales') as $locale) {
                        $nameInLocale = $model->getTranslation('name', $locale, false);
                        if (!empty($nameInLocale)) {
                            $slugSource = $nameInLocale;
                            break;
                        }
                    }
                }

                // fallback, თუ მაინც ვერ მოიძებნა
                if (empty($slugSource)) {
                    return 'default-slug-' . uniqid();
                }

                return $slugSource;
            })
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(250)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function parent()
    {
        return $this->belongsTo(MenuCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuCategory::class, 'parent_id');
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
