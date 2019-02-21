@extends('admin.admin')

@section('admin_table')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Date de Début</th>
            <th scope="col">Date de Fin</th>
            <th scope="col">Nom</th>
            <th scope="col">Etat</th>
            <th scope="col">Code Promo</th>
            <th scope="col">Code Avis</th>
            <th scope="col">Nom Magasin</th>
        </tr>
        </thead>
        <tbody>
        @foreach($promotions as $promotion)
            <tr>
                <th scope="row">{{$promotion->idPromo}}</th>
                <td>{{$promotion->dateDebutPromo}}</td>
                <td>{{$promotion->dateFinPromo}}</td>
                <td>{{$promotion->libPromo}}</td>
                <td>{{$promotion->etatPromo}}</td>
                <td>{{$promotion->codePromo}}</td>
                <td>{{$promotion->codeAvis}}</td>
                <td>{{$promotion->nomMagasin}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$promotions->links()}}
@endsection