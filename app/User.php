<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function promotion(){
        return $this->belongstoMany('App\Promotion')->using('App\Adhesion');
    }

    public function magasin(){
        return $this->hasMany('App\Magasin');
    }
}
