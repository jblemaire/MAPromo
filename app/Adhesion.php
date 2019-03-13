<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adhesion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Promotion_idPromo',
        'Internaute_idInternaute',
        'noteAdhesion',
        'commentaireAdhesion'
    ];
}
