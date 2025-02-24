<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'sub_heading' => 'string',
        'heading' => 'string',
        'desc' => 'string',
        'starting_amount' => 'decimal:2',
        'button_text' => 'string',
        'button_link' => 'string',
        'image' => 'string',
    ];
}
