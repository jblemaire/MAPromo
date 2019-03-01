<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'idUser';

    public function getAuthPassword()
    {
        return $this->mdpUser;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomUser', 'prenomUser', 'mailUser', 'mdpUser', 'telUser', 'idRole', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'mdpUser', 'remember_token',
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
