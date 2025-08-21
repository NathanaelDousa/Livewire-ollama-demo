<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // nieuwe namespace!

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'name',
        'description',
        'category',
        'image',
        'tags'
    ];
}
