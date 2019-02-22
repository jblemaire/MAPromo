<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $fillable = [
        'libType'
    ];

    public $timestamps = false;

    public function magasins(){
        return $this->hasMany(Magasin::class);
    }

    public function categories(){
        return $this->hasMany(Categorie::class);
    }

}
