<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelivaryCharge extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'city' => 'string',
        'amount' => 'decimal:2',
    ];
}
