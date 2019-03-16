@extends('layouts.app')

@section('content')
    <?php $old_magasin=0; ?>
    @if(!count($adhesions))
        <h4>Vous n'avez profité d'aucune promotions</h4>
    @endif
    <div class="accordion" id="accordionPromo">
        @foreach($adhesions as $adhesion)
            @if($adhesion->idMagasin !== $old_magasin)
                @if($old_magasin !== 0)
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordionPromo" href="#collapse{{$adhesion->idMagasin}}">{{$adhesion->nomMagasin}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$adhesion->idMagasin}}" class="collapse">
                        <div class="card-body">
                            <div class="accordion" id="accordion{{$adhesion->idMagasin}}">
            @endif
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">
                                            <a data-toggle="collapse" data-parent="#accordion{{$adhesion->idMagasin}}" href="#collapsePromo{{$adhesion->idPromo}}">{{$adhesion->libPromo}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsePromo{{$adhesion->idPromo}}" class="collapse">
                                        <div class="card-body">
                                            <div class="row no-gutters">
                                                <div class="col-md-3">
                                                    <div id="carouselPromo{{$adhesion->idPromo}}" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @if(!$adhesion->photo1Promo && !$adhesion->photo2Promo && !$adhesion->photo3Promo)
                                                                <div class="carousel-item active" style="height: 150px">
                                                                    <p class="d-block w-100 h-100">Aucune Image disponible</p>
                                                                </div>
                                                            @endif
                                                            @if($adhesion->photo1Promo)
                                                                <div class="carousel-item active" style="height: 150px">
                                                                    <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$adhesion->photo1Promo}}" alt="Image 1">
                                                                </div>
                                                            @endif
                                                            @if($adhesion->photo2Promo)
                                                                <div class="carousel-item" style="height: 150px">
                                                                    <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$adhesion->photo2Promo}}" alt="Image 2">
                                                                </div>
                                                            @endif
                                                            @if($adhesion->photo3Promo)
                                                                <div class="carousel-item" style="height: 150px">
                                                                    <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$adhesion->photo3Promo}}" alt="Image 3">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselPromo{{$adhesion->idPromo}}" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselPromo{{$adhesion->idPromo}}" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div id="cardBody" class="col-md-6">
                                                    <div class="card-body">
                                                        <h5 class="card-subtitle mb-2">{{$adhesion->descPromo}}</h5>
                                                        <h5 class="card-subtitle mb-2">La promo est dipsonible entre le {{$adhesion->dateDebutPromo}} et le {{$adhesion->dateFinPromo}}</h5>
                                                        <h5 class="card-subtitle mb-2">Profitez-en avec le code <b>{{$adhesion->codePromo}}</b></h5>
                                                    </div>
                                                </div>
                                                <div id="cardBody" class="col-md-3">
                                                    <div class="card-body">
                                                        <h5 class="card-subtitle mb-2">
                                                            @if($adhesion->noteAdesion)
                                                                <h5 class="card-subtitle mb-2">Vous avez mis la note de <b>{{$adhesion->noteAdesion}}/5</b></h5>
                                                            @else
                                                                <h6 class="card-subtitle mb-2">Vous n'avez mis aucune note</h6>
                                                            @endif
                                                        </h5>
                                                        <h5 class="card-subtitle mb-2">
                                                            @if($adhesion->commentaireAdhesion)
                                                                <h5 class="card-subtitle mb-2">Votre commentaire : <br />{{$adhesion->commentaireAdesion}}</h5>
                                                            @else
                                                                <h6 class="card-subtitle mb-2">Vous n'avez mis aucun commentaire</h6>
                                                            @endif
                                                        </h5>
                                                        <a href="{{route('details_promo', ['idPromo'=>$adhesion->idPromo])}}" class="btn btn-primary">Ajouter un commentaire / Voir la promotion</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php $old_magasin = $adhesion->idMagasin; ?>
        @endforeach
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection