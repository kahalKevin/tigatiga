<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'fe_tm_user';
    protected $appends = ['full_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_first_name', 
        '_last_name', 
        '_email', 
        '_password', 
        '_phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '_password', '_remember_token',
    ];

    public function getFullNameAttribute()
    {
        return $this->attributes['_first_name'] . ' ' . $this->attributes['_last_name'];
    }

    public function gender()
    {
        return $this->hasOne('App\Model\Type', 'id', 'gender_id');
    }

    public function addresses()
    {
        return $this->hasMany('App\Model\UserAddress', 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany('App\Model\Order', 'user_id', 'id');
    }
    public function getAuthPassword()
    {
        return $this->_password;
    }

    public function getRememberTokenName()
    {
        return "_remember_token";
    }   
}
