<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'title',
        'category',
        'content',
        'slug',
        'status',
        'featured',
        'author',
        'meta_title',
        'publish_date',
        'meta_description',
        'meta_keywords',
        'meta_schema',
        'tags',
        'meta_script',
    ];

       public function photo()
    {
         return $this->hasOne('App\Models\Drive', 'table_id', 'id')->where(['table_type' => 'blog-posts']);
    }

}
