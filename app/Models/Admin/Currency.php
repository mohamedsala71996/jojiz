<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'admin_id' => 'integer',
        'country'  => 'string',
        'name'     => 'string',
        'code'     => 'string',
        'flag'     => 'string',
        'rate'     => 'decimal:8',
        'default'  => 'integer',
        'status'   => 'integer',
    ];

    public function scopeDefault($query)
    {
        return $query->where('default', true);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
