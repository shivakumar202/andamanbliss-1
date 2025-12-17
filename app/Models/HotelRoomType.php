<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoomType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hotel_id',
        'name',
        'breakfast_rate',
        'breakfast_price',
        'breakfast_fees',
        'dinner_rate',
        'dinner_price',
        'dinner_fees',
        'lunch_rate',
        'lunch_price',
        'lunch_fees',
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
        'hotel_id' => 'integer',
        'name' => 'string',
        'breakfast_rate' => 'decimal:2',
        'breakfast_price' => 'decimal:2',
        'breakfast_fees' => 'decimal:2',
        'dinner_rate' => 'decimal:2',
        'dinner_price' => 'decimal:2',
        'dinner_fees' => 'decimal:2',
        'lunch_rate' => 'decimal:2',
        'lunch_price' => 'decimal:2',
        'lunch_fees' => 'decimal:2',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'hotel_id' => 0,
        'name' => null,
        'breakfast_rate' => 0.00,
        'breakfast_price' => 0.00,
        'breakfast_fees' => 0.00,
        'dinner_rate' => 0.00,
        'dinner_price' => 0.00,
        'dinner_fees' => 0.00,
        'lunch_rate' => 0.00,
        'lunch_price' => 0.00,
        'lunch_fees' => 0.00,
        'created_at' => null,
        'updated_at' => null,
    ];

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel', 'hotel_id', 'id');
    }
}