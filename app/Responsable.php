<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    public function magasin(){
        return $this->hasMany('App\Magasin');
    }
}
