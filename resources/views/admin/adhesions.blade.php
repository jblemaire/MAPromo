@extends('admin.admin')

@section('admin_table')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Promotion</th>
            <th scope="col">Internaute</th>
            <th scope="col">Note</th>
            <th scope="col">Commentaire</th>
        </tr>
        </thead>
        <tbody>
        @if(!count($adhesions))
            <tr>
                <td colspan="4" class="text-center">Aucune adhésion trouvée</td>
            </tr>
        @endif
        @foreach($adhesions as $adhesion)
            <tr>
                <td>{{$adhesion->libPromo}}</td>
                <td>{{$adhesion->nomUser}} {{$adhesion->prenomUser}}</td>
                <td>{{$adhesion->noteAdhesion}} / 5</td>
                <td>{{$adhesion->commentaireAdhesion}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$adhesions->links()}}
@endsection