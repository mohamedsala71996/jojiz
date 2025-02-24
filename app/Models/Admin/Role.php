<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function admins(){
        return $this->hasMany(Admin::class);
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
