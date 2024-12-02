<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'discounted_price',
        'stock',
        'image',
        'user_id',
        'is_buyable',
        'is_tradable',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
