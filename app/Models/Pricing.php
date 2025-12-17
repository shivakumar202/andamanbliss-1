<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $table = 'pricing';

    protected $fillable = [
        'table_id',
        'table_type',
        'location',
        'price',
        'rate',
        'seat',
        'fees'
    ];

    public function services()
    {
        return $this->belongsTo(Service::class,'table_id','id');
    }

      public function CabPricing()
    {
        return $this->hasMany(CabPricing::class, 'seat_type','seat');
    }
}
