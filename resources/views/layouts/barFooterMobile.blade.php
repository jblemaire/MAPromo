    <div class="bar_mobile row">
        <div class="col">
            <a href="{{ route('home') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_Home_671857') }}"/></svg></a>
            <p>Accueil</p>
        </div>
		@if(Auth::user())
			@if(Auth::user()->idRole == 2)
				<div class="col">
					<a href="{{ route('mes_promotions') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_percentage_1045094') }}"/></svg></a>
					<p>Promotions</p>
				</div>
				<div class="col">
					<a href="{{ route('post_liste') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_discover_1666932') }}"/></svg></a>
					<p>Découvrir</p>
				</div>
			@endif
			@if(Auth::user()->idRole == 3)
				<div class="col">
					<a href="{{ route('magasins') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_Store_850694') }}"/></svg></a>
					<p>Magasins</p>
				</div>
				<div class="col">
					<a href="{{ route('promotions') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_percentage_1045094') }}"/></svg></a>
					<p>Promotions</p>
				</div>
			@endif
		@else
			<div class="col">
				<a href="{{ route('post_liste') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_discover_1666932') }}"/></svg></a>
				<p>Découvrir</p>
			</div>
		@endif

    </div>