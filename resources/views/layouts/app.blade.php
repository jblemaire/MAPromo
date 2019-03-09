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

    <div>
        @yield('content')
    </div>

    @include('layouts.footer')
    @include('layouts.barFooterMobile')
</div>
</body>
</html>
