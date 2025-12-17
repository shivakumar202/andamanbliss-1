<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IslandLocation extends Model
{
    protected $fillable = [
        'island_name',
        'place_id',
        'name',
        'latitude',
        'longitude',
        'distance_km',
    ];
}
