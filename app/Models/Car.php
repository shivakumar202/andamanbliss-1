<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $appends = ['fullname'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'reg_no',
        'reg_date',
        'fuel',
        'cc',
        'seat',
        'ac',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
        'reg_no' => 'string',
        'reg_date' => 'date:Y-m-d',
        'fuel' => 'string',
        'cc' => 'integer',
        'seat' => 'integer',
        'ac' => 'string',
        'status' => 'string',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'name' => null,
        'reg_no' => null,
        'reg_date' => null,
        'fuel' => null,
        'cc' => 0,
        'seat' => 0,
        'ac' => 'no',
        'status' => 'active',
        'created_at' => null,
        'updated_at' => null,
    ];

    /**
     * Set the user's name.
     *
     * @param  string $value
     * @return void
     */
    public function getFullnameAttribute()
    {
        return ucwords("{$this->name} - {$this->reg_no}");
    }

    public function photo()
    {
        return $this->hasOne('App\Models\Drive', 'table_id', 'id')->where(['table_type' => 'car_photo']);
    }
}
