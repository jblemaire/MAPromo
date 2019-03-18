@extends('layouts.app')

@section('content')
    <div id="content" class="content">
        <ul class="nav navbar-nav gestionTable">
            <li><a href="{{route('users_list')}}">Utilisateurs</a></li>
            <li><a href="{{route('magasins_list')}}">Magasins</a></li>
            <li><a href="{{route('types_list')}}">Types</a></li>
            <li><a href="{{route('categories_list')}}">Categories</a></li>
            <li><a href="{{route('promotions_list')}}">Promotions</a></li>
            <li><a href="{{route('adhesions_list_promo')}}">Adhesions</a></li>
        </ul>

    @yield('admin_table')
    </div>
@endsection
