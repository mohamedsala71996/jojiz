<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderproduct extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function productvariation(){
        return $this->belongsTo(Productvariation::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }

    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
        'productSku' => 'string',
        'productName' => 'string',
        'color' => 'string',
        'size' => 'string',
        'size_id' => 'integer', // Nullable integer fields are still cast as integer
        'code' => 'string',
        'code_id' => 'integer', // Nullable integer fields are still cast as integer
        'weight' => 'string',
        'weight_id' => 'integer', // Nullable integer fields are still cast as integer
        'productvariation_id' => 'string',
        'price' => 'integer',
        'qty' => 'integer',
    ];

}
