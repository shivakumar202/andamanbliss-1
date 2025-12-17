<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_itineraries extends Model
{
    use HasFactory;

    protected $table = 'temp_itineraries';

    protected $fillable = [
        'tour_id',
        'day_index',
        'hotel_code',
        'room_booking_code',
        'prebook_response',
        'prebook_response_json',
        'base_price',
        'search_hash',
        'ferry_name',
        'ferry_from',
        'ferry_time',
        'guest',
        'ferry_class',
        'ferry',
        'ferry_total',
        'service_total',
        'luggage',
        'total',
        'start_date',
        'total_cost',
        'hotel_cost',
        'status',
        'category',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
    ];

    public function tour()
    {
        return $this->belongsTo(TourPackages::class, 'tour_id');
    }
}
