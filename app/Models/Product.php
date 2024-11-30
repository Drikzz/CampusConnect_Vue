<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discounted_price',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
