<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Hotel extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'hotel_code',
        'hotel_name',
        'slug',
        'hotel_rating',
        'address',
        'attractions',
        'country_name',
        'hotel_image',
        'hotel_gallery',
        'country_code',
        'description',
        'fax_number',
        'hotel_facilities',
        'map',
        'phone_number',
        'pin_code',
        'hotel_website_url',
        'city_name',
        'status',
    ];

    protected $casts = [
        'attractions' => 'array',
        'hotel_facilities' => 'array',
    ];

    public function hotelBookings()
    {
        return $this->hasMany(HotelBookings::class, 'hotel_code', 'hotel_code');
    }
    public function tempItineraries()
    {
        return $this->hasMany(TempItinerary::class, 'hotel_code', 'hotel_code');
    }


}
