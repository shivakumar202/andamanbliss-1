<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePricing extends Model
{
    use HasFactory;

      protected $fillable = [
        'package_id',
        'search_hash',
        'base_total',
        'markup',
        'total_with_markup',
        'discount',
        'discount_above',
        'total_with_discount',
        'gst_rate',
        'gst_amount',
        'grand_total',
        'days_diff',
        'paying_percent',
        'payable_amt',
        'balance_amt',
    ];

    public function tourItineraries()
    {
      return $this->belongsTo(TempItinerary::class,'search_hash','search_hash');
    }
}
