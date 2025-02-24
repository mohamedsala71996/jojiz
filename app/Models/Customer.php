<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'order_id' => 'integer',
        'user_id' => 'integer',
        'customerName' => 'string',
        'customerEmail' => 'string',  // Nullable field, still cast as string
        'customerPhone' => 'string',  // Nullable field, still cast as string
    ];
}
