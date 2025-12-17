<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BikePickLocation extends Model
{
    use HasFactory,HasRoles,Notifiable;

    protected $fillable = [
        'name',
        'location',
        'latitude',
        'longitude',
        'pick_location',
        'range_km',
    ];
}
