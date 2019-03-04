<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <div>
                <a href="#"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_Home_671857') }}"/></svg></a>
                </div>
            </button>

            <!-- Branding Image -->
            <a class="title navbar-brand" href="{{ url('/') }}">
                {{ $title }}
            </a>

            <div>
                <a href="#"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_notification_2184960') }}"/></svg></a>
            </div>
            <div>
                <a href="#"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_filters_1245150') }}"/></svg></a>
            </div>
            <div>
                <a href="#"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_notification_2184960') }}"/></svg></a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right" style="flex-direction: row">
                <!-- Authentication Links -->
                @if(Auth::user() && Auth::user()->idRole === 1)
                    <li><a href="{{route('admin')}}">Gestion des tables</a></li>
                @endif
            @guest
                    <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connexion">Connexion</button></li>
                    <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inscription">Inscription</button></li>
                @else
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest

                <li><a href="#">À propos</a></li>
            </ul>
        </div>
    </div>
</nav>