<?php

namespace App\Http\Controllers;

use App\Magasin;
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
        $this->middleware('auth')->except(['postCitiesSearch', 'postStoresSearch']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function postStoresSearch(Request $request) {

        $NE = explode('|', $request->input('NE'));
        $SW = explode('|', $request->input('SW'));

        $magasins = Ville::join('magasins', 'magasins.codeINSEEVille','=','villes.codeINSEEVille')
            ->whereBetween('longMagasin', [$SW[1], $NE[1]])
            ->whereBetween('latMagasin', [$SW[0], $NE[0]])
            ->get();

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
}
