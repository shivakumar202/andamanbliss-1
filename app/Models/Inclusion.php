<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Inclusion extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'boat_package_id',
        'type',
        'icon',
        'table_name',
        'description',
    ];
}
