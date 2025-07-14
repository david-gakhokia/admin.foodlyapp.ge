<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductTranslation query()
 * @mixin \Eloquent
 */
class ProductTranslation extends Model
{
    public $timestamps = false;   

    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'description',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
