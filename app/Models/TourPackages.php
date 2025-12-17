<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TourPackages extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'package_name',
        'category_id',
        'nights',
        'days',
        'url',
        'cta_title',
        'cta_description',
        'package_cost',
        'discount',
        'sub_category_id',
        'page_heading',
        'description',
        'islands_covered',  
        'slug',
        'reviews',
        'featured',
        'best_seller',
        'status',
    ];

    protected $casts = [
        'sub_category_id' => 'array',
        'islands_covered' => 'array',

    ];
    public function tourCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(
            subCategories::class,
            'tour_subcategory',     // your actual pivot table name
            'tour_id',      // foreign key for this model in pivot table
            'subcategory_id'        // foreign key for related model in pivot table
        )->withPivot('markup', 'discount', 'discount_above', 'starts_from')->withTimestamps();
    }



    public function SeasonPrice()
    {
        return $this->hasMany(TourSeasonPricing::class, 'package_id', 'id');
    }

    public function TourItinerary()
    {
        return $this->hasMany(tour_itineraries::class, 'tour_id', 'id');
    }

    public function faqs()
    {
        return $this->hasMany('App\Models\Faq', 'table_id', 'id');
    }


    public function tourPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', ['tour_photo']);
    }

    public function contentBlock()
    {
        return $this->hasMany(ContentBlocks::class, 'activity_id', 'id')->where('type', 'tour');
    }
    public function facilities()
    {
        return $this->hasMany('App\Models\Facility', 'table_id', 'id')->where('table_type', 'tour');
    }

    public function inclusions()
    {
        return $this->hasMany(Inclusion::class, 'table_id', 'id')->where('table_name', 'tour');
    }


    public function tempItineraries()
    {
        return $this->hasMany(temp_itineraries::class, 'tour_id', 'id');
    }


   
    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'table_id', 'id')->Where('table_type','tour');
    }

    public function metaHeadings()
    {
        return $this->hasMany(MetaHeadings::class,'table_id','id')->where('table_type','tour-package');
    }

}
