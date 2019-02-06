<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public function magasin(){
        return $this->belongsTo('App\Magasin');
    }

    public function internaute(){
        return $this->belongstoMany('App\User')->using('App\Adhesion');
    }
}
