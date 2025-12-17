<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'table_type',
        'table_id',
        'address',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
        'latitude',
        'longitude',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'table_type' => 'string',
        'table_id' => 'integer',
        'address' => 'string',
        'address2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'country' => 'string',
        'pincode' => 'string',
        'latitude' => 'string',
        'longitude' => 'string',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'table_type' => null,
        'table_id' => 0,
        'address' => null,
        'address2' => null,
        'city' => null,
        'state' => null,
        'country' => null,
        'pincode' => null,
        'latitude' => null,
        'longitude' => null,
    ];
}
