
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
    <form method="POST" action="{{route('updatepassword')}}">
        {{ csrf_field() }}
    Ancien mot de passe
    <input name='oldpassword' type="password" required><br>
    Nouveau mot de passe
    <input name='newpassword' type="password"><br>
    Confirmer nouveau mot de passe
    <input name='newpasswordconfirm' type="password"><br>
        <button type="submit">
            Modifier le mot de passe
        </button>
    </form>



@endsection