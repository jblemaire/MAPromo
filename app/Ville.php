<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    public function magasins(){
        return $this->hasMany(Magasin::class);
    }

    public function departement(){
        return $this->hasOne(Departement::class);
    }
}
