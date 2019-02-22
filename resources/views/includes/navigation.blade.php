<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="title navbar-brand" href="{{ url('/') }}">
                {{ $title }}
            </a>
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