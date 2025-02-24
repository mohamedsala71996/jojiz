<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCredential extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'gateway' => 'string',        // Cast as string
        'credentials' => 'array',     // JSON field should be cast to array
        'image' => 'string',          // Nullable string for image
        'status' => 'boolean',        // Cast status field as boolean
    ];

    protected $hidden = [
        'credentials',

    ];
}
