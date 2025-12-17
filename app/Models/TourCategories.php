<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TourCategories extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'rating',
        'title',
        'description',
        'best_seller',
        'featured',
        'status',
    ];


    public function tourPackages()
    {
        return $this->hasMany(TourPackages::class,'category_id','id');
    }

    public function tourCategoryPhotos()
    {
        return $this->hasMany('App\Models\Drive', 'table_id', 'id')
            ->where('table_type', 'tour_category_photo');
    }
}
