<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tour_itineraries extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'day',
        'title',
        'description',
        'category',
        'service',
        'service_location',
        'activity_location'
    ];

    public function activities()
    {
        return $this->hasMany(itinerary_activities::class,'itinerary_id','id');
    }

    public function transfers()
    {
        return $this->hasMany(itinerary_transfers::class,'itinerary_id','id');
    }

    public function accommodations()
    {
        return $this->hasMany(itinerary_accommodations::class, 'itinerary_id', 'id');
    }

    public function accommodationForDay()
    {
        return $this->hasOne(itinerary_accommodations::class, 'itinerary_id', 'id')
            ->whereColumn('itinerary_accommodations.day', 'day');
    }

     public function services()
    {
        return $this->belongsTo(TourServices::class,'service','id');
    }



    public function tour()
    {
        return $this->belongsTo(TourPackages::class, 'tour_id');
    }
}
