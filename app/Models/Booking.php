<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_id',
        'table_id',
        'table_type',
        'type',
        'room_id',
        'food_choice',
        'user_id',
        'name',
        'surname',
        'mobile',
        'email',
        'address',
        'rate',
        'quantity',
        'price',
        'adult',
        'child',
        'start_at',
        'end_at',
        'location',
        'destination',
        'note',
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
        'booking_id' => 'integer',
        'table_id' => 'integer',
        'table_type' => 'string',
        'type' => 'string',
        'room_id' => 'integer',
        'food_choice' => 'string',
        'user_id' => 'integer',
        'name' => 'string',
        'surname' => 'string',
        'mobile' => 'string',
        'email' => 'string',
        'address' => 'string',
        'rate' => 'decimal:2',
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'adult' => 'integer',
        'child' => 'integer',
        'start_at' => 'date:Y-m-d',
        'end_at' => 'date:Y-m-d',
        'location' => 'string',
        'destination' => 'string',
        'note' => 'string',
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
        'booking_id' => null,
        'table_id' => null,
        'table_type' => null,
        'type' => null,
        'room_id' => null,
        'food_choice' => null,
        'user_id' => null,
        'name' => null,
        'surname' => null,
        'mobile' => null,
        'email' => null,
        'address' => null,
        'rate' => 0.00,
        'quantity' => 1,
        'price' => 0.00,
        'adult' => 1,
        'child' => 0,
        'start_at' => null,
        'end_at' => null,
        'location' => null,
        'destination' => null,
        'note' => null,
        'status' => 'active',
        'created_at' => null,
        'updated_at' => null,
    ];

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'table_id', 'id');
    }

    public function addon()
    {
        return $this->belongsTo('App\Models\Addon', 'table_id', 'id');
    }

    public function hotelRoomType()
    {
        return $this->belongsTo('App\Models\HotelRoomType', 'room_id', 'id');
    }

    public function activityBook()
    {
        return $this->hasMany(RazorpayTransactions::class, 'booking_id', 'id')->where('purpose', 'Activity Booking');
    }
    public function activity()
    {
        return $this->belongsTo(Activities::class, 'table_id', 'id');
    }
}
