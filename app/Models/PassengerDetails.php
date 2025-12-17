<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PassengerDetails extends Model
{
    use HasFactory,HasRoles,Notifiable;

    protected $fillable = [
        'booking_id',
        'purpose',
        'prefix',
        'last_name',
        'm_name',
        'lead', 
        'type',
        'name',
        'age',
        'group',
        'ticket_no',
        'gender',
        'seat_no',
        'pass_no',
        'pass_exp',
        'pass_issue',
        'tier',
        'class',
        'id_no',
        'nationality',
    ];

    public function FerryBookings()
    {
        return $this->belongsTo(FerryBookings::class,'booking_id','id')->where('purpose','Ferry Booking');
    }

    public function hotelBookings()
    {
        return $this->belongsTo(HotelBookings::class,'booking_id','id')->where('purpose','Hotel Booking');
    }

 
public function hotelBookingsPackage()
{
    return $this->belongsTo(HotelBookings::class, 'booking_id', 'package_id')
        ->where('purpose', 'Package');
}

public function boatTrips()
{
    return $this->belongsTo(BoatTripBookings::class,'booking_id','id')->where('purpose','Boat Trip Booking');
}

public function tourItinerary()
{
    return $this->belongsTo(TempItinerary::class,'booking_id','search_hash')->where('purpose','Package Booking');
}



}
