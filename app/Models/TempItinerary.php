<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempItinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'wh',
        'user_id',
        'category',
        'day_index',
        'hotel_code',
        'room_booking_code',
        'room_name',
        'guest',
        'base_price',
        'hotel_cost',
        'ferry_total',
        'activity_total',   // ✅ must exist in DB
        'service_total',
        'day_total',        // ✅ must exist in DB
        'ferry',
        'search_hash',
        'start_date',
        'status',
    ];

    protected $casts = [
        'accommodation' => 'array',
        'ferries' => 'array',
        'date' => 'date',
    ];

    public function tour()
    {
        return $this->belongsTo(TourPackages::class, 'tour_id')->with('tourCategory');
    }

    public function ferries()
    {
        return $this->hasMany(FerryBookings::class, 'package_id', 'search_hash');
    }

    public function ferribookings()
    {
        return $this->hasOne(FerryBookings::class, 'package_id', 'search_hash');
    }

    public function accomodation()
    {
        return $this->belongsTo(Hotel::class, 'hotel_code', 'hotel_code');
    }

    public function payments()
    {
        return $this->hasMany(RazorpayTransactions::class, 'booking_id', 'search_hash')->where('purpose' ,'Package Booking');
    }

    public function TourPricing()
    {
        return $this->hasOne(PackagePricing::class, 'search_hash', 'search_hash');
    }

    public function hotelbookings()
    {
        return $this->hasOne(HotelBookings::class, 'booking_code', 'room_booking_code');
    }

    public function bookedHotels()
    {
        return $this->hasMany(HotelBookings::class,'package_id','search_hash')->where('mode','package');
    }
    

    public function paxangers()
    {
        return $this->hasMany(PassengerDetails::class,'booking_id','search_hash')->where('purpose','Package booking');
    }
}
