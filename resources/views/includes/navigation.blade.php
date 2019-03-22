<div class="wrapper">
<!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <img class="logo" src="{{ asset('img/logoFinal.png') }}" alt="logo">
        </div>
        <ul class="list-unstyled components">
            <li>
            <a href="{{ route('compte') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_account_1575186') }}"/></svg> Mon compte</a>
            </li>
            <li>
                <a href="{{ route('home') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_contact_643154') }}"/></svg> Contact</a>
            </li>
            <li>
                <a href="{{ route('apropos') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_about_1982513') }}"/></svg> A propos</a>
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
            <div class="titleDesktop">
                <li>
                    <img class="logo" src="{{ asset('img/markers/marker_rouge.png') }}" alt="logo">
                </li>
                <li>
                    <a class="title" href="{{ url('/') }}">Accueil</a>
                </li>
                <li>
                    <a class="title" href="{{ url('/contact') }}">Contact</a>
                </li>
            </div>
            <div class="titleMobile">
                <a class="title" href="{{ url('/') }}">{{ $title }}</a>
            </div>
            <div class="button_nav">
                    <div id="showSearch" onclick="search()">
                        <a href="#"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_Search_2248535') }}"/></svg></a>
                    </div>
                    <div>
                        <a href="{{ route('compte') }}"><svg class="svg"><use xlink:href="{{ asset('svg/sprite.svg#noun_User_875020') }}"/></svg></a>
                    </div>
            </div>
            <div class="collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right" style="flex-direction: row">
                    <div id="monCompte" class="buttonNav">
                        <!-- Authentication Links -->
                    @if(Auth::user() && Auth::user()->idRole == 1)
                        <li><a href="{{route('admin')}}"><button>Gestion des tables</button></a></li>
                    @elseif(Auth::user() && Auth::user()->idRole == 2)
                        <li><a href=""><button>Mon compte</button></a></li>
                        <li><a href="{{route('mes_promotions')}}"><button>Mes promotions</button></a></li>
                    @elseif(Auth::user() && Auth::user()->idRole == 3)
                        <li><a href=""><button>Mon compte</button></a></li>
                        <li><a href="{{route('magasins')}}"><button>Mes magasins</button></a></li>
                        <li><a href="{{route('promotions')}}"><button>Mes promotions</button></a></li>
                    @endif
                    @guest
                        <li><button type="button" data-toggle="modal" data-target="#connexion">Connexion</button></li>
                        <li><button type="button" data-toggle="modal" data-target="#inscription">Inscription</button></li>
                    @else
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><button>Déconnexion</button></a>
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
</div>

<script>
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});

$(document).ready(function(){
  $("#showSearch").click(function(){
    $("#search").hide();
  });
  $("#showSearch").click(function(){
    $("#search").show();
  });
});
    
</script>

