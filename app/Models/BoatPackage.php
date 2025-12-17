<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BoatPackage extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'days',
        'duration',
        'package_type',
        'description',
        'featured',
        'pax',
        'boat_type',
        'places_covered',
        'base_price',
        'discount',
        'permit_charges',
        'local_permit',
        'non_local_permit',
        'status',
    ];
    protected $casts = [
        'base_price' => 'float',
    ];
    public function inclusions()
    {
        return $this->hasMany(Inclusion::class);
    }
    public function seasonalPrices()
    {
        return $this->hasMany(SeasonalPrice::class);
    }
    public function fishesFounds()
    {
        return $this->hasMany(FishesFound::class);
    }
    public function boatItineraries()
    {
        return $this->hasMany(BoatItinerary::class);
    }

    public function boatImages()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'boat_activity');
    }
}
