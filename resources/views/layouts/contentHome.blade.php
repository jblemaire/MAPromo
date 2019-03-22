<section class="main">
    <div>
        <h2>A Propos</h2>
        <p style="text-align: justify">
        Bienvenue sur MAPromo ! Venez profiter de nombreuses promotions dans vos magasins favoris dans toutes la France.
        Recherchez votre ville, téléchargez le code promotion, et venez voir vos commerçants préférées pour en profiter !
        Vous êtes commerçants et vous souhaitez référencer vos magasins ainsi que vos promotions. Ce site est fait pour vous.
        Alors n'hésitez plus et venez rejoindre la communauté MAPromo. Des promotions partout, tous le temps.
        </p>
    </div>
</section>
<section class="main blockViewRating row">
    <div class="col">
        <h3>Les derniers avis</h3>
        <div class="row">
            <div id="carouselLastAvis" class="carousel slide col" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $count = 0 ; ?>
                        <div class="carousel-item active" style="align-items: center">
                        @foreach($lastComms as $lastComm)
                            <div class="blockView col">
                                <div class="d-block w-40 h-100">
                                    <div class="blockViewTitle">
                                        <div style="margin: 0 auto">
                                            <h4>Avis de {{$lastComm->prenomUser}} {{$lastComm->nomUser}}</h4>
                                            <p>sur la promotion <a href="{{route('details_promo', ['idPromo' => $lastComm->idPromo])}}">{{$lastComm->libPromo}}</a></p>
                                        </div>
                                    </div>
                                    <div>
                                        @for($i = 0; $i < 5; $i++)
                                            @if($lastComm->noteAdhesion>$i)
                                                <span class="glyphicon glyphicon-star"></span>
                                            @else
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <div>
                                        <p><b>"</b>{{$lastComm->commentaireAdhesion}}<b>"</b></p>
                                    </div>
                                </div>
                            </div>
                            <?php $count++;?>
                                @if($count%2 === 0)
                                    </div>
                                    @if($count < count($lastComms))
                                        <div class="carousel-item" style="align-items: center">
                                    @endif
                                @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselLastAvis" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselLastAvis" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    <div class="col">
        <h3>Les dernières promotions</h3>
        <div class="row">
            <div id="carouselLastPromos" class="carousel slide col" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $count = 0 ; ?>
                    <div class="carousel-item active" style="align-items: center">
                        @foreach($lastPromos as $lastPromo)
                            <div class="blockView col">
                                <div class="blockViewTitle">
                                    <div style="margin: 0 auto">
                                        <h4>{{$lastPromo->libPromo}}</h4>
                                        <p>{{$lastPromo->dateDebutPromo}} - {{$lastPromo->dateFinPromo}}</p>
                                    </div>
                                </div>
                                <div>
                                    <p><b>"</b>{{$lastPromo->descPromo}}<b>"</b></p>
                                </div>
                            </div>
                            <?php $count++;?>
                            @if($count%2 === 0)
                    </div>
                                @if($count < count($lastPromos))
                    <div class="carousel-item" style="align-items: center">
                                @endif
                            @endif
                        @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselLastPromos" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselLastPromos" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    </div>
</section>