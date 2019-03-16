@extends('layouts.app')

@section('content')
    <div>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formAddMagasin" aria-expanded="false" aria-controls="formAddMagasin">
            Ajouter un magasin
        </button>
    </div>
    <div class="collapse" id="formAddMagasin">
        <div class="card card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('add_magasin')}}">
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
                    <label for="photo1Mag" class="col-md-4 control-label">Photo 1</label>

                    <div class="col-md-6">
                        <input id="photo1Mag" type="file" class="form-control" name="photo1Mag" value="{{ old('photo1Mag') }}" accept=".jpg, .jpeg, .png" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="photo2Mag" class="col-md-4 control-label">Photo 2</label>

                    <div class="col-md-6">
                        <input id="photo2Mag" type="file" class="form-control" name="photo2Mag" value="{{ old('photo2Mag') }}" accept=".jpg, .jpeg, .png" autofocus>
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

    <div id="magasins">
        <?php $cpt = 0; ?>
        <div class="row">
        @foreach($magasins as $magasin)
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div class="card" style="width: 100%">
                    @if($magasin->photo1Magasin || $magasin->photo2Magasin)
                    <div id="carouselStores{{$magasin->idMagasin}}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @if($magasin->photo1Magasin)
                                <div class="carousel-item active" style="height: 250px">
                                    <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$magasin->photo1Magasin}}" alt="Image 1">
                                </div>
                            @endif
                            @if($magasin->photo2Magasin)
                                <div class="carousel-item" style="height: 250px">
                                    <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$magasin->photo2Magasin}}" alt="Image 2">
                                </div>
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#carouselStores{{$magasin->idMagasin}}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselStores{{$magasin->idMagasin}}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$magasin->nomMagasin}}</h5>
                        <h6 class="card-subtitle mb-2">{{$magasin->adresse1Magasin}} {{$magasin->adresse2Magasin}}</h6>
                        <h6 class="card-subtitle mb-2">{{$magasin->cpVille}} {{$magasin->nomVille}}</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Mail : {{$magasin->mailMagasin}}</li>
                            @if($magasin->telMagasin)
                                <li class="list-group-item">Tel : {{$magasin->telMagasin}}</li>
                            @endif
                            <li class="list-group-item">Type : {{$magasin->libType}}</li>
                            @if($magasin->idCategorie)
                                <li class="list-group-item">Categorie : {{$magasin->libCategorie}}</li>
                            @endif
                        </ul>
                        <a href="{{route('update_magasin', ['idMagasin' => $magasin->idMagasin])}}" class="btn btn-primary">Modifier</a>
                        <a href="{{route('delete_magasin', ['idMagasin' => $magasin->idMagasin])}}" class="btn btn-primary">Supprimer</a>
                        <a href="{{route('promotions', ['idMagasin' => $magasin->idMagasin])}}" class="btn btn-primary">Voir les promotions</a>

                    </div>
                </div>
            </div>
                <?php $cpt++; ?>
            @if($cpt%2 === 0)
        </div>
        <div class="row">
            @endif
        @endforeach
        </div>
    </div>
@endsection