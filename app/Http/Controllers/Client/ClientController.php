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
        $etat = 'exist';
        
        if(count($adhesion) === 0){

            DB::table('adhesions')->insert([
                'Promotion_idPromo' => $request->input('promo'),
                'Internaute_idInternaute' => Auth::user()->idUser,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            $etat = 'done';
        }

        return $etat;
    }

    public function getPromo($idPromo){
        $magasin = Promotion::join('magasins', 'promotions.idMagasin', '=', 'magasins.idMagasin')
            ->join('villes', 'magasins.codeINSEEVille', '=', 'villes.codeINSEEVille')
            ->join('types', 'magasins.idType', '=', 'types.idType')
            ->leftjoin('categories', 'magasins.idCategorie', '=', 'categories.idCategorie')
            ->where('promotions.idPromo', $idPromo)
            ->get();

        $adhesions = DB::table('adhesions')->select('adhesions.*', 'users.nomUser', 'users.prenomUser')
            ->join('users', 'adhesions.Internaute_idInternaute', '=', 'users.idUser')
            ->where('Promotion_idPromo', $idPromo)
            ->whereNotNull('commentaireAdhesion')
            ->get();

        return view ('client.detailPromotion',[
            'title' => 'Détails Promotions',
            'magasins' => $magasin,
            'adhesions' => $adhesions
        ]);
    }

    public function postComment(Request $request, $idPromo){
        DB::table('adhesions')->where('Promotion_IdPromo' , $idPromo)
            ->where('Internaute_IdInternaute', Auth::user()->idUser)
            ->update([
                'noteAdhesion' => $request->input('note'),
                'commentaireAdhesion' => $request->input('comment'),
                'updated_at' => date("Y-m-d H:i:s")
                ]);

        return redirect()->route('details_promo', ['idPromo'=>$idPromo]);
    }

    public function getListPromo(){
        $promotions = Promotion::orderBy('created_at', 'DESC)')
            ->paginate(10);

        return view ('client.listePromo',[
            'title' => 'Liste des Promotions',
            'promotions' => $promotions
        ]);
    }
}


