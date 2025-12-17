<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FishesFound extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'boat_package_id',
        'name',
        'scientific_name',
        'image',
        'description',
    ];
    protected $casts = [
        'boat_package_id' => 'integer',
    ];
    public function boatPackage()
    {
        return $this->belongsTo(BoatPackage::class);
    }
}
