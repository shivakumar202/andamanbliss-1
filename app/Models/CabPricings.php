<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CabPricings extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'location',
        'name',
        'base_price',
        'price_type',
        'seat_type',
        'distance_covered',
        'extra_fare',
        'created_at',
        'updated_at',
    ];
}
