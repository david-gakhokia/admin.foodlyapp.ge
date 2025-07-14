<?php
// app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer search($term)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    // მეორე მონაცემთა ბაზა (mysql2 რომ დავარქვით config/database.php-ში)
    // protected $connection = 'mysql2';

    // ცხრილის სახელი მეორე DB–ში (რომელსაც შენ phpMyAdmin-ში users ეწარმოება)
    // protected $table = 'users';

    // მხოლოდ ეს ველები გვაინტერესებს
    protected $fillable = ['id', 'name', 'email'];

    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where('name', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")
                ->orWhere('phone', 'like', "%{$term}%");
        }
    }
}
