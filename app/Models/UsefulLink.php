<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsefulLink extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $casts = [
    //     'title' => 'string',
    //     'content'   => 'object',
    // ];
}
