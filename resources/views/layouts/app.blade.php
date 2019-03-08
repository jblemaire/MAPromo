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
        @include('layouts.footer')
        @include('layouts.barFooterMobile')
    </footer>

</div>
</body>
</html>
