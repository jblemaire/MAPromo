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

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function promotion(){
        return $this->hasMany('App\Promotion');
    }
}
