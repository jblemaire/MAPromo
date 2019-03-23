@extends('layouts.app')

@section('content')
    <div class="main-content" style="justify-content: center">
        <div id="formAddComment" class="col" >
            <div class="card-promotion card card-body">
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
                <form class="form-horizontal form-horizontal-promo" method="POST" action="{{route('updateinfos')}}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nomUser" class="col-md-4 control-label">Nom</label>

                        <div class="col-md-6">
                            <input class="inputText" id="nomUser" name='nomUser' type="text" value="{{$User->nomUser}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prenomUser" class="col-md-4 control-label">Prénom</label>

                        <div class="col-md-6">
                            <input class="inputText" id="prenomUser" name='prenomUser' type="text" value="{{$User->prenomUser}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telUser" class="col-md-4 control-label">Téléphone</label>

                        <div class="col-md-6">
                            <input class="inputText" id="telUser" name='telUser' type="text" value="{{$User->telUser}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit">
                                Enregistrer vos informations
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection