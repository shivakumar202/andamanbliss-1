<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CabPricing extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'location',
        'name',
        'category',
        'base_price',
        'price_type',
        'seat_type',
        'distance_covered',
        'extra_fare',
    ];

    public function pricing()
    {
        return $this->belongsTo(Pricing::class,'seat_type','seat');
    }

    public function cabPackage()
    {
        return $this->hasMany(Pricing::class,'name','id');
    }

     public function cabs()
    {
        return $this->belongsTo(Cabs::class, 'seat_type', 'sitting_capacity');
    }
}
