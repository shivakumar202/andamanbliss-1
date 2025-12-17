<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'package_type',
        'hotel_type',
        'flight_ticket',
        'lead_source',
        'city',
        'duration',
        'travel_start',
        'travel_end',
        'adult',
        'child',
        'price_min',
        'price_max',
        'details',
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
        'mobile' => 'string',
        'email' => 'string',
        'package_type' => 'string',
        'hotel_type' => 'string',
        'flight_ticket' => 'string',
        'lead_source' => 'string',
        'city' => 'string',
        'duration' => 'string',
        'travel_start' => 'date:Y-m-d',
        'travel_end' => 'date:Y-m-d',
        'adult' => 'integer',
        'child' => 'integer',
        'price_min' => 'decimal:2',
        'price_max' => 'decimal:2',
        'details' => 'string',
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
        'mobile' => null,
        'email' => null,
        'package_type' => null,
        'hotel_type' => null,
        'flight_ticket' => 'have',
        'lead_source' => 'direct',
        'city' => null,
        'duration' => null,
        'travel_start' => null,
        'travel_end' => null,
        'adult' => 1,
        'child' => 0,
        'price_min' => 0.00,
        'price_max' => 0.00,
        'details' => null,
        'status' => 'active',
        'created_at' => null,
        'updated_at' => null,
    ];
}
