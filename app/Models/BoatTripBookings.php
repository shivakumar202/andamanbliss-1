<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BoatTripBookings extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [       
        'booking_no',
        'boat_trip_id',
        'trip_name',
        'slot_time',
        'user_id',
        'adults',
        'trip_date',
        'infants',
        'base_cost',
        'tax',
        'total_amt',
        'status',
    ];

    public function payment()
    {
        return $this->hasOne(RazorpayTransactions::class,'booking_id','id')->where('purpose','Boat Trip Booking');
    }


    public function pax()
    {
        return $this->hasMany(PassengerDetails::class,'booking_id','id')->where('purpose','Boat Trip Booking');
    }
}
