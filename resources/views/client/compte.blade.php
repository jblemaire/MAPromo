
@extends('layouts.app')

@section('content')
    {{--$User--}}



            Bienvenue {{$User->prenomUser}}<br>

    <button><a href="{{route('editinfos')}}">Modifier mes informations</a></button><br>
            Votre courriel : {{$User->email}}<br>
            Votre nom : {{$User->nomUser}}<br>
            Votre prénom : {{$User->prenomUser}}<br>

    <button><a href="{{route('editpassword')}}">Modifier votre mot de passe</a></button>
    <button><a>Promotions favorites</a></button>

@endsection