<?php

namespace App\Http\Controllers\Client;

use App\Adhesion;
use App\Magasin;
use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function __construct(){
        $this->middleware('client');
    }

    public function returnView(){

        $adhesions = Promotion::join('magasins', 'promotions.idMagasin', '=', 'magasins.idMagasin')
            ->join('villes', 'magasins.codeINSEEVille', '=', 'villes.codeINSEEVille')
            ->join('adhesions', 'adhesions.Promotion_idPromo', '=', 'promotions.idPromo')
            ->where('adhesions.Internaute_idInternaute', Auth::user()->idUser)
            ->orderBy('magasins.idMagasin')
            ->get();

        return view ('client.promotion',[
            'title' => 'Mes Promotions',
            'adhesions' => $adhesions
        ]);
    }

    public function postAdhesion(Request $request){
        $adhesion = DB::table('adhesions')->where('Promotion_idPromo', $request->input('promo'))
            ->where('Internaute_idInternaute', Auth::user()->idUser)
            ->get();
        
        if(count($adhesion) === 0){

            DB::table('adhesions')->insert([
                'Promotion_idPromo' => $request->input('promo'),
                'Internaute_idInternaute' => Auth::user()->idUser
            ]);

            return redirect()->route('mes_promotions');
        }

        return redirect()->route('home');
    }
}
