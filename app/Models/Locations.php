<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Locations extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'location_name',
        'short_code',
        'status'
    ];

    
}
