<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'type',
        'slug',
        'name',
        'adult_rate',
        'adult_price',
        'adult_fees',
        'child_rate',
        'child_price',
        'child_fees',
        'address',
        'gmap',
        'title',
        'featured',
        'best_seller',
        'add_ons',
        'ratings',
        'reviews_count',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_schema',
        'meta_description',
        'status',
        'duration',
        'og_title',
        'og_description',
        'og_type',
        'og_image',
        'og_site',
        'twitter_card',
        'twitter_title',
        'twitter_desc',
        'twitter_image'
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
        'category_id' => 'integer',
        'type' => 'string',
        'slug' => 'string',
        'name' => 'string',
        'adult_rate' => 'decimal:2',
        'adult_price' => 'decimal:2',
        'adult_fees' => 'decimal:2',
        'child_rate' => 'decimal:2',
        'child_price' => 'decimal:2',
        'child_fees' => 'decimal:2',
        'address' => 'string',
        'gmap' => 'string',
        'featured' => 'integer',
        'best_seller' => 'integer',
        'ratings' => 'integer',
        'reviews_count' => 'integer',
        'description' => 'string',
        'meta_title' => 'string',
        'meta_keywords' => 'string',
        'meta_description' => 'string',
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
        'category_id' => 0,
        'type' => null,
        'slug' => null,
        'name' => null,
        'adult_rate' => 0.00,
        'adult_price' => 0.00,
        'adult_fees' => 0.00,
        'child_rate' => 0.00,
        'child_price' => 0.00,
        'child_fees' => 0.00,
        'address' => null,
        'gmap' => null,
        'featured' => 0,
        'best_seller' => 0,
        'ratings' => 0,
        'reviews_count' => 0,
        'description' => null,
        'meta_title' => null,
        'meta_keywords' => null,
        'meta_description' => null,
        'status' => 'active',
        'created_at' => null,
        'updated_at' => null,
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function facilities()
    {
        return $this->hasMany('App\Models\Facility', 'table_id', 'id');
    }

    public function policies()
    {
        return $this->hasMany('App\Models\Policy', 'table_id', 'id');
    }

    public function faqs()
    {
        return $this->hasMany('App\Models\Faq', 'table_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'table_id', 'id');
    }

    public function hotelRoomTypes()
    {
        return $this->hasMany('App\Models\HotelRoomType', 'hotel_id', 'id');
    }

    public function tourPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'tour_photo');
    }

    public function hotelPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'hotel_photo');
    }

    public function activityPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'activity_photo');
    }

    public function cruisePhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'cruise_photo');
    }

    public function cabPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'cab_photo');
    }

    public function bikePhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'bike_photo');
    }

    public function addon()
    {
        return $this->belongsTo(Addon::class, 'addons', 'id');
    }
    public function addons()
    {
        return $this->belongsTo(Addon::class, 'addons', 'id');
    }
    public function pricing()
    {
        return $this->hasMany(Pricing::class, 'table_id', 'id');
    }

    public function Offers()
    {
        return $this->hasOne(Offers::class, 'table_id', 'id');
    }

    public function OfferPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id');
    }

    public function rentalBooking()
    {
        return $this->belongsTo(RentalBookings::class,'id','vehicle_id')->where('type','bike');
    }
}
