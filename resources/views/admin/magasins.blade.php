@extends('admin.admin')

@section('admin_table')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Adresse</th>
            <th scope="col">Code Postal</th>
            <th scope="col">Ville</th>
            <th scope="col">Email</th>
            <th scope="col">Telephone</th>
            <th scope="col">Responsable</th>
            <th scope="col">Type</th>
            <th scope="col">Categorie</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if(!count($magasins))
            <tr>
                <td colspan="11" class="text-center">Aucun magasin trouvé</td>
            </tr>
        @endif
        @foreach($magasins as $magasin)
            <tr>
                <th scope="row">{{$magasin->idMagasin}}</th>
                <td>{{$magasin->nomMagasin}}</td>
                <td>{{$magasin->adresse1Magasin}} {{$magasin->adresse2Magasin}}</td>
                <td>{{$magasin->cpVille}}</td>
                <td>{{$magasin->nomVille}}</td>
                <td>{{$magasin->mailMagasin}}</td>
                <td>{{$magasin->telMagasin}}</td>
                <td><a href="{{route('users_list', ['idUser' => $magasin->idUser])}}">{{$magasin->nomUser}} {{$magasin->prenomUser}}</a></td>
                <td>{{$magasin->libType}}</td>
                <td>{{$magasin->libCategorie}}</td>
                <td><a href="{{route('promotions_list_magasin', ['idMagasin' => $magasin->idMagasin])}}">Voir ses promotions</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$magasins->links()}}
@endsection