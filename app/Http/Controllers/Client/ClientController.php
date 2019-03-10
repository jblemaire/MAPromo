<?php

namespace App\Http\Controllers\Client;

use App\Adhesion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function __construct(){
        $this->middleware('client');
    }

    public function postAdhesion(Request $request){

        $adhesion = new Adhesion([
                'Promotion_idPromo' => $request->input('promo'),
                'Internaute_idInternaute' => $request->input('user')
            ]
        );
        
        $adhesion->save();

        return $adhesion;
    }
}
