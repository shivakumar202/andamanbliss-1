<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MetaHeadings extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'table_type',
        'table_id',
        'meta_title',
        'meta_keywords',
        'meta_schema',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'twitter_title',
        'twitter_desc',
        'twitter_image',
    ];

       public function category()
    {
        return $this->belongsTo(Category::class,'table_id')->where('table_type','category-table');
    }

    public function activity()
    {
        return $this->belongsTo(Activities::class,'table_id','id')->where('table_type','activity');
    }

    public function tourPackages()
    {
        return $this->belongsTo(TourPackages::class,'table_id','id')->where('table_type','tour-package');
    }

        public function boatTrip()
    {
        return $this->belongsTo(BoatTripLocations::class,'table_id','id')->where('table_type','boat_trip');
    }
    
}
