<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorpayTransactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'purpose',
        'booking_id',
        'name',
        'email',
        'phone',
        'payment_id',
        'order_id',
        'address',
        'tax',
        'method',
        'gst',
        'gst_company_name',
        'gst_company_email',
        'gst_company_contact',
        'gst_company_address',
        'currency',
        'amount',
        'tax',
        'status',
        'reminder_sent',
        'mode',
        'json_response',
    ];
    protected $guarded = ['id'];

    public function hotelBookings()
    {
        return $this->belongsTo(HotelBookings::class, 'booking_id', 'id')->where('purpose', 'Hotel Booking');
    }

    public function activityBooking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id')->where('purpose','Activity Booking');
    }

    public function packageBookings()
    {
        return $this->belongsTo(TempItinerary::class, 'booking_id', 'search_hash')->with(['ferries', 'accomodation', 'tour','TourPricing']); 
    }
   
    public function hotelBookingsPackage()
    {
        return $this->belongsTo(HotelBookings::class, 'booking_id', 'package_id')
            ->where('purpose', 'Package');
    }

    public function bikeBooking()
    {
        return $this->belongsTo(RentalBookings::class,'booking_id','id')->where('purpose','Bike Booking');
    }

    public function cabBookings()
    {
        return $this->belongsTo(CabBookings::class,'booking_id','id')->where('purpose','Cab Booking');;
    }

    public function boatBookings()
    {
        return $this->belongsTo(BoatTripBookings::class,'booking_id','id')->where('purpos','Boat Trip Booking');
    }
}
