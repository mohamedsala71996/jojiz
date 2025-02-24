<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usecoupon extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'user_id' => 'string',    // user_id is cast to string, assuming it might be a UUID or a long string
        'coupon_id' => 'integer', // coupon_id as an integer
        'code' => 'string',       // code as string
        'date' => 'date',         // date as date
    ];
}
