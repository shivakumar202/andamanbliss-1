<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcitivityBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'activity_name',
        'name',
        'contact',
        'email',
        'slot',
        'activity_date',
        'adults',
        'child',
        'pp_cost',
        'total_cost',
        'status'
    ];
}
