<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'text' => 'string',
        'rating' => 'double',
        'image' => 'string',
        'status' => 'string',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
