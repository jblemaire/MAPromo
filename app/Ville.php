<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    public function magasin(){
        return $this->hasMany('App\Magasin');
    }
}
