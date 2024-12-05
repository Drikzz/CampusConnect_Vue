<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'discounted_price',
        'images',
        'stock',
        'seller_code',
        'category_id',
        'trade_method_id'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_code', 'seller_code');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper method to check if product is available
    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tradeMethod()
    {
        return $this->belongsTo(tradeMethod::class);
    }

    public function getMainImageAttribute()
    {
        return $this->images[0];
    }
}
