@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="col">
            <button type="button" data-toggle="collapse" data-target="#formAddMagasin" aria-expanded="false" aria-controls="formAddMagasin" style="width:100%">
                Ajouter un magasin
            </button>
        </div>
    </div>
    <div class="main-content">
        <div class="collapse col" id="formAddMagasin">
            <div class="card-promotion card mb-12">
                <form class="form-horizontal form-horizontal-promo" enctype="multipart/form-data" method="POST" action="{{route('add_magasin')}}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nomMag">Nom du Magasin*</label>

                        <div>
                            <input id="nomMag" type="text" class="inputText" name="nomMag" value="{{ old('nomMag') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="siretMag">SIRET*</label>

                        <div>
                            <input id="siretMag" type="text" class="inputText" name="siretMag" value="{{ old('siretMag') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adresse1Mag">N° Rue</label>

                        <div>
                            <input id="adresse1Mag" type="text" class="inputText" name="adresse1Mag" value="{{ old('adresse1Mag') }}" autofocus>
                        </div>

                        <label for="adresse2Mag" class="control-label">Adresse*</label>

                        <div>
                            <input id="adresse2Mag" type="text" class="inputText" name="adresse2Mag" value="{{ old('adresse2Mag') }}" required autofocus>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="cpMag">CP*</label>

                        <div>
                            <input id="cpMag" type="text" class="inputText" name="cpMag" value="{{ old('cpMag') }}" onkeyup="getVilleByCp(this.value)" required autofocus>
                        </div>

                        <label for="villeMag" class="control-label">Ville*</label>

                        <div>
                            <select class="form-control custom-select" aria-label="Ville" aria-describedby="button-addon2" name="villeMag" id="villeMag" onchange="getCoordonnes()" required disabled>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="latMag">Latitude*</label>

                        <div>
                            <input id="latMag" type="text" class="inputText" name="latMag" value="{{ old('latMag') }}" required readonly autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="longMag">Longitude*</label>

                        <div>
                            <input id="longMag" type="text" class="inputText" name="longMag" value="{{ old('longMag') }}" required readonly autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mailMagasin">Email*</label>

                        <div>
                            <input id="mailMagasin" type="email" class="inputText" name="mailMagasin" value="{{ old('mailMagasin') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telMag">Téléphone</label>

                        <div>
                            <input id="telMag" type="text" class="inputText" name="telMag" value="{{ old('telMag') }}" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="selectType">Type*</label>

                        <div>
                            <select class="form-control custom-select" aria-label="Type" aria-describedby="button-addon2" id="selectType" name="selectType" onchange="searchCategories()">
                                <option value="">--Choisir un type--</option>
                                @foreach($types as $type)
                                    <option value="{{$type->idType}}">{{$type->libType}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="selectCategorie">Categorie</label>

                        <div>
                            <select class="form-control custom-select" aria-label="Categorie" aria-describedby="button-addon2" name="selectCategorie" id="selectCategorie" disabled>
                                <option value="">--Choisir une categorie--</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo1Mag">Photo 1</label>

                        <div>
                            <input id="photo1Mag" type="file" class="inputText" name="photo1Mag" value="{{ old('photo1Mag') }}" accept=".jpg, .jpeg, .png" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo2Mag">Photo 2</label>

                        <div>
                            <input id="photo2Mag" type="file" class="inputText" name="photo2Mag" value="{{ old('photo2Mag') }}" accept=".jpg, .jpeg, .png" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col">
                            <button type="submit">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
        <div class="main-content">
        <div id="magasins" style="width:100%">
            <?php $cpt = 0; ?>
            <div class="row">
            @foreach($magasins as $magasin)
                <div class="col-sm-6" style="display: flex; align-items: center;">
                    <div class="card-promotion card" style="width: 100%">
                        @if($magasin->photo1Magasin || $magasin->photo2Magasin)
                        <div id="carouselStores{{$magasin->idMagasin}}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if($magasin->photo1Magasin)
                                    <div class="carousel-item active" style="height: 250px">
                                        <img class="d-block w-100 h-100" style="border-radius: 10px; object-fit: cover" src="{{'\img\\'.$magasin->photo1Magasin}}" alt="Image 1">
                                    </div>
                                @endif
                                @if($magasin->photo2Magasin)
                                    <div class="carousel-item" style="height: 250px">
                                        <img class="d-block w-100 h-100" style="border-radius: 10px; object-fit: cover" src="{{'\img\\'.$magasin->photo2Magasin}}" alt="Image 2">
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
                            <div class="groupButtonMagasins" style="display: flex; justify-content: space-around">
                                <a href="{{route('update_magasin', ['idMagasin' => $magasin->idMagasin])}}" ><button>Modifier</button></a>
                                <a href="{{route('delete_magasin', ['idMagasin' => $magasin->idMagasin])}}" ><button>Supprimer</button></a>
                                <a href="{{route('promotions', ['idMagasin' => $magasin->idMagasin])}}"><button>Voir les promotions</button></a>
                            </div>
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
    </div>
@endsection