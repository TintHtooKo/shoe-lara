<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'name',
        'old_price',
        'new_price',
        'short_desc',
        'long_desc',
        'shoe_type_id',
        'stock',
        'image',
    ];
}
