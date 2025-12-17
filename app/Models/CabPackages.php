<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class CabPackages extends Model
{
    use HasFactory, Notifiable, HasRoles;


    protected $fillable = [
        'name',
        'route_map',
        'fare_pp',
        'from_location',
        'to_location',
        'location',
        'distance_limit',
        'extra_fare',
        'cab_ids',
        'price_type',
        'package_type',
        'discount',
        'status',
    ];


    public function rentalBookings()
    {
        return $this->hasMany(RentalBookings::class, 'package_id', 'id');
    }

    public function cabPricing()
    {
        return $this->belongsTo(CabPricing::class, 'name', 'id');
    }

    public function services()
    {
        return Service::whereIn('id', json_decode($this->cab_ids, true))->get();
    }
}
