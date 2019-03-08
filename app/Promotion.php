<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{

    protected $primaryKey = 'idPromo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dateDebutPromo',
        'dateFinPromo',
        'libPromo',
        'etatPromo',
        'codePromo',
        'codeAvisPromo',
        'photo1Promo',
        'photo2Promo',
        'photo3Promo',
        'idMagasin',
    ];

    public function magasin(){
        return $this->belongsTo(Magasin::class);
    }

    public function internautes(){
        return $this->belongstoMany(User::class)->using(Adhesion::class);
    }

}
