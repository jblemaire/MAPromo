@extends('layouts.app')

@section('content')
    <div class="main-content">
        <form class="form-horizontal form-horizontal-promo" method="POST" action="{{route('promotion_magasins')}}">
            {{ csrf_field() }}

            <div class="form-group" style="align-items: center">
                <label for="selectMagasin" class="col-md-4 control-label">Nom du Magasin</label>

                <div class="input-group col-md-6" style="align-items: center">
                    <select class="custom-select" aria-label="Magasin" aria-describedby="button-addon2" id="selectMagasin" name="selectMagasin">
                        <option value="" selected disabled>--Choisir un magasin--</option>
                        @foreach($magasins as $magasin)
                            <option value="{{$magasin->idMagasin}}" {{$idMagasin == $magasin->idMagasin ? 'selected' : ''}}>{{$magasin->nomMagasin}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button type="submit">
                            Rechercher
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if($promotions)
        <div class="main-content">
            <div class="col">
                <button class="col" type="button" data-toggle="collapse" data-target="#formAddPromotion" aria-expanded="false" aria-controls="formAddPromotion" onclick="getCodes()">
                    Ajouter une promotion
                </button>
            </div>
        </div>
        <div class="collapse col" id="formAddPromotion">
            <div class="card-promotion card card-body">
                <form class="form-horizontal form-horizontal-promo" enctype="multipart/form-data" method="POST" action="{{route('add_promo')}}">
                    {{ csrf_field() }}

                    <input id="idMag" type="hidden" class="form-control" name="idMag" value="{{ $idMagasin }}" required autofocus>

                    <div class="form-group">
                        <label for="nomPromo" class="col-md-4 control-label">Nom de la Promotion*</label>

                        <div class="col-md-6">
                            <input id="nomPromo" type="text" class="inputText" name="nomPromo" value="{{ old('nomPromo') }}" required autofocus>
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
                            <input id="dateDebutPromo" type="date" class="inputText" name="dateDebutPromo" value="{{ old('dateDebutPromo') }}" onchange="getMinMaxFinPromo(this.value)" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dateFinPromo" class="col-md-4 control-label">Date de Fin*</label>

                        <div class="col-md-6">
                            <input id="dateFinPromo" type="date" class="inputText" name="dateFinPromo" value="{{ old('dateFinPromo') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo1Promo" class="col-md-4 control-label">Photo 1</label>

                        <div class="col-md-6">
                            <input id="photo1Promo" type="file" class="inputText" name="photo1Promo" value="{{ old('photo1Promo') }}" accept=".jpg, .jpeg, .png" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo2Promo" class="col-md-4 control-label">Photo 2</label>

                        <div class="col-md-6">
                            <input id="photo2Promo" type="file" class="inputText" name="photo2Promo" value="{{ old('photo2Promo') }}" accept=".jpg, .jpeg, .png" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo3Promo" class="col-md-4 control-label">Photo 3</label>

                        <div class="col-md-6">
                            <input id="photo3Promo" type="file" class="inputText" name="photo3Promo" value="{{ old('photo3Promo') }}" accept=".jpg, .jpeg, .png" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="codePromo" class="col-md-4 control-label">Code Promo*</label>

                        <div class="col-md-6">
                            <input id="codePromo" type="text" class="inputText" name="codePromo" value="{{ old('codePromo') }}" readonly required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="codeAvis" class="col-md-4 control-label">Code Avis*</label>

                        <div class="col-md-6">
                            <input id="codeAvis" type="text" class="inputText" name="codeAvis" value="{{ old('codeAvis') }}" readonly required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="main-content">
        @if(count($promotions)===0)
        <h4>Aucune promotion pour ce magasin</h4>
            @else
            <div class="accordion col" id="promotionsMagasins">
                @foreach($promotions as $promotion)
                    <div class="card card-promotion" style="border: 1px solid rgba(0,0,0,0.125);">
                        <div class="card-header" id="heading{{$promotion->idPromo}}" style="display: flex; align-items: center;">
                            <h4 class="col-md-10">
                                <a data-toggle="collapse" data-target="#collapse{{$promotion->idPromo}}" aria-expanded="true" aria-controls="collapse{{$promotion->idPromo}}">
                                    {{$promotion->libPromo}}
                                </a>
                            </h4>
                            <div class="col">
                                <label class="switch" for="checkboxEtat{{$promotion->idPromo}}" onclick="updateEtat({{$promotion->idPromo}},{{$promotion->etatPromo}})">
                                    <input type="checkbox" value="{{$promotion->etatPromo}}" id="checkboxEtat{{$promotion->idPromo}}" {{$promotion->etatPromo == 1 ? 'checked' : ''}} style="display: none">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div id="collapse{{$promotion->idPromo}}" class="collapse" aria-labelledby="heading{{$promotion->idPromo}}" data-parent="#promotionsMagasins">
                            <div class="card-body">
                                <div class="col-md-4">
                                    @if($promotion->photo1Promo || $promotion->photo2Promo || $promotion->photo3Promo)
                                        <div id="carouselStores{{$promotion->idPromo}}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @if($promotion->photo1Promo)
                                                    <div class="carousel-item active" style="height: 150px">
                                                        <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$promotion->photo1Promo}}" alt="Image 1">
                                                    </div>
                                                @endif
                                                @if($promotion->photo2Promo)
                                                    <div class="carousel-item" style="height: 150px">
                                                        <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$promotion->photo2Promo}}" alt="Image 2">
                                                    </div>
                                                @endif
                                                @if($promotion->photo3Promo)
                                                    <div class="carousel-item" style="height: 150px">
                                                        <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$promotion->photo3Promo}}" alt="Image 3">
                                                    </div>
                                                @endif
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselStores{{$promotion->idPromo}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselStores{{$promotion->idPromo}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{$promotion->descPromo}}</li>
                                        <li class="list-group-item">Date de Début : {{$promotion->dateDebutPromo}}</li>
                                        <li class="list-group-item">Date de Fin : {{$promotion->dateDebutPromo}}</li>
                                        <li class="list-group-item">Code Promo : {{$promotion->codePromo}}</li>
                                        <li class="list-group-item">Code Avis :{{$promotion->codeAvisPromo}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

    @endif
        </div>
@endsection
