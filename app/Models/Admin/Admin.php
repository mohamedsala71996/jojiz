<?php

namespace App\Models\Admin;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $guarded = ['id'];

    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function hasPermission($permission_slug)
    {
        return $this->role->permissions()->where('permission_slug', $permission_slug)->first() ? true : false;
    }

    protected $casts = [
        'name' => 'string',
        'display_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'password' => 'string',
        'image' => 'string',
        'status' => 'integer',  // Assuming status is stored as an integer
        'role_id' => 'integer',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
