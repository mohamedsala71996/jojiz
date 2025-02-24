<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertApp extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'discount' => 'string',      // Casts to string, but it is nullable
        'type' => 'string',          // Casts to string, but it is nullable
        'image' => 'string',         // Casts to string, but it is nullable
        'expire_time' => 'string', // Assuming 'expire_time' is a datetime string
        'link' => 'string',          // Casts to string, but it is nullable
        'active' => 'boolean',       // If 'active' is meant to be a boolean (e.g., 1 or 0)
    ];
}
