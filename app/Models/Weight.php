<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'product_id' => 'integer',
        'varient_id' => 'integer',
        'weight_id' => 'integer',
        'weight' => 'string', // Weight as string if it includes units or specific formats
        'RegularPrice' => 'decimal:2', // Decimal with 2 decimal places
        'SalePrice' => 'decimal:2', // Decimal with 2 decimal places
        'Discount' => 'decimal:2', // Decimal with 2 decimal places
        'total_stock' => 'integer',
        'stock' => 'integer',
        'sold' => 'integer',
    ];
}
