<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public static $guard_name = 'web';

    protected $appends = ['fullname'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'profile',
        'google_id',
        'surname',
        'mobile',
        'mobile_verified_at',
        'email',
        'email_verified_at',
        'username',
        'password',
        'dob',
        'sex',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
        'surname' => 'string',
        'mobile' => 'string',
        'mobile_verified_at' => 'datetime:Y-m-d H:i:s',
        'email' => 'string',
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
        'username' => 'string',
        'dob' => 'date',
        'sex' => 'string',
        'status' => 'string',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'name' => null,
        'surname' => null,
        'mobile' => null,
        'mobile_verified_at' => null,
        'email' => null,
        'email_verified_at' => null,
        'username' => null,
        'dob' => null,
        'sex' => 'male',
        'status' => 'active',
        'created_at' => null,
        'updated_at' => null,
    ];

    /**
     * Set the user's name.
     *
     * @param  string $value
     * @return void
     */
    public function getFullnameAttribute()
    {
        return ucwords("{$this->name} {$this->surname}");
    }

    /**
     * Set the password.
     *
     * @param  string $value
     * @return void
     */
    // public function setPasswordAttribute()
    // {
    //     return $this->attributes['password'] = bcrypt($value);
    // }

    public function photo()
    {
        return $this->hasOne('App\Models\Drive', 'table_id', 'id')->where(['table_type' => 'user_photo']);
    }

    public function address()
    {
        return $this->hasOne('App\Models\Address', 'table_id', 'id')->where(['table_type' => 'user_address']);
    }
}
