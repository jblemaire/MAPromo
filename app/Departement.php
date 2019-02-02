<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    public function ville(){
        return $this->hasMany('App\Ville');
    }
}
