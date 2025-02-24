<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productvedio extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'youtube_code' => 'string', // Nullable field cast to string
        'product_id' => 'integer',  // Foreign key, typically an integer
        'status' => 'string',       // Status field as a string
    ];
}
