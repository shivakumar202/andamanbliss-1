<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySlots extends Model
{
    use HasFactory;

    protected $fillable = [
        'activityid',
        'slot_start',
        'slot_end',
        'duration',
        'status',
    ];

    public function activities()
    {
        return $this->belongsTo(Activities::class, 'activityid', 'id');
    }
}
