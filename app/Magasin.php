<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function categorie(){
        return $this->belongsTo('App\Categorie');
    }

    public function ville(){
        return $this->belongsTo('App\Ville');
    }

    public function responsable(){
        return $this->belongsTo('App\Responsable');
    }

    public function promotion(){
        return $this->hasMany('App\Promotion');
    }
}
