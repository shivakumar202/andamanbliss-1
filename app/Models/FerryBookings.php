<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FerryBookings extends Model
{
  use HasFactory, Notifiable;

  protected $fillable = [
    'pnr_no',
    'trip_id',
    'package_id',
    'name',
    'phone',
    'email',
    'trip_no',
    'gst',
    'from_location',
    'user_id',
    'to_location',
    'travel_date',
    'embarkation',
    'disembarkation',
    'class',
    'class_id',
    'ferry',
    'vesselId',
    'booking_mode',
    'booking_status',
    'bookno',
    'baseFare',
    'infantFare',
    'totalCost',
    'payment_status',
    'Psf',
    'Adult',
    'Infants',
    'base_code',
  ];

  protected $casts = [
    'embarkation' => 'datetime',
    'disembarkation' => 'datetime',
    'travel_date' => 'datetime',
  ];

  public function passengerDetails()
  {
    return $this->hasMany(PassengerDetails::class, 'booking_id', 'id');
  }

  public function tempItnerary()
  {
    return $this->belongsTo(TempItinerary::class, 'package_id', 'search_hash');
  }
}
