<div class="flex-center position-ref full-height">
@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <div class="dropdown">
                <button class="dropbtn">Register</button>
                <div class="dropdown-content">
                    <a href="{{ route('register') }}">Client</a>
                    <a href="{{ route('register') }}">Responsable Magasin</a>
                </div>
            </div>
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>
@endif