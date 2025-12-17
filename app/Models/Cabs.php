<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Cabs extends Model
{
    use HasFactory, HasRoles, Notifiable;

    public $fillable = [
        'name',
        'category',
        'featured',
        'best_seller',
        'sitting_capacity',
        'luggage',
        'start_price',
        'fuel_type',
        'service_locations',
        'description',
        'status',
    ];


    protected $casts = [
        'service_locations' => 'array',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function pricing()
    {
        return $this->hasOne(CabPricing::class, 'seat_type', 'sitting_capacity');
    }

    public function cabBookings()
    {
        return $this->belongsTo(Cabs::class,'id','cab_id');
    }


       public function cabPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')->where('table_type', 'cab_photo');
    }
}
