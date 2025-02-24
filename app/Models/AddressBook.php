<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'phone' => 'string',
        'country' => 'string',
        'state' => 'string',
        'city' => 'string',
        'street' => 'string',
        'zip' => 'string',
        'status' => 'string',
    ];
}
