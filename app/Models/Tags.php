<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'link',
        'status',
    ];

    public function pages()
    {
        return $this->belongsToMany(TagPages::class, 'tag_page_tag', 'tag_id', 'tag_page_id');
    }
}
