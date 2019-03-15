<div class="modal" id="connexion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('mailUser') ? ' has-error' : '' }}">
                        <label for="mailUser" class="col-md-4 control-label">Adresse Email</label>

                        <div class="col-md-6">
                            <input id="mailUser" type="email" class="form-control" name="mailUser" value="{{ old('mailUser') }}" required autofocus>

                            @if ($errors->has('mailUser'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Mot de passe</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

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

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit">
                                Se connecter
                            </button>
                            
                            <a href="{{url('/login/facebook')}}">Se connecter avec Facebook</a>

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