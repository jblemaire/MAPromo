<?php

namespace App\Http\Controllers\Responsable;

use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Magasin;
use DateTime;


class PromotionController extends Controller
{
    public function __construct(){
        $this->middleware('responsable');
    }

    public function returnView($idMagasin = null){

        $magasins = Magasin::where('idResponsable', Auth::user()->idUser)->get();

        $promotions = null;

        if($idMagasin){
            $promotions = Promotion::where('idMagasin', $idMagasin)->get();
        }

        return view ('responsable.promotions',[
            'title' => 'Mes Promotions',
            'magasins' => $magasins,
            'idMagasin' => $idMagasin,
            'promotions' => $promotions
        ]);
    }

    public function getPromosFromStore(Request $request){

        $idMagasin = $request->get('selectMagasin');

        return redirect()->route('promotions', ['idMagasin' => $idMagasin]);

    }

    public function postPromo(Request $request) {

        $dateDebut = new DateTime($request->input('dateDebutPromo'));
        $dateDebut = $dateDebut->format('Y-m-d');
        $dateFin = new DateTime($request->input('dateFinPromo'));
        $dateFin = $dateFin->format('Y-m-d');

        $promotion = new Promotion([
                'libPromo' => $request->input('nomPromo'),
                'dateDebutPromo' => $dateDebut,
                'dateFinPromo' => $dateFin,
                'descPromo' => $request->input('descPromo'),
                'etatPromo' => 0,
                'codePromo' => $request->input('codePromo'),
                'codeAvisPromo' => $request->input('codeAvis'),
                'idMagasin' => $request->input('idMag'),
            ]
        );


        $file1_name = null;
        $file2_name = null;
        $file3_name = null;
        $directory_path = public_path().'\img\\'.Auth::user()->idUser . '_' . Auth::user()->nomUser.'\promotion';

        if(!file_exists($directory_path))
            File::makeDirectory($directory_path, $mode = 0777, true, true);

        if( $request->file('photo1Promo')){
            $file1 = $request->file('photo1Promo');
            $file1_name = str_replace(' ','',$request->input('codePromo')).'_1_'.rand(1, 10000).'.'.$file1->getClientOriginalExtension();
            $file1->move($directory_path, $file1_name);
            $promotion->photo1Promo = Auth::user()->idUser . '_' . Auth::user()->nomUser . '\promotion\\' . $file1_name;

        }
        if( $request->file('photo2Promo')){
            $file2 = $request->file('photo2Promo');
            $file2_name = str_replace(' ','',$request->input('codePromo')).'_2_'.rand(1, 10000).'.'.$file2->getClientOriginalExtension();
            $file2->move($directory_path, $file2_name);
            $promotion->photo2Promo = Auth::user()->idUser . '_' . Auth::user()->nomUser . '\promotion\\' . $file2_name;

        }
        if( $request->file('photo3Promo')){
            $file3 = $request->file('photo3Promo');
            $file3_name = str_replace(' ','',$request->input('codePromo')).'_3_'.rand(1, 10000).'.'.$file3->getClientOriginalExtension();
            $file3->move($directory_path, $file3_name);
            $promotion->photo3Promo = Auth::user()->idUser . '_' . Auth::user()->nomUser . '\promotion\\' . $file3_name;

        }

        $promotion->save();

        return redirect()->route('promotions', ['idMagasin' => $request->input('idMag')]);
    }

    public function updateEtat(Request $request) {

        $promotion = Promotion::findOrFail($request->input('promo'));

        $promotion->etatPromo = $request->input('etat');

        $promotion->save();

        return redirect()->route('promotions', ['idMagasin' => $promotion->idMagasin]);
    }

}
