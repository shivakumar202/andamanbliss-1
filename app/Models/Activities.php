<?php

namespace App\Models;

use Illuminate\Container\ContextualBindingBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Activities extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'location',
        'slug',
        'url',
        'title',
        'rating',
        'category_id',
        'video_url',
        'discount',
        'has_medical_verification',
        'service_name',
        'age-limit',
        'description',
        'best_seller',
        'featured',
        'overview',
        'duration',
        'slots',
        'adult_cost',
        'child_cost',
        'infant_cost',
        'addons',
        'ctc_title',
        'ctc_desc',
        'live_booking',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function meta()
    {
        return $this->hasOne(MetaHeadings::class,'table_id','id')->where('table_type','activity');
    }
    public function daySchedule()
    {
        return $this->hasMany(activityDaySchedule::class, 'activity_id', 'id');
    }

    public function contentBlock()
    {
        return $this->hasMany(ContentBlocks::class, 'activity_id', 'id')->where('type','activity');
    }

    public function activityPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'activity_photo');
    }

    public function facilities()
    {
        return $this->hasMany('App\Models\Facility', 'table_id', 'id')->where('table_type', 'activity');;
    }

    public function policies()
    {
        return $this->hasMany('App\Models\Policy', 'table_id', 'id');
    }

    public function faqs()
    {
        return $this->hasMany('App\Models\Faq', 'table_id', 'id')->where('table_type','activity');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'table_id', 'id');
    }

    public function infoBlocks()
    {
        return $this->hasMany(InfoBlocks::class, 'table_id')
            ->where('table_type', 'activity');
    }

     public function highlights()
    {
        return $this->hasMany(Highlights::class, 'table_id')
            ->where('table_name', 'activity');
    }

public function slots()
{
    return $this->hasOne(ActivitySlots::class, 'activityid', 'id');
}

public function bookings()
{
    return $this->hasMany(Booking::class, 'table_id', 'id')
        ->where('table_type', 'activity');
}


}
