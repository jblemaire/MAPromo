@extends('layouts.app')

@section('content')
    <div class="main-content">
        <form method="post" class="form-horizontal-promo" enctype="multipart/form-data" action="{{ route('update_magasin_post') }}">

            {{ csrf_field() }}

            <input id="idMag" type="hidden" class="inputText" name="idMag" value="{{ $magasin->idMagasin }}" required autofocus>

            <div class="form-group">
                <label for="nomMag" class="col-md-4 control-label">Nom du Magasin*</label>

                <div class="col-md-6">
                    <input id="nomMag" type="text" class="inputText" name="nomMag" value="{{ old('nomMag',$magasin->nomMagasin) }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="siretMag" class="col-md-4 control-label">SIRET*</label>

                <div class="col-md-6">
                    <input id="siretMag" type="text" class="inputText" name="siretMag" value="{{ old('siretMag', $magasin->siretMagasin) }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="adresse1Mag" class="col-md-4 control-label">N° Rue</label>

                <div class="col-md-1">
                    <input id="adresse1Mag" type="text" class="inputText" name="adresse1Mag" value="{{ old('adresse1Mag', $magasin->adresse1Magasin) }}" autofocus>
                </div>

                <label for="adresse2Mag" class="col-md-1 control-label">Adresse*</label>

                <div class="col-md-4">
                    <input id="adresse2Mag" type="text" class="inputText" name="adresse2Mag" value="{{ old('adresse2Mag', $magasin->adresse2Magasin) }}" required autofocus>
                </div>

            </div>

            <div class="form-group">
                <label for="cpMag" class="col-md-4 control-label">CP*</label>

                <div class="col-md-1">
                    <input id="cpMag" type="text" class="inputText" name="cpMag" value="{{ old('cpMag', $magasin->cpVille) }}" onkeyup="getVilleByCp(this.value)" required autofocus>
                </div>

                <label for="villeMag" class="col-md-1 control-label">Ville*</label>

                <div class="col-md-4">
                    <select class="form-control custom-select" aria-label="Ville" aria-describedby="button-addon2" name="villeMag" id="villeMag" onchange="getCoordonnes()" required>
                        @foreach($villes as $ville)
                            <option value="{{$ville->codeINSEEVille}}" {{$magasin->codeINSEEVille == $ville->codeINSEEVille ? 'selected' : ''}}>{{$ville->nomVille}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="latMag" class="col-md-4 control-label">Latitude*</label>

                <div class="col-md-6">
                    <input id="latMag" type="text" class="inputText" name="latMag" value="{{ old('latMag', $magasin->latMagasin) }}" required readonly autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="longMag" class="col-md-4 control-label">Longitude*</label>

                <div class="col-md-6">
                    <input id="longMag" type="text" class="inputText" name="longMag" value="{{ old('longMag', $magasin->longMagasin) }}" required readonly autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="mailMagasin" class="col-md-4 control-label">Email*</label>

                <div class="col-md-6">
                    <input id="mailMagasin" type="email" class="inputText" name="mailMagasin" value="{{ old('mailMagasin', $magasin->mailMagasin )}}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="telMag" class="col-md-4 control-label">Téléphone</label>

                <div class="col-md-6">
                    <input id="telMag" type="text" class="inputText" name="telMag" value="{{ old('telMag', $magasin->telMagasin)  }}" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="selectType" class="col-md-4 control-label">Type*</label>

                <div class="col-md-6">
                    <select class="form-control custom-select" aria-label="Type" aria-describedby="button-addon2" id="selectType" name="selectType" onchange="searchCategories()">
                        <option disabled>--Choisir un type--</option>
                        @foreach($types as $type)
                            <option value="{{$type->idType}}" {{$magasin->idType == $type->idType ? 'selected' : ''}}>{{$type->libType}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="selectCategorie" class="col-md-4 control-label">Categorie</label>

                <div class="col-md-6">
                    <select class="form-control custom-select" aria-label="Categorie" aria-describedby="button-addon2" name="selectCategorie" id="selectCategorie">
                        <option {{$magasin->idCategorie ? '' : 'selected'}} value="">--Choisir une categorie--</option>
                        @foreach($categories as $categorie)
                            <option value="{{$categorie->idCategorie}}" {{$magasin->idCategorie == $categorie->idCategorie ? 'selected' : ''}}>{{$categorie->libCategorie}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="photo1Mag" class="col-md-4 control-label">Photo 1</label>

                <div class="col-md-6">
                    <input id="photo1Mag" type="file" class="inputText" name="photo1Mag" value="{{ old('photo1Mag', $magasin->photo1Magasin)  }}" accept=".jpg, .jpeg, .png" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="photo2Mag" class="col-md-4 control-label">Photo 2</label>

                <div class="col-md-6">
                    <input id="photo2Mag" type="file" class="inputText" name="photo2Mag" value="{{ old('photo2Mag', $magasin->photo2Magasin) }}" accept=".jpg, .jpeg, .png" autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6" style="margin: 0 auto;">
                    <button type="submit">
                        Enregistrer les modifications
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection