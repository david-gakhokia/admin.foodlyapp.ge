<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


class MenuItem extends Model
{
    use Translatable;

    protected $fillable = [
        'restaurant_id',
        'menu_category_id',
        'slug',
        'price',
        'discounted_price',
        'unit',
        'quantity',
        'image',
        'image_link',
        'rank',
        'status',
        'available',
        'is_vegan',
        'is_gluten_free',
        'calories',
        'preparation_time',
    ];

    public $translatedAttributes = ['name', 'description', 'ingredients', 'allergens'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
    
    // Alias for compatibility with code expecting menuCategory relationship
    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
}
