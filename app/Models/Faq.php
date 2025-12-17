<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table_id',
        'table_type',
        'question',
        'answer',
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
        'table_id' => 'integer',
        'table_type' => 'string',
        'question' => 'string',
        'answer' => 'string',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'table_id' => 0,
        'table_type' => null,
        'question' => null,
        'answer' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    public function tour()
    {
        return $this->belongsTo('App\Models\Service', 'table_id', 'id')
            ->where('table_type', 'tour');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Service', 'table_id', 'id')
            ->where('table_type', 'hotel');
    }

    public function activity()
    {
        return $this->belongsTo(Activities::class, 'table_id', 'id')
            ->where('table_type', 'activity');
    }

    public function cruise()
    {
        return $this->belongsTo('App\Models\Service', 'table_id', 'id')
            ->where('table_type', 'cruise');
    }

    public function cab()
    {
        return $this->belongsTo('App\Models\Service', 'table_id', 'id')
            ->where('table_type', 'cab');
    }

    public function bike()
    {
        return $this->belongsTo('App\Models\Service', 'table_id', 'id')
            ->where('table_type', 'bike');
    }

     public function category()
    {
        return $this->belongsTo(Category::class, 'table_id', 'id')->where('table_type','category');
    }
    
    public function boatTrip()
    {
        return $this->belongsTo(BoatTripLocations::class,'table_id','id')->where('table_type','boat_trip');
    }
}
