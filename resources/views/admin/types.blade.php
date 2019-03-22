@extends('admin.admin')

@section('admin_table')
    <div class="type">
            <button class="ajouterType" type="button" data-toggle="collapse" data-target="#formAddType" aria-expanded="false" aria-controls="formAddType">
                Ajouter un type
            </button>
        <div id="formAddType">
            <div class="card card-body">
                <form class="form-horizontal" method="POST" action="{{route('add_type')}}">
                    {{ csrf_field() }}
                        <div>
                            <label for="libType" class="control-label">Type</label>
                        </div>                    
                        <div class="col-lg">
                            <input id="libType" class="custom-select" type="text" name="libType" value="{{ old('libType') }}" required autofocus>
                        </div>
                        <div class="col-md">
                            <button type="submit">
                                Ajouter
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if(!count($types))
            <tr>
                <td colspan="3" class="text-center">Aucun type trouvé</td>
            </tr>
        @endif
        @foreach($types as $type)
            <tr>
                <th scope="row">{{$type->idType}}</th>
                <td>{{$type->libType}}</td>
                <td><a href="{{route('categories_list', ['idType' => $type->idType])}}">Voir ses catégories</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$types->links()}}
@endsection