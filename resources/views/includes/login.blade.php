<div class="modal" id="connexion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div><img class="logo_login" src="{{ asset('img/markers/marker_rouge.png') }}" alt="logo"></div>
                <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Adresse Email</label>

                        <div class="col-md-6">
<<<<<<< HEAD
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
=======
                            <input id="email" class="inputText" type="email" name="email" value="{{ old('email') }}" required autofocus>
>>>>>>> front-end

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Mot de passe</label>

                        <div class="col-md-6">
                            <input id="password" class="inputText" type="password" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <button type="submit">
                                Se connecter
                            </button>
                            
                            <button><a href="{{url('/login/facebook')}}">Se connecter avec Facebook</a></button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>