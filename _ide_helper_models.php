<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $entity_type
 * @property int $entity_id
 * @property \Illuminate\Support\Carbon $date
 * @property string $period_type
 * @property int $total_views
 * @property int $unique_visitors
 * @property int $booking_form_views
 * @property int $menu_views
 * @property array<array-key, mixed>|null $hourly_distribution
 * @property array<array-key, mixed>|null $top_referrers
 * @property array<array-key, mixed>|null $top_countries
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary daily()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary dateRange($from, $to)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary forEntity($entity)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary monthly()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereBookingFormViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereHourlyDistribution($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereMenuViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary wherePeriodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereTopCountries($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereTopReferrers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereTotalViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereUniqueVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnalyticsSummary whereUpdatedAt($value)
 */
	class AnalyticsSummary extends \Eloquent {}
}

namespace App\Models{
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
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $category_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CategoryTranslation extends \Eloquent {}
}

namespace App\Models{
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
	class City extends \Eloquent implements \Astrotomic\Translatable\Contracts\Translatable {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityTranslation query()
 * @mixin \Eloquent
 */
	class CityTranslation extends \Eloquent {}
}

namespace App\Models{
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
	class Cuisine extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cuisine_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereCuisineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CuisineTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer search($term)
 * @mixin \Eloquent
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuCategory> $menuCategories
 * @property-read int|null $menu_categories_count
 */
	class Dish extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $dish_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class DishTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $identifier
 * @property string $secret
 * @property string|null $name
 * @property string|null $location
 * @property string $status
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $last_seen
 * @property string $mode
 * @property string|null $content
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereLastSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Kiosk extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $restaurant_id
 * @property int|null $parent_id
 * @property int|null $dish_id
 * @property string $slug
 * @property string|null $image
 * @property string|null $image_link
 * @property string|null $icon
 * @property string|null $icon_link
 * @property int $rank
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MenuCategory> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Dish|null $dish
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuItem> $menuItems
 * @property-read int|null $menu_items_count
 * @property-read MenuCategory|null $parent
 * @property-read \App\Models\Restaurant $restaurant
 * @property-read \App\Models\MenuCategoryTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuCategoryTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereIconLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategory withTranslation(?string $locale = null)
 */
	class MenuCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $menu_category_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategoryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategoryTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategoryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategoryTranslation whereMenuCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuCategoryTranslation whereName($value)
 */
	class MenuCategoryTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $menu_category_id
 * @property int $restaurant_id
 * @property string $slug
 * @property string|null $image
 * @property string|null $image_link
 * @property string|null $unit
 * @property string $quantity
 * @property string $price
 * @property string|null $discounted_price
 * @property int $is_vegan
 * @property int $is_gluten_free
 * @property int|null $calories
 * @property int $rank
 * @property int|null $preparation_time
 * @property int $available
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MenuCategory $category
 * @property-read \App\Models\MenuCategory $menuCategory
 * @property-read \App\Models\Restaurant $restaurant
 * @property-read \App\Models\MenuItemTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuItemTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereCalories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereDiscountedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereIsGlutenFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereIsVegan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereMenuCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem wherePreparationTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem withTranslation(?string $locale = null)
 */
	class MenuItem extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $menu_item_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $ingredients
 * @property string|null $allergens
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereAllergens($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereMenuItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItemTranslation whereUpdatedAt($value)
 */
	class MenuItemTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $viewable_type
 * @property int $viewable_id
 * @property string|null $page_type
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $referer
 * @property string|null $session_id
 * @property int|null $user_id
 * @property string|null $country
 * @property string|null $city
 * @property array<array-key, mixed>|null $metadata
 * @property \Illuminate\Support\Carbon $viewed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $viewable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView dateRange($from, $to)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView pageType(string $pageType)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView uniqueVisitors()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView wherePageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereReferer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereViewableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereViewableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageView whereViewedAt($value)
 */
	class PageView extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $title
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Photo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $restaurant_id
 * @property string $slug
 * @property string|null $qr_code
 * @property string|null $qr_code_image
 * @property string|null $qr_code_link
 * @property string $status
 * @property int $rank
 * @property string|null $image
 * @property string|null $image_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AnalyticsSummary> $analyticsSummary
 * @property-read int|null $analytics_summary_count
 * @property-read int $booking_form_views
 * @property-read int $total_views
 * @property-read int $unique_visitors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PageView> $pageViews
 * @property-read int|null $page_views_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceReservationSlot> $reservationSlots
 * @property-read int|null $reservation_slots_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\Restaurant $restaurant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Table> $tables
 * @property-read int|null $tables_count
 * @property-read \App\Models\PlaceTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereQrCodeImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereQrCodeLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place withTranslation(?string $locale = null)
 */
	class Place extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $place_id
 * @property int $day_of_week
 * @property string $time_from
 * @property string $time_to
 * @property int $slot_interval_minutes
 * @property bool $available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Place $place
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot whereSlotIntervalMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceReservationSlot whereUpdatedAt($value)
 */
	class PlaceReservationSlot extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $place_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceTranslation wherePlaceId($value)
 */
	class PlaceTranslation extends \Eloquent {}
}

namespace App\Models{
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
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductTranslation query()
 * @mixin \Eloquent
 */
	class ProductTranslation extends \Eloquent {}
}

namespace App\Models{
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
	class Region extends \Eloquent implements \Astrotomic\Translatable\Contracts\Translatable {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegionTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegionTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegionTranslation query()
 * @mixin \Eloquent
 */
	class RegionTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string $reservable_type
 * @property int $reservable_id
 * @property \Illuminate\Support\Carbon $reservation_date
 * @property \Illuminate\Support\Carbon $time_from
 * @property \Illuminate\Support\Carbon $time_to
 * @property int $guests_count
 * @property string|null $occasion
 * @property string $name
 * @property string $phone
 * @property string|null $email
 * @property string|null $promo_code
 * @property string|null $notes
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $reservable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereGuestsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereOccasion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation wherePromoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereReservableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereReservableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereReservationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUpdatedAt($value)
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $slug
 * @property string|null $qr_code
 * @property string|null $qr_code_image
 * @property string|null $qr_code_link
 * @property string|null $time_zone
 * @property string $status
 * @property int $rank
 * @property string|null $logo
 * @property string|null $image
 * @property string|null $video
 * @property string|null $phone
 * @property string|null $whatsapp
 * @property string|null $email
 * @property string|null $website
 * @property int $discount_rate
 * @property string|null $price_per_person
 * @property string|null $price_currency
 * @property string|null $working_hours
 * @property int|null $delivery_time
 * @property string|null $reservation_type
 * @property string|null $map_link
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $map_embed_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $version
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AnalyticsSummary> $analyticsSummary
 * @property-read int|null $analytics_summary_count
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cuisine> $cuisines
 * @property-read int|null $cuisines_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 * @property-read int $booking_form_views
 * @property-read int $total_views
 * @property-read int $unique_visitors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuCategory> $menuCategories
 * @property-read int|null $menu_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuItem> $menuItems
 * @property-read int|null $menu_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PageView> $pageViews
 * @property-read int|null $page_views_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Place> $places
 * @property-read int|null $places_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RestaurantReservationSlot> $reservationSlots
 * @property-read int|null $reservation_slots_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Space> $spaces
 * @property-read int|null $spaces_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Spot> $spots
 * @property-read int|null $spots_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Table> $tables
 * @property-read int|null $tables_count
 * @property-read \App\Models\RestaurantTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RestaurantTranslation> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User|null $updater
 * @method static \Database\Factories\RestaurantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereDeliveryTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereDiscountRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereMapEmbedLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant wherePriceCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant wherePricePerPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereQrCodeImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereQrCodeLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereReservationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereWorkingHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant withTranslation(?string $locale = null)
 */
	class Restaurant extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $restaurant_id
 * @property string $day_of_week
 * @property string $time_from
 * @property string $time_to
 * @property int $slot_interval_minutes
 * @property bool $available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Restaurant $restaurant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereSlotIntervalMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantReservationSlot whereUpdatedAt($value)
 */
	class RestaurantReservationSlot extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $restaurant_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $address
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class RestaurantTranslation extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read string $status_color
 * @property-read string $status_label
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Restaurant> $restaurants
 * @property-read int|null $restaurants_count
 * @property-read \App\Models\SpaceTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SpaceTranslation> $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space active()
 * @method static \Database\Factories\SpaceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Space withTranslation(?string $locale = null)
 */
	class Space extends \Eloquent implements \Astrotomic\Translatable\Contracts\Translatable {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $space_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation whereSpaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpaceTranslation whereUpdatedAt($value)
 */
	class SpaceTranslation extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read string $status_label
 */
	class Spot extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $spot_id
 * @property string $locale
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereSpotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SpotTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $slug
 * @property string|null $qr_code
 * @property string|null $qr_code_image
 * @property string|null $qr_code_link
 * @property int|null $restaurant_id
 * @property int|null $place_id
 * @property string $status
 * @property string|null $icon
 * @property string|null $image
 * @property string|null $image_link
 * @property int|null $seats
 * @property int|null $capacity
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int|null $rank
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AnalyticsSummary> $analyticsSummary
 * @property-read int|null $analytics_summary_count
 * @property-read \App\Models\User|null $createdBy
 * @property-read int $booking_form_views
 * @property-read int $total_views
 * @property-read int $unique_visitors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PageView> $pageViews
 * @property-read int|null $page_views_count
 * @property-read \App\Models\Place|null $place
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TableReservationSlot> $reservationSlots
 * @property-read int|null $reservation_slots_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\Restaurant|null $restaurant
 * @property-read \App\Models\TableTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TableTranslation> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table translated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereQrCodeImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereQrCodeLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table withTranslation(?string $locale = null)
 */
	class Table extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $table_id
 * @property string $day_of_week
 * @property string $time_from
 * @property string $time_to
 * @property int $slot_interval_minutes
 * @property bool $available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Table $table
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereSlotIntervalMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableReservationSlot whereUpdatedAt($value)
 */
	class TableReservationSlot extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $table_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TableTranslation whereUpdatedAt($value)
 */
	class TableTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

