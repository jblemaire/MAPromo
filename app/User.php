<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'idUser';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomUser', 'prenomUser', 'email', 'password', 'telUser', 'idRole', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function promotions(){
        return $this->belongstoMany(Promotion::class)->using(Adhesion::class);
    }

    public function magasins(){
        return $this->hasMany(Magasin::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
