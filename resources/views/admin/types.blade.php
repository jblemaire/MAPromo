@extends('admin.admin')

@section('admin_table')
    <div>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formAddType" aria-expanded="false" aria-controls="formAddType">
            Ajouter un type
        </button>
    </div>
    <div class="collapse" id="formAddType">
        <div class="card card-body">
            <form class="form-horizontal" method="POST" action="{{route('add_type')}}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="libType" class="col-md-4 control-label">Type</label>

                    <div class="col-md-6">
                        <input id="libType" type="text" class="form-control" name="libType" value="{{ old('libType') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Ajouter
                        </button>
                    </div>
                </div>
            </form>
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