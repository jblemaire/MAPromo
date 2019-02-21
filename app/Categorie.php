<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function magasins(){
        return $this->hasMany(Magasin::class);
    }
}
