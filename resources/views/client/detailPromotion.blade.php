@extends('layouts.app')

@section('content')

    @foreach($magasins as $magasin)
        <div class="main-content">
            <div class="col">
                <button type="button" data-toggle="collapse" data-target="#magasin" aria-expanded="false" aria-controls="magasin" style="width:100%">
                    Voir le magasin
                </button>
            </div>
        </div>
        <div class="main-content">
            <div id="magasin" class="collapse">
                <div class="card-promotion card mb-12">
                    <div class="row no-gutters" style="align-items: center;">
                        <div class="col-md-4">
                            @if($magasin->photo1Magasin || $magasin->photo2Magasin)
                                <div id="carouselStores{{$magasin->idMagasin}}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @if($magasin->photo1Magasin)
                                            <div class="carousel-item active" style="height: 250px">
                                                <img class="d-block w-100 h-100" style="object-fit: cover; border-radius: 10px;" src="{{'\img\\'.$magasin->photo1Magasin}}" alt="Image 1">
                                            </div>
                                        @endif
                                        @if($magasin->photo2Magasin)
                                            <div class="carousel-item" style="height: 250px">
                                                <img class="d-block w-100 h-100" style="object-fit: cover; border-radius: 10px;" src="{{'\img\\'.$magasin->photo2Magasin}}" alt="Image 2">
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
                        </div>
                        <div id="cardBody" class="col-md-8">
                            <div class="card-body">
                                <h1 class="card-title">{{$magasin->nomMagasin}}</h1>
                                <h3 class="card-subtitle mb-2">{{$magasin->adresse1Magasin}} {{$magasin->adresse2Magasin}}</h3>
                                <h3 class="card-subtitle mb-2">{{$magasin->cpVille}} {{$magasin->nomVille}}</h3>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><h5 class="card-subtitle">Mail : {{$magasin->mailMagasin}}</h5></li>
                                    @if($magasin->telMagasin)
                                        <li class="list-group-item"><h5 class="card-subtitle">Tel : {{$magasin->telMagasin}}</h5></li>
                                    @endif
                                    <li class="list-group-item"><h5 class="card-subtitle">Type : {{$magasin->libType}}</h5></li>
                                    @if($magasin->idCategorie)
                                        <li class="list-group-item"><h5 class="card-subtitle">Categorie : {{$magasin->libCategorie}}</h5></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" id="codeAvisPromo" name="codeAvisPromo" value="{{$magasin->codeAvisPromo}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
        <?php $idPromo = $magasin->idPromo;?>
            <div id="promotion">
                <div class="card-promotion card mb-12">
                    <div class="row no-gutters" style="align-items: center;">
                        <div class="col-md-4">
                            @if($magasin->photo1Promo || $magasin->photo2Promo || $magasin->photo3Promo)
                                <div id="carouselStores{{$magasin->idPromo}}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @if($magasin->photo1Promo)
                                            <div class="carousel-item active" style="height: 250px">
                                                <img class="d-block w-100 h-100" style="border-radius: 10px; object-fit: cover" src="{{'\img\\'.$magasin->photo1Promo}}" alt="Image 1">
                                            </div>
                                        @endif
                                        @if($magasin->photo2Promo)
                                            <div class="carousel-item" style="height: 250px">
                                                <img class="d-block w-100 h-100" style="border-radius: 10px; object-fit: cover" src="{{'\img\\'.$magasin->photo2Promo}}" alt="Image 2">
                                            </div>
                                        @endif
                                        @if($magasin->photo3Promo)
                                            <div class="carousel-item" style="height: 250px">
                                                <img class="d-block w-100 h-100" style="border-radius: 10px; object-fit: cover" src="{{'\img\\'.$magasin->photo3Promo}}" alt="Image 3">
                                            </div>
                                        @endif
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselStores{{$magasin->idPromo}}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselStores{{$magasin->idPromo}}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div id="cardBody" class="col-md-8">
                            <div class="card-body">
                                <h1 class="card-title">{{$magasin->libPromo}}</h1>
                                <h3 class="card-subtitle mb-2">Du {{$magasin->dateDebutPromo}} au {{$magasin->dateFinPromo}}</h3>
                                @if(Auth::user() && Auth::user()->idRole == 2)
                                    <h3 class="card-subtitle mb-2">Profitez-en avec le code <b>{{$magasin->codePromo}}</b></h3>
                                @endguest
                                <p class="card-text">{{$magasin->descPromo}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            @if(Auth::user() && Auth::user()->idRole == 2)
                @if(date('Y-m-d') >= $magasin->dateDebutPromo && date('Y-m-d')<=$magasin->dateFinPromo)
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Entrez le code Avis" aria-label="Entrez le code Avis" aria-describedby="button-addon2" id="inputCodeAvis">
                        <button class="col" type="button" id="button-addon2" onclick="checkCodeAvis()">Valider</button>
                    </div>
        </div>
        <div class="main-content">
                <div id="messageCodeAvis" class="alert alert-danger col" role="alert" style="display: none"></div>
        </div>
        <div class="main-content">
            <div id="formAddComment" class="col" style="display: none">
                <div class="card-promotion card card-body">
                    <form class="form-horizontal form-horizontal-promo" method="POST" action="{{route('post_comment', ['idPromo'=>$idPromo])}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="note" class="col-md-4 control-label">Note</label>

                            <div class="col-md-6">
                                <div style="display: flex">
                                    <span class="glyphicon glyphicon-star" id="formRatingStar0" onmouseover="ratingStarMouseOver(0)"></span>
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="glyphicon glyphicon-star-empty" id="formRatingStar{{$i}}" onmouseover="ratingStarMouseOver({{$i}})"></span>
                                    @endfor
                                <input id="note" type="number" class="form-control" name="note" value="0" readonly autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment" class="col-md-4 control-label">Commentaire</label>

                            <div class="col-md-6">
                                <textarea id="comment" class="form-control" name="comment" autofocus></textarea>
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
                @endif
            @endif
        </div>
    @endforeach
    <div class="main-content">
        @if(count($adhesions) === 0 )
            <h3 class="card-subtitle mb-12">Aucun commentaire</h3>
        @else
            <?php $cpt = 0; ?>
            <div class="col commentaire">
                @foreach($adhesions as $adhesion)
                    <?php $date = date_create_from_format('Y-m-d H:i:s',$adhesion->updated_at);?>
                    <div class="col" style="display: flex; align-items: center;">
                        <div class="blockView col">
                            <div class="d-block w-40 h-100">
                                <div class="blockViewTitle">
                                    <div style="margin: 0 auto">
                                        <h4>Avis de {{$adhesion->prenomUser}} {{$adhesion->nomUser}}</h4>
                                        <p>Posté le {{date_format($date, 'd/m/Y')}} à {{date_format($date, 'H')}}h{{date_format($date, 'i')}}</p>
                                    </div>
                                </div>
                                <div>
                                    @for($i = 0; $i < 5; $i++)
                                        @if($adhesion->noteAdhesion>$i)
                                            <span class="glyphicon glyphicon-star"></span>
                                        @else
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        @endif
                                    @endfor
                                </div>
                                <div>
                                    <p><b>"</b>{{$adhesion->commentaireAdhesion}}<b>"</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $cpt++; ?>
                        @if($cpt%2 === 0)
            </div>
                @if($cpt < count($adhesions))
                    <div class="col commentaire">
                        @endif
                        @endif
                @endforeach
            </div>
        @endif
    </div>
@endsection