<?php

namespace App\Http\Controllers\Client;


use App\User;
use App\Adhesion;
use App\Magasin;
use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function myAccount(){

        $User = Auth::user();

        return view('client.compte',[
            'title'=>'Mon compte',
            'User'=>$User
        ]);
    }


    public function editpassword(){
        $status = "nope";

        return view('client.editpassword',[
           'title'=>"Modifier mon mot de passe",
            'status'=>$status
        ]);
    }

    public function updatepassword(Request $request){
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $newpasswordconfirm = $request->input('newpasswordconfirm');

        $user = Auth::user();

        if(Hash::check($oldpassword, $user->password)) {

            if ( $newpassword != '' && $newpasswordconfirm == $newpassword){
               $query=  DB::table('users')->where('idUser' , $user->idUser)
                    ->update([
                        'password' => bcrypt($newpassword),
                    ]);

                Session::flash('success','Le mot de passe a été modifié avec succès');
               // $status = "Le mot de passe a été modifié avec succés";
            }
            else{
                Session::flash('error','Les champs du nouveau mot de passe ne correspondent pas.');
            }
        }
        else{
           // $status = "le mot de passe inséré ne correspond pas à celui actuel.";
            Session::flash('error','Le mot de passe actuel ne correspond pas à celui de nos enregistrements ');
        }


        return view('client.editpassword',[
            'title'=>"Modifier mon mot de passe",

        ]);



    }


    public function editinfos(){
        $status = "hey";
        $user = Auth::user();

        return view('client.editinfos',[
            'title'=>"Modifier mes informations",
            'status'=>$status,
            'User'=>$user
        ]);
    }


    public function postReset(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|confirmed',
        ]);
        $credentials = $request->only(
            'email', 'password', '$newpasswordconfirm'
        );
        $user = Auth::user();
        $user->password = bcrypt($credentials['password']);
        $user->save();


        return redirect('client.compte',[
            'title'=>"Modifier mon mot de passe",

        ]);
    }


}


