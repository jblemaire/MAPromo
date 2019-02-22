<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public function magasin(){
        return $this->belongsTo(Magasin::class);
    }

    public function internautes(){
        return $this->belongstoMany(User::class)->using(Adhesion::class);
    }

}
