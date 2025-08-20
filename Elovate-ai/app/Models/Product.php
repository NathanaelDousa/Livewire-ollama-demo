<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // i.p.v. gewone Eloquent\Model

class Product extends Model
{
    protected $connection = 'mongodb';   // belangrijk!
    protected $collection = 'products';  // standaard naam voor de collectie

    protected $fillable = [
        'name',
        'description',
        'category',
        'tags',
        'image_url',
    ];

    protected $casts = [
        'tags' => 'array', // zodat tags altijd een array zijn
    ];
}
