<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RentalBookings extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'vehicle_id',
        'package_id',
        'user_id',
        'pickup',
        'from_location',
        'to_location',
        'pickup_date',
        'pickup_time',
        'trip_type',
        'return_date',
        'return_time',
        'category',
        'package_type',
        'pickup_location',
        'travellers',
        'cab_quantity',
        'name',
        'contact',
        'email',
        'address',
        'payable',
        'total_fare',
        'status',
    ];

    public function bikes()
    {
        return $this->hasOne(Service::class,'id','vehicle_id');
    }

    public function cabPackages()
    {
        return $this->belongsTo(CabPackages::class,'package_id','id');
    }
    
    public function payment()
    {
        return $this->hasOne(RazorpayTransactions::class,'booking_id','id')->where('purpose','Bike Booking');
    }
}
