<?php

namespace App\Models;

use App\Models\Backend\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'utype',
        'district',
        'city',
        'address'
    ];
    public function roles(){
        return $this->belongsToMany(Role::class,'user_role');
    }
    public function product(){
        return $this->hasOne('App\Models\Backend\Product');
    }

    public function file(){
        return $this->hasOne('App\Models\Backend\File');
    }

    public function order(){
        return $this->hasOne('App\Models\Frontend\Order');
    }

    public function orderdetails(){
        return $this->hasOne('App\Models\Frontend\OrderDetails');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
