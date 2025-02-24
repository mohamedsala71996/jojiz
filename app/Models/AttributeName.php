<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeName extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'string',
        'status' => 'integer', // Assuming status is stored as an integer
    ];
}
