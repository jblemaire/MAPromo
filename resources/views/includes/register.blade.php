<div class="modal" id="inscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="changeTypeInscription(this.value)" value="2">Je suis un client</button>
                <button onclick="changeTypeInscription(this.value)" value="3">Je suis un responsable de magasin</button>
            </div>

            <div class="modal-body">
                <form id="form" class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h2 id="titre-form">Inscription Client</h2>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <div class="col-md-6">
                            <input id="type" type="hidden" class="form-control" name="type" value="{{ old('type') | 2 }}" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label for="lastname" class="col-md-4 control-label">Nom*</label>

                        <div class="col-md-6">
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Prénom*</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Adresse Email*</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="mailUser" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="passwordInscription" class="col-md-4 control-label">Mot de passe*</label>

                        <div class="col-md-6">
                            <input id="passwordInscription" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmation du mot de passe</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-4 control-label">Téléphone</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Captcha</label>

                        <div class="col-md-6 pull-center">
                            {!! NoCaptcha::display() !!}

                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit">
                                S'inscrire
                            </button>
							
							<a href="{{url('/login/facebook')}}" id="btnFb" class="btn btn-primary">S'inscrire avec Facebook</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>