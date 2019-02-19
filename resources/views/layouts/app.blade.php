<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>
<body>
<div id="app">
    <header>
        @include('includes.navigation')
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        @include('includes.footer')
    </footer>

</div>

@if(!Auth::id())
    @include('includes.login')
    @include('includes.register')
@endif

</body>
</html>
