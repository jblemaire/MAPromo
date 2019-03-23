
@extends('layouts.app')

@section('content')
    {{--$User--}}



            Bienvenue {{$User->prenomUser}}<br>


    <!-- Section des messages de succès ou d'erreur-->
    <!-- Vous pouvez modifier le css/html pour rendre ça plus joli, mais ne touchez pas aux classes alert-success et alert-danger,-->
    <!-- elles déterminent la couleur de fond du message -->
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



    <button><a href="{{route('editinfos')}}">Modifier mes informations</a></button><br>
            Votre courriel : {{$User->email}}<br>
            Votre nom : {{$User->nomUser}}<br>
            Votre prénom : {{$User->prenomUser}}<br>

    <button><a href="{{route('editpassword')}}">Modifier votre mot de passe</a></button>
    <button><a href="{{route('mes_promotions')}}">Promotions favorites</a></button>

@endsection