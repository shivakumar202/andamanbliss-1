<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BoatItinerary extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'boat_package_id',
        'day',
        'title',
        'description',
    ];
    protected $casts = [
        'boat_package_id' => 'integer',
        'day' => 'integer',
    ];
    public function boatPackage()
    {
        return $this->belongsTo(BoatPackage::class);
    }
    
}
