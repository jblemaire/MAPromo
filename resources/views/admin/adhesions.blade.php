@extends('admin.admin')

@section('admin_table')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id Promotion</th>
            <th scope="col">Promotion</th>
            <th scope="col">Id Internaute</th>
            <th scope="col">Internaute</th>
            <th scope="col">Note</th>
            <th scope="col">Commentaire</th>
        </tr>
        </thead>
        <tbody>
        @foreach($adhesions as $adhesion)
            <tr>
                <th scope="row">{{$adhesion->Promotion_idPromo}}</th>
                <td>{{$adhesion->libPromo}}</td>
                <th scope="row">{{$adhesion->Internaute_idInternaute}}</th>
                <td>{{$adhesion->nomUser}} {{$adhesion->prenomUser}}</td>
                <td>{{$adhesion->noteAdhesion}}</td>
                <td>{{$adhesion->commentaireAdhesion}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$adhesions->links()}}
@endsection