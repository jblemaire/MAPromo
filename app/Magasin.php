<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{

    protected $primaryKey = 'idMagasin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomMagasin',
        'adresse1Magasin',
        'adresse2Magasin',
        'latMagasin',
        'longMagasin',
        'mailMagasin',
        'telMagasin',
        'siretMagasin',
        'codeINSEEVille',
        'idResponsable',
        'idType',
        'idCategorie'
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function promotions(){
        return $this->hasMany(Promotion::class);
    }
}
