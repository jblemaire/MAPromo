<?php

namespace App\Http\Controllers\Responsable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ville;
use App\Magasin;
use App\Type;
use App\Categorie;
use Illuminate\Support\Facades\File;

class MagasinController extends Controller
{
    public function __construct(){
        $this->middleware('responsable');
    }

    public function returnView(){
        $types = Type::get();
        $magasins = Magasin::join('villes', 'magasins.codeINSEEVille', '=', 'villes.codeINSEEVille')
            ->join('users', 'magasins.idResponsable', '=', 'users.idUser')
            ->join('types', 'magasins.idType', '=', 'types.idType')
            ->leftjoin('categories', 'magasins.idCategorie', '=', 'categories.idCategorie')
            ->where('idResponsable', Auth::user()->idUser)
            ->get();

        return view ('responsable.magasins',[
            'title' => 'Mes Magasins',
            'types' => $types,
            'magasins' => $magasins
        ]);
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
            'adresse1Magasin' => $request->input('adresse1Mag') ? $request->input('adresse1Mag') : '',
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

        $file1_name = null;
        $file2_name = null;
        $directory_path = public_path().'\img\\'.Auth::user()->idUser . '_' . Auth::user()->nomUser.'\stores';

        if(!file_exists($directory_path))
            File::makeDirectory($directory_path, $mode = 0777, true, true);

        if( $request->file('photo1Mag')){
            $file1 = $request->file('photo1Mag');
            $file1_name = str_replace(' ','',$request->input('nomMag')).'_1_'.rand(1, 10000).'.'.$file1->getClientOriginalExtension();
            $file1->move($directory_path, $file1_name);
            $magasin->photo1Magasin = Auth::user()->idUser . '_' . Auth::user()->nomUser . '\stores\\' . $file1_name;
        }
        if( $request->file('photo2Mag')){
            $file2 = $request->file('photo2Mag');
            $file2_name = str_replace(' ','',$request->input('nomMag')).'_2_'.rand(1, 10000).'.'.$file2->getClientOriginalExtension();
            $file2->move($directory_path, $file2_name);
            $magasin->photo2Magasin = Auth::user()->idUser . '_' . Auth::user()->nomUser . '\stores\\' . $file2_name;

        }

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

   public function getUpdateStores($idMagasin){
       $magasin = Magasin::leftjoin('categories', 'magasins.idCategorie', '=', 'categories.idCategorie')
           ->join('villes', 'magasins.codeINSEEVille', '=', 'villes.codeINSEEVille')
           ->join('types', 'magasins.idType', '=', 'types.idType')
           ->findOrFail($idMagasin);

       $types = Type::get();
       $categories = Categorie::where('idType', $magasin->idType)->get();
       $ville = Ville::where('cpVille', $magasin->cpVille)->get();

       return view('responsable.updateStore', [
           'title' => 'Mes Magasins',
           'magasin' => $magasin,
           'types' => $types,
           'categories' => $categories,
           'villes' => $ville
       ]);
   }

   public function postUpdateStores(Request $request){

       $this->validate($request, [
           'nomMag' => 'required',
           'siretMag' => 'required',
           'adresse2Mag'=> 'required',
           'cpMag' => 'required',
           'villeMag' => 'required',
           'latMag' => 'required',
           'longMag' => 'required',
           'mailMagasin'=> 'required|string|email|max:255'
       ]);

       $magasin = Magasin::findOrFail( $request->input('idMag'));

       $magasin->nomMagasin = $request->input('nomMag');
       $magasin->adresse1Magasin = $request->input('adresse1Mag') ? $request->input('adresse1Mag') : '';
       $magasin->adresse2Magasin = $request->input('adresse2Mag');
       $magasin->latMagasin = $request->input('latMag');
       $magasin->longMagasin = $request->input('longMag');
       $magasin->mailMagasin = $request->input('mailMagasin');
       $magasin->telMagasin = $request->input('telMag');
       $magasin->siretMagasin = $request->input('siretMag');
       $magasin->codeINSEEVille = $request->get('villeMag');
       $magasin->idType = $request->get('selectType');
       $magasin->idCategorie = $request->get('selectCategorie');

       $file1_name = null;
       $file2_name = null;
       $directory_path = public_path().'\img\\'.Auth::user()->idUser . '_' . Auth::user()->nomUser .'\stores';

       if(!file_exists($directory_path))
           File::makeDirectory($directory_path, $mode = 0777, true, true);

       if($request->file('photo1Mag')){
           File::delete($directory_path.'\\'.$magasin->photo1Magasin);
           $file1 = $request->file('photo1Mag');
           $file1_name = str_replace(' ','',$request->input('nomMag')).'_1_'.rand(1, 10000).'.'.$file1->getClientOriginalExtension();
           $file1->move($directory_path, $file1_name);
           $magasin->photo1Magasin = Auth::user()->idUser . '_' . Auth::user()->nomUser . '\stores\\' . $file1_name;
       }
       if($request->file('photo2Mag')){
           File::delete($directory_path.'\\'.$magasin->photo2Magasin);
           $file2 = $request->file('photo2Mag');
           $file2_name = str_replace(' ','',$request->input('nomMag')).'_2_'.rand(1, 10000).'.'.$file2->getClientOriginalExtension();
           $file2->move($directory_path, $file2_name);
           $magasin->photo2Magasin = Auth::user()->idUser . '_' . Auth::user()->nomUser . '\stores\\' . $file2_name;
       }

       $magasin->save();

       return redirect()->route('magasins');
   }

    public function getDeleteStores($idMagasin){
        Magasin::findOrFail( $idMagasin)->delete();
        return redirect()->route('magasins');
    }

}
