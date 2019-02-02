<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function magasin(){
        return $this->hasMany('App\Magasin');
    }
}
