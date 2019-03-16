@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{route('promotion_magasins')}}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="selectMagasin" class="col-md-4 control-label">Nom du Magasin</label>

            <div class="input-group col-md-6">
                <select class="form-control" aria-label="Magasin" aria-describedby="button-addon2" id="selectMagasin" name="selectMagasin">
                    <option value="" selected disabled>--Choisir un magasin--</option>
                    @foreach($magasins as $magasin)
                        <option value="{{$magasin->idMagasin}}" {{$idMagasin == $magasin->idMagasin ? 'selected' : ''}}>{{$magasin->nomMagasin}}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        Rechercher
                    </button>
                </div>
            </div>
        </div>
    </form>

    @if($promotions)
        <div>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formAddPromotion" aria-expanded="false" aria-controls="formAddPromotion" onclick="getCodes()">
                Ajouter une promotion
            </button>
        </div>
        <div class="collapse" id="formAddPromotion">
            <div class="card card-body">
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('add_promo')}}">
                    {{ csrf_field() }}

                    <input id="idMag" type="hidden" class="form-control" name="idMag" value="{{ $idMagasin }}" required autofocus>

                    <div class="form-group">
                        <label for="nomPromo" class="col-md-4 control-label">Nom de la Promotion*</label>

                        <div class="col-md-6">
                            <input id="nomPromo" type="text" class="form-control" name="nomPromo" value="{{ old('nomPromo') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descPromo" class="col-md-4 control-label">Descrption de la Promotion*</label>

                        <div class="col-md-6">
                            <textarea id="descPromo" class="form-control" name="descPromo" required autofocus></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dateDebutPromo" class="col-md-4 control-label">Date de Début*</label>

                        <div class="col-md-6">
                            <input id="dateDebutPromo" type="date" class="form-control" name="dateDebutPromo" value="{{ old('dateDebutPromo') }}" onchange="getMinMaxFinPromo(this.value)" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dateFinPromo" class="col-md-4 control-label">Date de Fin*</label>

                        <div class="col-md-6">
                            <input id="dateFinPromo" type="date" class="form-control" name="dateFinPromo" value="{{ old('dateFinPromo') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo1Promo" class="col-md-4 control-label">Photo 1</label>

                        <div class="col-md-6">
                            <input id="photo1Promo" type="file" class="form-control" name="photo1Promo" value="{{ old('photo1Promo') }}" accept=".jpg, .jpeg, .png" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo2Promo" class="col-md-4 control-label">Photo 2</label>

                        <div class="col-md-6">
                            <input id="photo2Promo" type="file" class="form-control" name="photo2Promo" value="{{ old('photo2Promo') }}" accept=".jpg, .jpeg, .png" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo3Promo" class="col-md-4 control-label">Photo 3</label>

                        <div class="col-md-6">
                            <input id="photo3Promo" type="file" class="form-control" name="photo3Promo" value="{{ old('photo3Promo') }}" accept=".jpg, .jpeg, .png" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="codePromo" class="col-md-4 control-label">Code Promo*</label>

                        <div class="col-md-6">
                            <input id="codePromo" type="text" class="form-control" name="codePromo" value="{{ old('codePromo') }}" readonly required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="codeAvis" class="col-md-4 control-label">Code Avis*</label>

                        <div class="col-md-6">
                            <input id="codeAvis" type="text" class="form-control" name="codeAvis" value="{{ old('codeAvis') }}" readonly required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(count($promotions)===0)
        <h4>Aucune promotion pour ce magasin</h4>
            @else
            <div class="accordion" id="promotionsMagasins">
                @foreach($promotions as $promotion)
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.125);">
                        <div class="card-header" id="heading{{$promotion->idPromo}}">
                            <h1 class="col-md-11">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$promotion->idPromo}}" aria-expanded="true" aria-controls="collapse{{$promotion->idPromo}}">
                                    {{$promotion->libPromo}}
                                </button>
                            </h1>
                            <div class="form-group col-md-1">
                                <div class="form-check">
                                    <input class="checkboxEtat" type="checkbox" value="{{$promotion->etatPromo}}" id="checkboxEtat{{$promotion->idPromo}}" {{$promotion->etatPromo == 1 ? 'checked' : ''}} style="display: none">
                                    <label class="labelEtat" for="checkboxEtat{{$promotion->idPromo}}" onclick="updateEtat({{$promotion->idPromo}},{{$promotion->etatPromo}})">Etat</label>
                                </div>
                            </div>
                        </div>

                        <div id="collapse{{$promotion->idPromo}}" class="collapse show" aria-labelledby="heading{{$promotion->idPromo}}" data-parent="#promotionsMagasins">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{$promotion->descPromo}}</li>
                                    <li class="list-group-item"><b>Date de Début : </b>{{$promotion->dateDebutPromo}}</li>
                                    <li class="list-group-item"><b>De de Fin : </b>{{$promotion->dateDebutPromo}}</li>
                                    <li class="list-group-item"><b>Code Promo : </b>{{$promotion->codePromo}}</li>
                                    <li class="list-group-item"><b>Code Avis : </b>{{$promotion->codeAvisPromo}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
    @endif
@endsection
