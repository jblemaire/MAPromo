<div class="modal" id="connexion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div><img class="logo_login" src="{{ asset('img/markers/marker_rouge.png') }}" alt="logo"></div>
                <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
            </div>

            <div class="modal-body">
                <form class="form-horizontal form-horizontal-promo" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="emailLogin" class="control-label">Adresse Email</label>

                        <div>
                            <input id="emailLogin" class="inputText" type="email" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Mot de passe</label>

                        <div>
                            <input id="password" class="inputText" type="password" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="checkbox">
                            <label class="control-label">Se souvenir de moi</label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <button type="submit">
                                Se connecter
                            </button>
                            
                            <a href="{{url('/login/facebook')}}"><button>Se connecter avec Facebook</button></a>

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