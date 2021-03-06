<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveAddress extends Model
{
    //
    protected $guarded=[''];
    public function address(){
        return $this->belongsTo(Address::class);
    }
}
