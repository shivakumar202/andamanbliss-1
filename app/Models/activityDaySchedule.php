<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class activityDaySchedule extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'activity_id',
        'heading',
        'time_slot',
        'title',
        'description',
    ];

    public function activity()
    {
        return $this->belongsTo(Activities::class, 'activity_id', 'id');
    }
}
