<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
class RestaurantTranslation extends Model
{
    
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'address'];
}
