<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'subject' => 'string',
        'message' => 'string',
    ];
}
