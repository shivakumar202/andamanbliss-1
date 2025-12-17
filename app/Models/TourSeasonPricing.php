<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TourSeasonPricing extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'package_id',
        'price_type',
        'package_cost',
        'season_name',
        'start_date',
        'end_date',
        'markup',
        'status',
    ];

    public function TourPackage()
    {
        return $this->belongsTo(TourPackages::class,'package_id','id');
    }
}
