<?php

namespace App\Http\Controllers;

use App\Categorie;
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
        $this->middleware('auth')->except(['postCitiesSearch', 'postStoresSearch', 'postCategoriesSearch']);
    }

    public function postStoresSearch(Request $request) {

        $NE = explode('|', $request->input('NE'));
        $SW = explode('|', $request->input('SW'));
        $type = $request->input('type');
        $cat = $request->input('categorie');

        $query = Ville::join('magasins', 'magasins.codeINSEEVille','=','villes.codeINSEEVille')
            ->whereBetween('longMagasin', [$SW[1], $NE[1]])
            ->whereBetween('latMagasin', [$SW[0], $NE[0]]);

        if($type){
            $query->where('idType', $type);
        }
        if($cat){
            $query->where('idCategorie', $cat);
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

}
