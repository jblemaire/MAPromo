@extends('layouts.app')

@section('content')
    <div>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formAddMagasin" aria-expanded="false" aria-controls="formAddMagasin">
            Ajouter un magasin
        </button>
    </div>
    <div class="collapse" id="formAddMagasin">
        <div class="card card-body">
            <form class="form-horizontal" method="POST" action="{{route('add_magasin')}}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nomMag" class="col-md-4 control-label">Nom du Magasin*</label>

                    <div class="col-md-6">
                        <input id="nomMag" type="text" class="form-control" name="nomMag" value="{{ old('nomMag') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="siretMag" class="col-md-4 control-label">SIRET*</label>

                    <div class="col-md-6">
                        <input id="siretMag" type="text" class="form-control" name="siretMag" value="{{ old('siretMag') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="adresse1Mag" class="col-md-4 control-label">N° Rue</label>

                    <div class="col-md-1">
                        <input id="adresse1Mag" type="text" class="form-control" name="adresse1Mag" value="{{ old('adresse1Mag') }}" autofocus>
                    </div>

                    <label for="adresse2Mag" class="col-md-1 control-label">Adresse*</label>

                    <div class="col-md-4">
                        <input id="adresse2Mag" type="text" class="form-control" name="adresse2Mag" value="{{ old('adresse2Mag') }}" required autofocus>
                    </div>

                </div>

                <div class="form-group">
                    <label for="cpMag" class="col-md-4 control-label">CP*</label>

                    <div class="col-md-1">
                        <input id="cpMag" type="text" class="form-control" name="cpMag" value="{{ old('cpMag') }}" onkeyup="getVilleByCp(this.value)" required autofocus>
                    </div>

                    <label for="villeMag" class="col-md-1 control-label">Ville*</label>

                    <div class="col-md-4">
                        <select class="form-control" aria-label="Ville" aria-describedby="button-addon2" name="villeMag" id="villeMag" onchange="getCoordonnes()" required disabled>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="latMag" class="col-md-4 control-label">Latitude*</label>

                    <div class="col-md-6">
                        <input id="latMag" type="text" class="form-control" name="latMag" value="{{ old('latMag') }}" required readonly autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="longMag" class="col-md-4 control-label">Longitude*</label>

                    <div class="col-md-6">
                        <input id="longMag" type="text" class="form-control" name="longMag" value="{{ old('longMag') }}" required readonly autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mailMagasin" class="col-md-4 control-label">Email*</label>

                    <div class="col-md-6">
                        <input id="mailMagasin" type="email" class="form-control" name="mailMagasin" value="{{ old('mailMagasin') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="telMag" class="col-md-4 control-label">Téléphone</label>

                    <div class="col-md-6">
                        <input id="telMag" type="text" class="form-control" name="telMag" value="{{ old('telMag') }}" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="selectType" class="col-md-4 control-label">Type*</label>

                    <div class="col-md-6">
                        <select class="form-control" aria-label="Type" aria-describedby="button-addon2" id="selectType" name="selectType" onchange="searchCategories()">
                            <option value="">--Choisir un type--</option>
                            @foreach($types as $type)
                                <option value="{{$type->idType}}">{{$type->libType}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="selectCategorie" class="col-md-4 control-label">Categorie</label>

                    <div class="col-md-6">
                        <select class="form-control" aria-label="Categorie" aria-describedby="button-addon2" name="selectCategorie" id="selectCategorie" disabled>
                            <option value="">--Choisir une categorie--</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="photosMag" class="col-md-4 control-label">Photos</label>

                    <div class="col-md-6">
                        <input id="photosMag" type="file" class="form-control" name="photosMag" value="{{ old('photosMag') }}" autofocus>
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
    @foreach($magasins as $magasin)
        {{$magasin->idMagasin}}
    @endforeach

@endsection