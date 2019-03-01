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
        @if(!count($promotions))
            <tr>
                <td colspan="8" class="text-center">Aucune promotion trouvée</td>
            </tr>
        @endif
        @foreach($promotions as $promotion)
            <tr>
                <th scope="row">{{$promotion->idPromo}}</th>
                <td>{{$promotion->dateDebutPromo}}</td>
                <td>{{$promotion->dateFinPromo}}</td>
                <td><a href="{{route('adhesions_list_promo', ['idPromo' => $promotion->idPromo])}}">{{$promotion->libPromo}}</a></td>
                <td>{{$promotion->etatPromo}}</td>
                <td>{{$promotion->codePromo}}</td>
                <td>{{$promotion->codeAvisPromo}}</td>
                <td><a href="{{route('magasins_list', ['idMagasin' => $promotion->idMagasin])}}">{{$promotion->nomMagasin}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$promotions->links()}}
@endsection