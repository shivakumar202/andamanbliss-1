<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'rate',
        'price',
        'fees',
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
        'type' => 'string',
        'name' => 'string',
        'rate' => 'decimal:2',
        'price' => 'decimal:2',
        'fees' => 'decimal:2',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => null,
        'name' => null,
        'rate' => 0.00,
        'price' => 0.00,
        'fees' => 0.00,
        'created_at' => null,
        'updated_at' => null,
    ];

    public function addonPhotos()
    {
        return $this->hasOne('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'addon_photo');
    }

    public function service()
    {
        return $this->hasMany(Service::class,'addons','id');
    }
}
