<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class subCategories extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'status',
    ];


    public function tourPackages()
    {
        return $this->belongsToMany(
            TourPackages::class,
            'tour_subcategory',     // same pivot table
            'subcategory_id',       // foreign key for this model
            'tour_id'       // foreign key for related model
        )->withPivot('markup', 'discount', 'discount_above', 'starts_from')->withTimestamps();
    }

}
