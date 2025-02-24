<?php

namespace App\Models\User;

use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QA extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function reply(){
        return $this->hasMany(QA::class,'qna_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    protected $casts = [
        'user_id' => 'integer',  // Nullable foreign key
        'admin_id' => 'string', // Nullable integer
        'product_id' => 'string', // Foreign key
        'qna_id' => 'integer',   // Nullable integer
        'type' => 'string',
        'from' => 'string',
        'question' => 'string', // Nullable
        'answer' => 'string',   // Nullable
    ];
}
