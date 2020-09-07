<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];


    public function socialAccounts(){
        return $this->hasMany(SocialAccount::class);
    }
    public function address(){
        return $this->hasOne(Address::class);
    }
    public function saveaddress(){
        return $this->hasMany(SaveAddress::class);
    }
    public function fcm(){
        return $this->hasOne(fcmtoken::class);
    }
}
