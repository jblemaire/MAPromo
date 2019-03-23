
@extends('layouts.app')

@section('content')
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


@endsection