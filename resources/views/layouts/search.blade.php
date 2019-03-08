<div id="content" class="content">
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
                <select aria-label="Type" aria-describedby="button-addon2" id="selectType" onchange="searchCategories()">
                    <option value="">--Choisir un type--</option>
                    @foreach($types as $type)
                        <option value="{{$type->idType}}">{{$type->libType}}</option>
                    @endforeach
                </select>
                <select aria-label="Type" aria-describedby="button-addon2" id="selectCategorie" disabled>
                    <option value="">--Choisir une categorie--</option>
                </select>
            </div>
        <div id="map">
            <script>
                initMap()
            </script>
        </div>
</div>