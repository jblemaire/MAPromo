
@extends('layouts.app')

@section('content')


    {{--$User--}}
    <form method="POST" action="{{route('updateinfos')}}">
        {{ csrf_field() }}
        Nom
        <input name='nomUser' type="text" value="{{$User->nomUser}}"><br>
        Prénom
        <input name='prenomUser' type="text" value="{{$User->prenomUser}}"><br>
        Téléphone
        <input name='telUser' type="text" value="{{$User->telUser}}"><br>
        <button type="submit">
            Enregistrer vos informations
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