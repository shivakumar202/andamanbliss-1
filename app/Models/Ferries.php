<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ferries extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'ferry_name',
        'class_name',
        'adult_fare',
        'child_fare',
        'adult_psf',
        'child_psf',
        'from_location',
        'to_location'
    ];
}
