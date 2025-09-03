<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','description','category','product_type','brand',
        'actual_price','discounted_price','unit','image','content_per_container'
    ];

    protected $casts = [
        'actual_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
    ];

    public function getEffectivePriceAttribute(): float {
        return (float)($this->discounted_price ?? $this->actual_price);
    }
}
