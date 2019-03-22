<section class="main">
    <div>
        <h2>A Propos</h2>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc massa tortor, viverra vel nisl in, tempor tempus purus. 
        Nam sagittis placerat porttitor. Cras nisl ex, mattis interdum dui at, tristique blandit ligula. 
        Morbi et magna vel quam efficitur fringilla. Aenean dictum urna nec libero egestas cursus. Vivamus mattis a metus in sodales. 
        Pellentesque vel diam ut erat cursus imperdiet et ac velit. Aenean at sodales erat, eu maximus lorem. 
        Donec libero nisi, sagittis non nunc et, aliquam placerat elit. Nulla semper eleifend orci, ac tincidunt lacus volutpat eget. 
        </p>
    </div>
</section>
<section class="blockViewRating row">
    <div class="col">
        <h3>Les derniers avis</h3>
        <div class="row">
            @foreach($lastComms as $lastComm)
                <div class="blockView col">
                    <div class="blockViewTitle">
                        <div><svg class="iconView"><use xlink:href="{{ asset('svg/sprite.svg#noun_Image_2073706') }}"/></svg></div>
                        <div>
                            <h4>Avis de {{$lastComm->prenomUser}} {{$lastComm->nomUser}}</h4>
                            <p>sur la promotion <a href="#">{{$lastComm->libPromo}}</a></p>
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
            @endforeach
        </div>
    </div>
    <div class="col">
        <h3>Les dernières promotions</h3>
        <div class="row">
            @foreach($lastPromos as $lastPromo)
                <div class="blockView col">
                    <div class="blockViewTitle">
                        <div><svg class="iconView"><use xlink:href="{{ asset('svg/sprite.svg#noun_Image_2073706') }}"/></svg></div>
                        <div>
                            <h4>{{$lastPromo->libPromo}}</h4>
                            <p>{{$lastPromo->dateDebutPromo}} - {{$lastPromo->dateFinPromo}}</p>
                        </div>
                    </div>
                    <div>
                        <p><b>"</b>{{$lastPromo->descPromo}}<b>"</b></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>