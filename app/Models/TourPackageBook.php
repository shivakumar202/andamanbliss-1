<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TourPackageBook extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'package_id',
        'name',
        'email',
        'phone',
        'adults',
        'children',
        'travel_date',
        'hotel_amount',
        'ferry_amount',
        'total_amount',
        'payment_status',
        'booking_status',
        'status',
    ];
}
