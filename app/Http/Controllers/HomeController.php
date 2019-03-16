<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Magasin;
use App\Promotion;
use App\Ville;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['postCitiesSearch', 'postStoresSearch', 'postCategoriesSearch', 'postPromosSearch']);
    }

    public function postStoresSearch(Request $request) {

        $NE = explode('|', $request->input('NE'));
        $SW = explode('|', $request->input('SW'));
        $type = $request->input('type');
        $cat = $request->input('categorie');

        $query = Magasin::join('villes', 'magasins.codeINSEEVille', '=', 'villes.codeINSEEVille')
            ->join('users', 'magasins.idResponsable', '=', 'users.idUser')
            ->join('types', 'magasins.idType', '=', 'types.idType')
            ->leftjoin('categories', 'magasins.idCategorie', '=', 'categories.idCategorie')
            ->whereBetween('longMagasin', [$SW[1], $NE[1]])
            ->whereBetween('latMagasin', [$SW[0], $NE[0]]);

        if($type){
            $query->where('magasins.idType', $type);
        }
        if($cat){
            $query->where('magasins.idCategorie', $cat);
        }

        $magasins = $query->get();



        return $magasins;

    }

    public function postCitiesSearch(Request $request) {
        $ville = $request->input('ville');

        $cities = Ville::where('nomVille', 'like', '%'.$ville.'%')
            ->orderBy('popVille', 'desc')
            ->limit(10)
            ->get();

        return $cities;
    }

    public function postCategoriesSearch(Request $request) {
        $type = $request->input('idType');

        $categories = Categorie::where('idType', '=', $type)
            ->get();

        return $categories;
    }

    public function postPromosSearch(Request $request){
        $promos = Promotion::where('idMagasin', $request->input('magasin'))
            ->where('etatPromo', 1)
            ->get();

        return $promos;
    }

}
