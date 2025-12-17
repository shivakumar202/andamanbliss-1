<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itinerary_transfers extends Model
{
    use HasFactory;

      protected $fillable = ['itinerary_id', 'from', 'to','time', 'ferry_id', 'price'];

    public function itinerary()
    {
        return $this->belongsTo(tour_itineraries::class,'itinerary_id','id');
    }
}
