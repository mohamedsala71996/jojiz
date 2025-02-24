<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected function attributeName(){
        return $this->belongsTo(AttributeName::class);
    }

    protected $casts = [
        'name' => 'string',
        'value' => 'string', // Nullable string fields are still cast as string
        'color_code' => 'string', // Nullable string fields are still cast as string
        'attribute_name_id' => 'integer', // Nullable integer fields are still cast as integer
        'status' => 'string', // If 'status' should be treated as a string, cast it accordingly
    ];
}
