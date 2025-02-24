<?php

namespace App\Models;

use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'code' => 'string',
        'type' => 'string',
        'amount' => 'string', // If amount should be numeric, consider changing this to 'decimal:2' or 'integer'
        'date' => 'date', // Cast as date
        'validity' => 'date', // Cast as date
        'status' => 'string',
        'coupon_type' => 'string',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_coupon');
    }

}
