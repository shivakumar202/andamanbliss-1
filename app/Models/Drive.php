<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Drive extends Model
{
    use HasFactory;

    protected $appends = ['file'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'table_type',
        'table_id',
        'file_type',
        'file_name',
        'alt',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'table_type' => 'string',
        'table_id' => 'integer',
        'file_type' => 'string',
        'file_name' => 'string',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'table_type' => null,
        'table_id' => 0,
        'file_type' => null,
        'file_name' => null,
    ];

    /**
     * Set the file path.
     *
     * @param  string $value
     * @return void
     */
    public function getFileAttribute()
    {
        if (File::isFile('storage/' . $this->table_type . '/' . $this->file_name)) {
            return asset('storage/' . $this->table_type . '/' . $this->file_name . '?' . time());
        }
        return asset('images/default.jpg');
    }
}
