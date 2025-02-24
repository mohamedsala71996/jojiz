<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'qty' => 'integer',
        'color' => 'string',
        'color_id' => 'integer',
        'size' => 'string',
        'size_id' => 'integer',
        'weight' => 'string',
        'weight_id' => 'integer',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productvariation()
    {
        return $this->belongsTo(Productvariation::class, 'color_id');
    }
    public function size()
    {
        return $this->hasOne(Size::class,'size_id','id');
    }
}
