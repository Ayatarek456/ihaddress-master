<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';
    protected $fillable = ['country_code'];

    public function address(){
        return $this->belongsTo(Address::class);
    }
}
