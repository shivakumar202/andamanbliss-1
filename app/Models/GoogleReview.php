<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GoogleReview extends Model
{
    use HasFactory;

     protected $fillable = [
        'review_id',
        'reviewer_name',
        'reviewer_profile_photo_url',
        'rating',
        'comment',
        'media',
        'review_date',
        'reply',
        'account_id',
        'location_id',
    ];

    protected $casts = [
        'media' => 'array',
        'review_date' => 'datetime',
    ];
}
