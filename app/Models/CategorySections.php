<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategorySections extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'category_id',
        'title',
        'type',
        'display_block',
        'modal_title',
        'modal_content',
        'blocks_section',
        'cta_title',
        'cta_desc',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
