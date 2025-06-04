<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'tags', 'publish_date', 'stock_count'];
    protected $casts = [
        'tags' => 'array',
        'publish_date' => 'datetime',
    ];
}