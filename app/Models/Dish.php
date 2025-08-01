<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


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


    public function menuItems()
    {
        return $this->hasMany(\App\Models\MenuItem::class);
    }

    // public function restaurants()
    // {
    //     return $this->belongsToMany(Restaurant::class)
    //         ->withTimestamps()
    //         ->withPivot('rank', 'status'); // სურვილისამებრ
    // }
}
