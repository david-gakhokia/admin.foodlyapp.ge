<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MenuCategoryTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'description'
    ];
}
