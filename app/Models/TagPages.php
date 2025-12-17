<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagPages extends Model
{
    use HasFactory;

     protected $fillable = ['title', 'page_url'];

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'tag_page_tag', 'tag_page_id', 'tag_id');
    }
}
