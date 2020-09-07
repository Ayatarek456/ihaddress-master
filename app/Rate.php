<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //

    protected $fillable = ['id', 'address_id', 'rate'];

    public function address(){
        return $this->belongsTo(Address::class);
    }
}
