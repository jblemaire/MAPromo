
@extends('layouts.app')

@section('content')


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
@endsection