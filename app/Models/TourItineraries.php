<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TourItineraries extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'tour_id',
        'day',
        'title',
        'description',
        'accommodation',
        'service_location',
        'activity_location',
        'service',
        'accomodation_name',
        'status',
    ];

    public function TourPackage()
    {
        return $this->belongsTo(TourPackages::class, 'tour_id', 'id');
    }

    public function Hotel()
    {
        return $this->belongsTo(TourHotels::class, 'hotel_name', 'id');
    }

  


}
