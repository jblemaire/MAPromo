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
        $this->middleware('admin');
    }

    public function getUsersList($idUser = null){
        $query = User::join('roles', 'users.idRole', '=', 'roles.idRole');

        if($idUser){
            $query->where('idUser', $idUser);
        }
        $query->orderBy('idUser');

        $users = $query->paginate(20);

        return view('admin.users', [
            'title'=> 'Espace Admin',
            'users' => $users
        ]);
    }

    public function getMagasinsList($idMagasin = null){
        $query = Magasin::join('villes', 'magasins.codeINSEEVille', '=', 'villes.codeINSEEVille')
            ->join('users', 'magasins.idResponsable', '=', 'users.idUser')
            ->join('types', 'magasins.idType', '=', 'types.idType')
            ->leftjoin('categories', 'magasins.idCategorie', '=', 'categories.idCategorie');

        if($idMagasin){
            $query->where('idMagasin', $idMagasin);
        }

        $query->orderBy('idMagasin');
        $magasins = $query->paginate(20);

        return view('admin.magasins', [
            'title'=> 'Espace Admin',
            'magasins' => $magasins
        ]);
    }

    public function getMagasinsListByUser($idUser = null){
        $query = Magasin::join('villes', 'magasins.codeINSEEVille', '=', 'villes.codeINSEEVille')
            ->join('users', 'magasins.idResponsable', '=', 'users.idUser')
            ->join('types', 'magasins.idType', '=', 'types.idType')
            ->leftjoin('categories', 'magasins.idCategorie', '=', 'categories.idCategorie');

        if($idUser){
            $query->where('idResponsable', $idUser);
        }

        $query->orderBy('idMagasin');
        $magasins = $query->paginate(20);

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

    public function getCategoriesList($idType = null){
        $query = Categorie::join('types', 'categories.idType', '=', 'types.idType');

        if($idType){
            $query->where('categories.idType', $idType);
        }

        $categories = $query->paginate(20);

        return view('admin.categories', [
            'title'=> 'Espace Admin',
            'categories' => $categories,
            'types' => Type::get(),
            'idType' => $idType
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

    public function getPromotionsListByMagasin($idMagasin = null){
        $query = Promotion::join('magasins', 'promotions.idMagasin', '=', 'magasins.idMagasin');

        if($idMagasin){
            $query->where('promotions.idMagasin', $idMagasin);
        }

        $promotions = $query->paginate(20);

        return view('admin.promotions', [
            'title'=> 'Espace Admin',
            'promotions' => $promotions
        ]);
    }

    public function getAdhesionsListByPromo($idPromo = null){
        $query = Adhesion::join('promotions', 'adhesions.Promotion_idPromo', '=', 'promotions.idPromo')
            ->join('users', 'adhesions.Internaute_idInternaute' , '=', 'users.idUser');

        if($idPromo){
            $query->where('Promotion_idPromo', $idPromo);
        }

        $adhesions = $query->paginate(20);

        return view('admin.adhesions', [
            'title'=> 'Espace Admin',
            'adhesions' => $adhesions
        ]);
    }

    public function getAdhesionsListByUser($idUser = null){
        $query = Adhesion::join('promotions', 'adhesions.Promotion_idPromo', '=', 'promotions.idPromo')
            ->join('users', 'adhesions.Internaute_idInternaute' , '=', 'users.idUser');

        if($idUser){
            $query->where('Internaute_idInternaute', $idUser);
        }

        $adhesions = $query->paginate(20);

        return view('admin.adhesions', [
            'title'=> 'Espace Admin',
            'adhesions' => $adhesions
        ]);
    }

    public function postTypes(Request $request){
        $this->validate($request, [
            'libType' => 'required'
        ]);

        $type = new Type(['libType' => $request->input('libType')]);

        $type->save();

        return redirect()->route('types_list');
    }

    public function postCategories(Request $request){
        $this->validate($request, [
            'libCategorie' => 'required',
        ]);

        $categorie = new Categorie([
            'libCategorie' => $request->input('libCategorie'),
            'idType' => $request->get('selectType')
            ]);

        $categorie->save();

        return redirect()->route('categories_list');
    }

    public function postDeleteCom(Request $request){
        Adhesion::where('Promotion_idPromo' , '=', $request->input('idPromo'))
            ->where('Internaute_idInternaute', '=', $request->input('idUser'))
            ->update(['commentaireAdhesion' => 'Votre commentaire a été supprimé par l\'administrateur du site']);

        return redirect()->route('adhesions_list_user');
    }

}
