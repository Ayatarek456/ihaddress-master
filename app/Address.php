<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $guarded=[''];

    protected $appends = [
        'full_address'
        ,'image1_path'
        ,'image2_path'
        ,'image3_path'
        ,'image4_path'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function rate(){
        return $this->hasMany(Rate::class, 'address_id', 'id');
    }
    public function saveaddress(){
        return $this->hasMany(SaveAddress::class, 'address_id', 'id');
    }

    public function getFullAddressAttribute()
    {
        return "". $this->number ." ". $this->landmark ." building، ". $this->streetname1 . "، ". $this->streetname2 . "، "  . $this->state ."<br> ". $this->country->country_name ."";
    }

    public function getImage1PathAttribute()
    {
        return asset($this->image1);
    }

    public function getImage2PathAttribute()
    {
        return asset($this->image2);
    }

    public function getImage3PathAttribute()
    {
        return asset($this->image3);
    }

    public function getImage4PathAttribute()
    {
        return asset($this->image4);
    }
}
