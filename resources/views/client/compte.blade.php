@extends('layouts.app')

@section('content')
    <div class="main-content" style="justify-content: center">
        <div class="card-promotion card">
            <div class="card-header">
                <h3>Bienvenue {{$User->prenomUser}}</h3>
            </div>
            <div class="card-body">
                <div class="row no-gutters">
                    <div id="cardBody">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="flash-message">
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="flash-message">
                                    <div class="alert alert-danger">
                                        {{Session::get('error')}}
                                    </div>
                                </div>
                            @endif
                            <h5 class="card-subtitle mb-2">Votre courriel : {{$User->email}}</h5>
                            <h5 class="card-subtitle mb-2">Votre nom : {{$User->nomUser}}</h5>
                            <h5 class="card-subtitle mb-2">Votre prénom : {{$User->prenomUser}}</h5>
                            <div class="groupButtonMagasins" style="display: flex; justify-content: space-around">
                                <a href="{{route('editinfos')}}"><button>Modifier mes informations</button></a>
                                <a href="{{route('editpassword')}}"><button>Modifier votre mot de passe</button></a>
                                <a href="{{route('mes_promotions')}}"><button>Promotions favorites</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection