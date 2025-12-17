<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TourHotels extends Model
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'hotel_name',
        'category',
        'location',
        'landmark',
    ];


    public function tourItinerary()
    {
        return $this->belongsTo(TourItineraries::class,'hotel_name','id');
    }

     public function hotelPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'hotel_photo');
    }
}
