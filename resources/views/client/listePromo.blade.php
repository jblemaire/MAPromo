@extends('layouts.app')

@section('content')

    @foreach($promotions as $promotion)
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div class="col-md-4">
                    @if($promotion->photo1Promo || $promotion->photo2Promo || $promotion->photo3Promo)
                        <div id="carouselStores{{$promotion->idPromo}}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if($promotion->photo1Promo)
                                    <div class="carousel-item active" style="height: 100px">
                                        <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$promotion->photo1Promo}}" alt="Image 1">
                                    </div>
                                @endif
                                @if($promotion->photo2Promo)
                                    <div class="carousel-item" style="height: 100px">
                                        <img class="d-block w-100 h-100" style="object-fit: cover" src="{{'\img\\'.$promotion->photo2Promo}}" alt="Image 2">
                                    </div>
                                @endif
                                @if($promotion->photo3Promo)
                                    <div class="carousel-item" style="height: 100px">
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
                <div id="cardBody" class="col-md-4">
                    <div class="card-body">
                        <h1 class="card-title">{{$promotion->libPromo}}</h1>
                        <h3 class="card-subtitle mb-2">Du {{$promotion->dateDebutPromo}} au {{$promotion->dateFinPromo}}</h3>
                    </div>
                </div>
                <div id="cardButton" class="col-md-4">
                    <a href="{{route('details_promo', ['idPromo'=>$promotion->idPromo])}}" class="btn btn-primary">Voir la promotion</a>
                </div>
            </div>
        </div>
    @endforeach

@endsection