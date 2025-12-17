<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Highlights extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'table_name',
        'table_id',
        'icon',
        'title',
        'sub_title',
        'bottom_title',
        'description',
    ];

    public function activity()
    {
        return $this->belongsTo(Activities::class, 'table_id')
            ->where('table_name', 'activity');
    }

}
