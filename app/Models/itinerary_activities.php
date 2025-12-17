<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itinerary_activities extends Model
{
    use HasFactory;
     protected $fillable = ['itinerary_id', 'activity_id', 'price'];

    public function itinerary()
    {
        return $this->belongsTo(tour_itineraries::class,'itinerary_id','id');
    }

    public function activity()
    {
        return $this->belongsTo(TourActivities::class,'activity_id','id');
    }
}
