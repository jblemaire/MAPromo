<div id="content" class="content">
            <div class="main text-center">
                <div id="search" class="input-group">
                    <input type="hidden" id="latitude">
                    <input type="hidden" id="longitude">
                    <input type="text" placeholder="Ville" aria-label="Ville" aria-describedby="button-addon2" list="villes" onkeyup="searchVilles()" id="inputVille">
                    <datalist id="villes"></datalist>
                    <div class="input-group-append">
                        <button type="button" id="button-addon2" onclick="setVille(latitude.value, longitude.value)">Rechercher</button>
                    </div>
                </div>
                <div id="filters" class="input-group">
                    <select class="custom-select" id="selectType" onchange="searchCategories()">
                        <option value="">--Choisir un type--</option>
                        @foreach($types as $type)
                            <option value="{{$type->idType}}">{{$type->libType}}</option>
                        @endforeach
                    </select>
                    <select class="custom-select"id="selectCategorie" disabled>
                        <option value="">--Choisir une categorie--</option>
                    </select>
                </div>
            </div>
        <div id="map">
            <script>
                initMap()
            </script>
        </div>
        <div id="magasin" style="display: none; margin: 15px 0; align-items: center;">
            <div id="magasinDétail" style="width: 50%;">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div id="carouselStore" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                </div>
                                <a class="carousel-control-prev" href="#carouselStore" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselStore" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div id="cardBody" class="col-md-8">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="promotions" style="width: 50%">
                <h4>Promotions en cours</h4>
                <ul id="listPromo" class="list-group">

                </ul>
            </div>
        </div>
        <div id="messagePromo" class="alert" role="alert" style="display: none"></div>

        <div id="codePromo" style="display: none">
            <div id="textCodePromo">

            </div>
        </div>
</div>
@guest
        @include('includes.login')
        @include('includes.register')
    @else
        <input id="userInfos" type="hidden" value="{{Auth::user()}}"/>
@endguest