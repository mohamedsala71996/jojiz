<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'city_id',
        'zoneName',
        'zoneId',
        'status',
    ];

    // relation with courier
    public function couriers()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
    // relation with city
    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    // relation with areas
    public function areas()
    {
        return $this->hasMany(Area::class, 'zone_id');
    }

    protected $casts = [
        'courier_id' => 'integer',   // Foreign key, typically a large integer
        'city_id' => 'integer',      // Foreign key, typically a large integer
        'zoneName' => 'string',         // Name of the zone as a string
        'zoneId' => 'integer',          // Zone ID, nullable integer
        'status' => 'string',           // Status as a string
    ];
}
