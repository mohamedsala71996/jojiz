<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'id' => 'integer',
        'variation_id' => 'string',
        'image_path' => 'string',
    ];
}
