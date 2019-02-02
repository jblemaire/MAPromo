<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function magasin(){
        return $this->hasMany('App\Magasin');
    }

    public function categorie(){
        return $this->hasMany('App\Categorie');
    }

}
