<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TourActivities extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'location',
        'service_name',
        'age-limit',
        'description',
        'duration',
        'slots',
        'adult_cost',
        'child_cost',
        'infant_cost',
        'status',
    ];

    public function itineraryActivity()
    {
      
        return $this->belongsTo(itinerary_activities::class,'activity_id','id');
    
    }
}
