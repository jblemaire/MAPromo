<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ville;
use App\Magasin;

class ResponsableController extends Controller
{
    public function __construct(){
        $this->middleware('responsable');
    }

    public function postStores(Request $request) {

        $this->validate($request, [
            'nomMag' => 'required',
            'siretMag' => 'required',
            'adresse2Mag'=> 'required',
            'cpMag' => 'required',
            'villeMag' => 'required',
            'latMag' => 'required',
            'longMag' => 'required',
            'mailMagasin'=> 'required|string|email|max:255|unique:magasins'
        ]);

        $magasin = new Magasin([
            'nomMagasin' => $request->input('nomMag'),
            'adresse1Magasin' => $request->input('adresse1Mag'),
            'adresse2Magasin' => $request->input('adresse2Mag'),
            'latMagasin' => $request->input('latMag'),
            'longMagasin' => $request->input('longMag'),
            'mailMagasin' => $request->input('mailMagasin'),
            'telMagasin' => $request->input('telMag'),
            'siretMagasin' => $request->input('siretMag'),
            'codeINSEEVille' => $request->get('villeMag'),
            'idResponsable' => Auth::user()->idUser,
            'idType' => $request->get('selectType'),
            'idCategorie' => $request->get('selectCategorie'),
            ]
        );

        $magasin->save();

        return redirect()->route('magasins');
    }

   public function postCitiesSearchByCP(Request $request){
       $cpVille = $request->input('cpVille');

       $villes = Ville::select('codeINSEEVille', 'nomVille')
           ->where('cpVille', 'like', '%'.$cpVille.'%')
           ->get();

       return $villes;
   }

}
