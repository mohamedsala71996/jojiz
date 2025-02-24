<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // relation with city
    public function cities()
    {
        return $this->hasMany(City::class, 'courier_id');
    }
    // relation with zone
    public function zones()
    {
        return $this->hasMany(Zone::class, 'courier_id');
    }
    // relation with area
    public function areas()
    {
        return $this->hasMany(Area::class, 'courier_id');
    }

    protected $casts = [
        'courierName' => 'string',
        'hasCity' => 'string',  // Assuming 'on' or 'off' as strings
        'hasZone' => 'string',  // Assuming 'on' or 'off' as strings
        'hasArea' => 'string',  // Assuming 'on' or 'off' as strings
        'insideDhakaCharge' => 'string', // If this should be numeric, consider using 'decimal:2' or 'integer'
        'nearestDhakaCharge' => 'string', // If this should be numeric, consider using 'decimal:2' or 'integer'
        'outsideDhakaCharge' => 'string', // If this should be numeric, consider using 'decimal:2' or 'integer'
        'status' => 'string', // Default value is 'Active'
    ];

}
