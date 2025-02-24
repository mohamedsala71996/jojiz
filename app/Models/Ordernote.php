<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordernote extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'order_id' => 'integer',
        'comment' => 'string',
        'user_id' => 'integer', // Nullable integer fields are still cast as integer
        'admin_id' => 'integer', // Nullable integer fields are still cast as integer
        'status' => 'string', // Status as string for flexibility
    ];
}
