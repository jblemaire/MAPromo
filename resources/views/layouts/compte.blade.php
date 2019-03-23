<div class="monCompte">
        <!-- Authentication Links -->
    @if(Auth::user() && Auth::user()->idRole === 1)
        <li><button><a href="{{route('admin')}}">Gestion des tables</a></button></li>
    @endif
    @guest
        <li><button type="button" data-toggle="modal" data-target="#connexion">Connexion</button></li>
        <li><button type="button" data-toggle="modal" data-target="#inscription">Inscription</button></li>
    @else
        <li><button><a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Déconnexion</a></button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    @endguest
</div>