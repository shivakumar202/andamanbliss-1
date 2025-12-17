<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InfoBlocks extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'table_id',
        'table_type',
        'icon',
        'description',
        'name',
    ];

    public function activity()
{
    return $this->belongsTo(Activities::class, 'table_id')
                ->where('table_type', 'activity');
}

}
