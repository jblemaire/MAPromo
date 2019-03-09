<div class="wrapper">
<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>MAPromo</h3>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="{{ route('home') }}">Mon compte</a>
        </li>
        <li>
            <a href="{{ route('home') }}">Réglages</a>
        </li>
        <li>
            <a href="{{ route('home') }}">Contact</a>
        </li>
    </ul>
</nav>
<!-- Page Content Holder -->
<div id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div>
            <button type="button" id="sidebarCollapse" class="navbar-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <a class="title" href="{{ url('/') }}">{{ $title }}</a>
        <div id="search_desktop" class="input-group">
                <input type="hidden" id="latitude">
                <input type="hidden" id="longitude">
                <input type="text" placeholder="Ville" aria-label="Ville" aria-describedby="button-addon2" list="villes" onkeyup="searchVilles()" id="inputVille">
                <datalist id="villes"></datalist>
                <div class="input-group-append">
                    <button type="button" id="button-addon2" onclick="setVille(latitude.value, longitude.value)">Rechercher</button>
                </div>
            </div>
        <div class="button_nav">
                <div onclick="search()">
                    <a href="#"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_Search_2248535') }}"/></svg></a>
                </div>
                <div onclick="filters()">
                    <a href="#"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_User_875020') }}"/></svg></a>
                </div>
        </div>
        <div class="collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right" style="flex-direction: row">
                <div id="monCompte">
                    <!-- Authentication Links -->
                @if(Auth::user() && Auth::user()->idRole === 1)
                    <li><a href="{{route('admin')}}">Gestion des tables</a></li>
                @endif
                @guest
                    <li><button type="button" data-toggle="modal" data-target="#connexion">Connexion</button></li>
                    <li><button type="button" data-toggle="modal" data-target="#inscription">Inscription</button></li>
                @else
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
                </div>
            </ul>
        </div>
    </nav>
</div>
<script>
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});
</script>