<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class CabBookings extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'email',
        'cab',
        'trip_type',
        'pickup_location',
        'drop_location',
        'pickup_date',
        'flight_no',
        'base_amt',
        'tax',
        'total_amt',
        'paid',
        'pay_part',
        'cab_id',
        'package_id',
        'status',
    ];

    public function cabs()
    {
        return $this->hasOne(Cabs::class,'id','cab_id');
    }

    public function payment()
    {
        return $this->hasOne(RazorpayTransactions::class,'booking_id','id')->where('purpose','Cab Booking');
    }
}
