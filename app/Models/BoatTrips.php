<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class BoatTrips extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'location',
        'name',
        'adult_price',
        'infant_price',
        'service_tax',
        'start_time',
        'end_time',
        'slot_interval',
        'status',
    ];

    public static function cachedFind($id)
    {
        return Cache::remember("boatTrip_{$id}", now()->addMinutes(60), fn() => self::find($id));
    }


  

}
