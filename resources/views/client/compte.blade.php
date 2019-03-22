
@extends('layouts.app')

@section('content')
    {{--$User--}}



            Bienvenue {{$User->prenomUser}}<br>

            Votre courriel : {{$User->email}}<br>


    <button><a href="{{route('editpassword')}}">Modifier votre mot de passe</a></button>
    <button><a>Promotions favorites</a></button>
@endsection