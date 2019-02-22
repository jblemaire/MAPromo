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
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody id="bodyTableUser">
        @if(!count($users))
            <tr>
                <td colspan="7" class="text-center">Aucun utilisateur trouvé</td>
            </tr>
        @endif
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->idUser}}</th>
                <td>{{$user->nomUser}}</td>
                <td>{{$user->prenomUser}}</td>
                <td>{{$user->mailUser}}</td>
                <td>{{$user->telUser}}</td>
                <td>{{$user->libRole}}</td>
                @if($user->idRole == 2)
                    <td><a href="{{route('adhesions_list_user', ['idUser' => $user->idUser])}}">Voir ses promotions</a></td>
                @elseif($user->idRole == 3)
                    <td><a href="{{route('magasins_list_user', ['idUser' => $user->idUser])}}">Voir ses magasins</a></td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection