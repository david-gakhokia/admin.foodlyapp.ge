<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;

class TableTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description'];
}
