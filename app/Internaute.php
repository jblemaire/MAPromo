<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internaute extends Model
{
    public function promotion(){
        return $this->belongstoMany('App\Promotion')->using('App\Adhesion');
    }
}
