<?php

namespace App\Models\Admin;

use App\Models\AttributeName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function attributeName(){
        return $this->belongsTo(AttributeName::class);
    }

    protected $casts = [
        'name' => 'string',
        'value' => 'string',
        'color_code' => 'string',
        'attribute_name_id' => 'integer', // Assuming it's an integer foreign key
        'status' => 'integer', // Assuming status is stored as an integer
    ];
}
