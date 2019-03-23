<?php

namespace App\Http\Controllers\Client;

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
        $this->middleware('client')->except(['getPromo', 'getListPromo']);
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

    public function myAccount(){
        $User = Auth::user();
        return view('client.compte',[
            'title'=>'Mon Compte',
            'User'=>$User
        ]);
    }
    public function editpassword(){
        $status = "nope";
        return view('client.editpassword',[
            'title'=>"Mon Mot de Passe",
            'status'=>$status
        ]);
    }
    public function updatepassword(Request $request)
    {
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $newpasswordconfirm = $request->input('newpasswordconfirm');
        $user = Auth::user();
        if (Hash::check($oldpassword, $user->password)) {
            if ($newpassword != '' && $newpasswordconfirm == $newpassword && strlen($newpassword) >= 8) {
                $query = DB::table('users')->where('idUser', $user->idUser)
                    ->update([
                        'password' => bcrypt($newpassword),
                    ]);
                Session::flash('success', 'Le mot de passe a été modifié avec succès');
                // $status = "Le mot de passe a été modifié avec succés";
                return redirect()->route('compte', [
                    'title' => "Mon Compte",
                    'User' => $user,
                ]);
            } else {
                if (strlen($newpassword) < 8) {
                    Session::flash('error', 'Le nouveau mot de passe doit faire au minimum 8 caractères.');
                } elseif ($newpasswordconfirm == $newpassword) {
                    Session::flash('error', 'Les champs du nouveau mot de passe ne correspondent pas.');
                }
                return redirect()->route('editpassword', [
                    'title' => "Mon Mot de Passe",
                    'User' => $user,
                ]);
            }
        } else {
            // $status = "le mot de passe inséré ne correspond pas à celui actuel.";
            Session::flash('error', 'Le mot de passe actuel ne correspond pas à celui de nos enregistrements.');
            return redirect()->route('editpassword', [
                'title' => "Mon Mot de Passe",
                'User' => $user,
            ]);
        }
    }
    public function editinfos(){
        $status = "hey";
        $user = Auth::user();
        return view('client.editinfos',[
            'title'=>"Mes Informations",
            'status'=>$status,
            'User'=>$user
        ]);
    }

    public function updateinfos(Request $request){
        $name = $request->input('nomUser');
        $prenom = $request->input('prenomUser');
        $tel = $request->input('telUser');
        $user = Auth::user();
        $query=  DB::table('users')->where('idUser' , $user->idUser)
            ->update([
                'nomUser' => $name,
                'prenomUser' => $prenom,
                'telUser' => $tel,
            ]);
        if($query){
            Session::flash('success','Les informations ont été enregistrés avec succès.');
            return redirect()->route('compte', [
                'title'=>"Mon Compte",
                'User'=>$user,
            ]);
        }
        else{
            Session::flash('error',"vous n'avez pas apporté de modifications.");
            return redirect()->route('editinfos', [
                'title'=>"Mes Informations",
                'User'=>$user,
            ]);
        }
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
            'title'=>"Mon Compte",
        ]);
    }
}


