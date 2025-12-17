<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itinerary_accommodations extends Model
    {
        use HasFactory;
        protected $fillable = [
            'itinerary_id', 'category','service_location', 'hotel', 'price' , 'day'
        ];

        public function itinerary()
        {
            return $this->belongsTo(tour_itineraries::class);
        }
}
