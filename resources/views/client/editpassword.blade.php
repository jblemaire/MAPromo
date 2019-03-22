
@extends('layouts.app')

@section('content')

    {{$status}}
    {{--$User--}}
    <form method="POST" action="{{route('updatepassword')}}">
        {{ csrf_field() }}
    Ancien mot de passe
    <input name='oldpassword' type="password"><br>
    Nouveau mot de passe
    <input name='newpassword' type="password"><br>
    Confirmer nouveau mot de passe
    <input name='newpasswordconfirm' type="password"><br>
        <button type="submit">
            Modifier le mot de passe
        </button>
    </form>
@endsection