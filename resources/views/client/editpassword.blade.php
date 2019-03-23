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
                <form class="form-horizontal form-horizontal-promo" method="POST" action="{{route('updatepassword')}}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="oldpassword" class="col-md-4 control-label">Ancien mot de passe</label>

                        <div class="col-md-6">
                            <input class="inputText" id="oldpassword" name='oldpassword' type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="newpassword" class="col-md-4 control-label">Nouveau mot de passe</label>

                        <div class="col-md-6">
                            <input class="inputText" id="newpassword" name='newpassword' type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="newpasswordconfirm" class="col-md-4 control-label">Confirmer nouveau mot de passe</label>

                        <div class="col-md-6">
                            <input class="inputText" id="newpasswordconfirm" name='newpasswordconfirm' type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit">
                                Modifier le mot de passe
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection