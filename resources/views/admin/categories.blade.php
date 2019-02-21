@extends('admin.admin')

@section('admin_table')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Type</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $categorie)
            <tr>
                <th scope="row">{{$categorie->idCategorie}}</th>
                <td>{{$categorie->libCategorie}}</td>
                <td>{{$categorie->libType}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$categories->links()}}
@endsection