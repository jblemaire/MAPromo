<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Adhesion extends Pivot
{
    protected $primaryKey = ['Promotion_idPromo','Internaute_idInternaute'];

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
