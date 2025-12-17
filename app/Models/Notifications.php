<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_type',
        'visit_url',
        'banner',
        'title',
        'message',
        'action_url',
        'category',
        'status',
    ];

    public function drive()
    {
        return $this->hasOne(Drive::class, 'table_id', 'id')->where('table_type', 'notifications');
    }
}
