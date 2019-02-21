<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Magasin;
use App\Type;
use App\Categorie;
use App\Promotion;
use App\Adhesion;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('getUsersList');
    }

    public function getUsersList(){

        $users = User::join('roles', 'users.idRole', '=', 'roles.idRole')
                ->orderBy('idUser')
                ->paginate(20);

        return view('admin.users', [
            'title'=> 'Espace Admin',
            'users' => $users
        ]);
    }

    public function getMagasinsList(){
        $magasins = Magasin::join('villes', 'magasins.codeINSEEVille', '=', 'villes.codeINSEEVille')
            ->join('users', 'magasins.idResponsable', '=', 'users.idUser')
            ->join('types', 'magasins.idType', '=', 'types.idType')
            ->leftjoin('categories', 'magasins.idCategorie', '=', 'categories.idCategorie')
            ->orderBy('idMagasin')
            ->paginate(20);

        return view('admin.magasins', [
            'title'=> 'Espace Admin',
            'magasins' => $magasins
        ]);
    }

    public function getTypesList (){
        $types = Type::paginate(20);

        return view('admin.types', [
            'title'=> 'Espace Admin',
            'types' => $types
        ]);
    }

    public function getCategoriesList(){
        $categories = Categorie::join('types', 'categories.idType', '=', 'types.idType')
            ->paginate(20);

        return view('admin.categories', [
            'title'=> 'Espace Admin',
            'categories' => $categories
        ]);
    }

    public function getPromotionsList(){
        $promotions = Promotion::join('magasins', 'promotions.idMagasin', '=', 'magasins.idMagasin')
            ->paginate(20);

        return view('admin.promotions', [
            'title'=> 'Espace Admin',
            'promotions' => $promotions
        ]);
    }

    public function getAdhesionsList(){
        $adhesions = Adhesion::join('promotions', 'adhesions.Promotion_idPromo', '=', 'promotions.idPromo')
            ->join('users', 'adhesions.Internaute_idInternaute' , '=', 'users.idUser')
            ->paginate(20);

        return view('admin.adhesions', [
            'title'=> 'Espace Admin',
            'adhesions' => $adhesions
        ]);
    }
}
