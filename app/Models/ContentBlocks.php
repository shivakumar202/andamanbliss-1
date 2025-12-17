<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentBlocks extends Model
{
    use HasFactory;

    protected $fillable = ['activity_id', 'title', 'description', 'type', 'layout', 'column', 'section_blocks',];

    protected $casts = [
        'section_blocks' => 'array',
    ];

    public function activity()
    {
        return $this->belongsTo(Activities::class, 'activity_id', 'id')->where('type', 'activity');
    }

    public function boatTrip()
    {
        return $this->belongsTo(BoatTripLocations::class, 'activity_id', 'id')->where('type', 'boat_trip');
    }
}
