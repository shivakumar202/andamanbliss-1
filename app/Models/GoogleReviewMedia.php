<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoogleReviewMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'google_review_id',
        'google_url',
        'media_format',
        'create_time',
    ];

    protected $dates = ['create_time'];

    public function review(): BelongsTo
    {
        return $this->belongsTo(GoogleReview::class, 'google_review_id');
    }
}
