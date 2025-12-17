<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'isSupport',
        'contact',
        'dob',
        'role',
        'department',
        'description',
        'joining',
    ];

    public function social()
    {
        return $this->hasMany(Social::class);
    }   

    public function photo()
    {
         return $this->hasOne('App\Models\Drive', 'table_id', 'id')->where(['table_type' => 'team_photo']);
    }
}
