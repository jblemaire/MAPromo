@extends('admin.admin')

@section('admin_table')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr>
                <th scope="row">{{$type->idType}}</th>
                <td>{{$type->libType}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$types->links()}}
@endsection