@extends('admin.admin')

@section('admin_table')
    <div class="type">
        <button class="ajouterType" type="button" data-toggle="collapse" data-target="#formAddCat" aria-expanded="false" aria-controls="formAddCat">
            Ajouter une catégorie
        </button>
    </div>
    <div class="collapse" id="formAddCat">
        <div class="card card-body">
            <form class="form-horizontal" method="POST" action="{{route('add_categorie')}}">
                {{ csrf_field() }}

                <div class="col">
                    <label for="libCategorie" class="control-label">Catégorie</label>
                    <input id="libCategorie" type="text" class="inputText" name="libCategorie" value="{{ old('libCategorie') }}" required autofocus>
                </div>

                <div class="col">
                    <label for="selectType" class="control-label">Type</label>
                        <select class="custom-select" aria-label="Type" aria-describedby="button-addon2" name="selectType" id="selectType">
                            <option disabled {{$idType ? '' : 'selected'}}>--Choisir un type--</option>
                            @foreach($types as $type)
                                <option value="{{$type->idType}}" {{$idType == $type->idType ? 'selected' : ''}}>{{$type->libType}}</option>
                            @endforeach
                        </select>
                </div>

                <div class="col">
                        <button type="submit">
                            Ajouter
                        </button>
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