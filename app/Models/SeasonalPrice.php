<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SeasonalPrice extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'boat_package_id',
        'season',
        'price',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
