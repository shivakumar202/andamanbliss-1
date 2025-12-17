<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HotelBookings extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'booking_code',
        'hotel_code',
        'room_name',
        'mode',
        'group',
        'user_id',
        'package_id',
        'net_amt',
        'net_tax',
        'InvoiceNumber',
        'ConfirmationNo',
        'BookingRefNo',
        'BookingId',
        'TraceId',
        'validation',
        'nights',
        'check_in',
        'check_out',
        'amenities',
        'inclusion',
        'per_day_cost',
        'total_cost',
        'total_tax',
        'HotelBookingStatus',
        'rooms',
        'Status',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_code', 'hotel_code');
    }

    public function passengerDetails()
    {
        return $this->hasMany(PassengerDetails::class, 'booking_id', 'id')->where('purpose', 'Hotel Booking');
    }

    public function passengerDetailPackage()
    {
        return $this->hasMany(PassengerDetails::class, 'booking_id', 'package_id')
            ->where('purpose', 'Package Booking');
    }

        public function PackagepaymentDetails()
    {
        return $this->hasMany(RazorpayTransactions::class, 'booking_id', 'package_id')->where('purpose', 'Package Booking');
    }

    public function paymentDetails()
    {
        return $this->hasMany(RazorpayTransactions::class, 'booking_id', 'id')->where('purpose', 'Hotel Booking');
    }

    public function itinerary()
    {
        return $this->belongsTo(TempItinerary::class,'booking_code','room_booking_code');
    }

    public function TempIt()
    {
        return $this->hasMany(TempItinerary::class,'package_id','search_hash')->where('mode','package');
    }


}
