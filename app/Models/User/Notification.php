<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'user_id' => 'integer',
        'type' => 'string',
        'title' => 'string',
        'description' => 'string',
        'image' => 'string',
        'link' => 'string',
        'url' => 'string',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
