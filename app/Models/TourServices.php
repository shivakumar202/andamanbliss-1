<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TourServices extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'service_location',
        'transfer',
        'service',
        'distance',
        'duration',
        'start_time',
        'day_schedule',
        'six_seater_xylo_ertiga',
        'four_seater_sedan',
        'seven_seater_innova_hexa_marazzo',
        'twelve_seater_winger',
        'seventeen_seater_tempo',
        'twenty_six_seater_tempo_traveller',
    ];


    public function tourItinerary()
    {
        return $this->hasMany(tour_itineraries::class,'service','id');
    }
}
