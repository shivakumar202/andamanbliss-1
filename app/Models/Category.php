<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'slug',
        'name',
        'rating',
        'title',
        'description',
        'best_seller',
        'featured',
        'status',
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
        'slug' => 'string',
        'name' => 'string',
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
        'slug' => null,
        'name' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    public function tours()
    {
        return $this->hasMany('App\Models\Service', 'category_id', 'id')
            ->where('type', 'tour');
    }

     public function tourPackages()
    {
        return $this->hasMany('App\Models\TourPackages'::class,'category_id','id');
    }

    public function hotels()
    {
        return $this->hasMany('App\Models\Service', 'category_id', 'id')
            ->where('type', 'hotel');
    }


    public function activities()
    {
        return $this->hasMany(Activities::class, 'category_id', 'id')->where('status',1);
    }

    public function cruises()
    {
        return $this->hasMany('App\Models\Service', 'category_id', 'id')
            ->where('type', 'cruise');
    }

    public function cabs()
    {
        return $this->hasMany('App\Models\Service', 'category_id', 'id')
            ->where('type', 'cab');
    }

    public function bikes()
    {
        return $this->hasMany('App\Models\Service', 'category_id', 'id')
            ->where('type', 'bike');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }

    public function tourCategoryPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'category_photo');
    }

    public function activity()
    {
        return $this->hasMany(Activities::class, 'category_id', 'id');
    }

    public function categorySection()
    {
        return $this->hasMany(CategorySections::class, 'category_id', 'id');
    }

    public function metaHeadings()
    {
        return $this->hasMany(MetaHeadings::class,'table_id', 'id')->where('table_type','category-table');
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class,'table_id','id')->where('table_type','category');
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class,'table_id','id')->where('table_type','category');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'table_id','id')->where('table_type','category');
    }
}
