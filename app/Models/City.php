<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'cityName',
        'division',
        'status',
    ];

    // relation with courier
    public function couriers()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
    // relation with zone
    public function zones()
    {
        return $this->hasMany(Zone::class, 'city_id');
    }

    protected $casts = [
        'courier_id' => 'integer',  // Cast as integer, as it's a foreign key
        'cityName' => 'string',
        'division' => 'string',    // Nullable field, still cast as string
        'status' => 'string',      // Cast as string, with a default value of 'Active'
    ];

}
