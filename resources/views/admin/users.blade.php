@extends('admin.admin')

@section('admin_table')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Email</th>
            <th scope="col">Telephone</th>
            <th scope="col">Rôles</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->idUser}}</th>
                <td>{{$user->nomUser}}</td>
                <td>{{$user->prenomUser}}</td>
                <td>{{$user->mailUser}}</td>
                <td>{{$user->telUser}}</td>
                <td>{{$user->libRole}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection