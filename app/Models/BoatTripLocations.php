<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatTripLocations extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'page_url',
        'page_title',
        'page_desc',
        'status',
    ];



    public function meta()
    {
        return $this->hasOne(MetaHeadings::class, 'table_id', 'id')->where('table_type', 'boat_trip');
    }
    public function faq()
    {
        return $this->hasMany(Faq::class, 'table_id', 'id')->where('table_type', 'boat_trip');
    }


    public function contentBlock()
    {
        return $this->hasOne(ContentBlocks::class, 'activity_id', 'id')->Where('type', 'boat_trip');
    }

    public function tripPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'boat_trip_photo');
    }

}
