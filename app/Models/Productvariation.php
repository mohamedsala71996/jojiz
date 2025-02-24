<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productvariation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function sizes()
    {
        return $this->hasMany(Size::class, 'varient_id');
    }

    public function productvariationimages()
    {
        return $this->hasMany(ProductVariationImage::class,'variation_id','id');
    }
    protected $casts = [
        'product_id' => 'integer',
        'image' => 'string',
        'color_id' => 'integer',
        'color' => 'string',
        'color_code' => 'string',
        'code_id' => 'integer',
        'code' => 'string',
        'status' => 'string',
    ];


}
