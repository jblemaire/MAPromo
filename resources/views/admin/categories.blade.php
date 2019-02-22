@extends('admin.admin')

@section('admin_table')
    <div>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formAddCat" aria-expanded="false" aria-controls="formAddCat">
            Ajouter une catégorie
        </button>
    </div>
    <div class="collapse" id="formAddCat">
        <div class="card card-body">
            <form class="form-horizontal" method="POST" action="{{route('add_categorie')}}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="libCategorie" class="col-md-4 control-label">Catégorie</label>

                    <div class="col-md-6">
                        <input id="libCategorie" type="text" class="form-control" name="libCategorie" value="{{ old('libCategorie') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="selectType" class="col-md-4 control-label">Type</label>

                    <div class="col-md-6">
                        <select class="form-control" aria-label="Type" aria-describedby="button-addon2" name="selectType" id="selectType">
                            <option disabled {{$idType ? '' : 'selected'}}>--Choisir un type--</option>
                            @foreach($types as $type)
                                <option value="{{$type->idType}}" {{$idType == $type->idType ? 'selected' : ''}}>{{$type->libType}}</option>
                            @endforeach
                        </select>
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
            <th scope="col">Type</th>
        </tr>
        </thead>
        <tbody>
        @if(!count($categories))
            <tr>
                <td colspan="3" class="text-center">Aucune catégorie trouvée</td>
            </tr>
        @endif
        @foreach($categories as $categorie)
            <tr>
                <th scope="row">{{$categorie->idCategorie}}</th>
                <td>{{$categorie->libCategorie}}</td>
                <td>{{$categorie->libType}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$categories->links()}}
@endsection