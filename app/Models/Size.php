<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'product_id' => 'integer',
        'varient_id' => 'integer',
        'size_id' => 'integer',
        'RegularPrice' => 'double',
        'SalePrice' => 'double',
        'Discount' => 'double',
        'total_stock' => 'integer',
        'stock' => 'integer',
        'sold' => 'integer',
        'buy_price' => 'integer',
    ];

}
