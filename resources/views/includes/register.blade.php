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
                    <h3 id="titre-form">Inscription Client</h3>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <div>
                            <input id="type" type="hidden" class="inputText" name="type" value="{{ old('type') | 2 }}" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label for="lastname" class="">Nom*</label>

                        <div>
                            <input id="lastname" type="text" class="inputText" name="lastname" value="{{ old('lastname') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="">Prénom*</label>

                        <div>
                            <input id="name" type="text" class="inputText" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="">Adresse Email*</label>
                        <div>
                            <input id="email" type="email" class="inputText" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="passwordInscription" class="">Mot de passe*</label>

                        <div>
                            <input id="passwordInscription" type="password" class="inputText" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="">Confirmation du mot de passe</label>

                        <div>
                            <input id="password-confirm" type="password" class="inputText" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="">Téléphone</label>

                        <div>
                            <input id="phone" type="text" class="inputText" name="phone" value="{{ old('phone') }}">

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <label class="">Captcha</label>

                        <div pull-center>
                            {!! NoCaptcha::display() !!}

                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <button type="submit">
                                S'inscrire
                            </button>
							
							<a href="{{url('/login/facebook')}}" ><button id="btnFb">S'inscrire avec Facebook</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>