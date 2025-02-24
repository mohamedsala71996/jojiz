<?php

namespace App\Models;

use App\Models\User;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'productvariation_id' => 'integer',
        'size_id' => 'integer',
        'weight_id' => 'integer',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function productvariation(){
        return $this->belongsTo(Productvariation::class);
    }

}
