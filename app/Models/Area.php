<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'courier_id',
        'zone_id',
        'areaName',
        'areaId',
        'status',
    ];

    // relation with city
    public function couriers()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
    // relation with zones
    public function zones()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    protected $casts = [
        'courier_id' => 'integer',
        'zone_id' => 'integer',
        'areaName' => 'string',
        'areaId' => 'string',
        'status' => 'string',
    ];

}
