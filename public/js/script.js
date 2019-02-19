let map, osmUrl, osmAttrib, osm, marker, markersLayer;

function error(e){
    alert(e.statusText);
}

function searchVilles(){
    let input = document.getElementById('inputVille');

    if(input.value.length >= 3)
        axios.post('/city_search', {
            ville: input.value
        })
            .then(addDatalist)
            .catch(error);
}


function initMap(){
    map = L.map('map');
    osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    osmAttrib='Map data © OpenStreetMap contributors';
    osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
    map.setView([47.0, 3.0], 6).addLayer(osm);
    markersLayer = new L.LayerGroup();
}

function addDatalist(r){
    let res = r.data;
    let datalist = document.getElementById('villes');
    datalist.innerHTML="";
    for(let i = 0; i < res.length ; i++){
        let option = document.createElement("option");
        let ville = res[i].nomVille + " - " + res[i].cpVille;
        option.setAttribute("value", ville);
        option.setAttribute("data-latitude", res[i].latVille);
        option.setAttribute("data-longitude", res[i].longVille);
        datalist.appendChild(option);
    }
    let input = document.getElementById('inputVille');
    input.onchange = () => {
        for (let i=0 ; i<villes.options.length ; i++) {
            if (villes.options[i].value === input.value) {
                latitude.value = villes.options[i].getAttribute("data-latitude");
                longitude.value = villes.options[i].getAttribute("data-longitude");
                break;
            }
        }
    };
}

function setVille(latitude, longitude){
    map.setView([latitude, longitude], 13).addLayer(osm);
    getStores();

    map.on('moveend', function(){
        if(latitude !== "" && longitude!=="") {
            getStores();
        }
    });
}

function getStores(){
    let infos = map.getBounds();
    let SW = infos['_southWest']; //Long et lat du Sud Ouest
    let NE = infos['_northEast'];//Long et lat du Nord Est
    let SW_send = SW['lat'] + '|' + SW['lng'];
    let NE_send = NE['lat'] + '|' + NE['lng'];
    let type = document.getElementById('selectType').value;
    let cat = document.getElementById('selectCategorie').value;
    axios.post('/stores_search', {
        'SW': SW_send,
        'NE': NE_send,
        'type': type,
        'categorie': cat
    })
        .then(addMarker)
        .catch(error);
}

function addMarker(r){
    let res = r.data;
    console.log(res);
    markersLayer.clearLayers();
    for (let i = 0; i < res.length; i++) {
        marker= L.marker([ res[i].latMagasin, res[i].longMagasin]);
        marker.bindPopup(`<b>${res[i].nomMagasin}</b> <br />${res[i].adresse1Magasin} ${res[i].adresse2Magasin} <br />${res[i].cpVille} ${res[i].nomVille}`);
        markersLayer.addLayer(marker);
    }
    markersLayer.addTo(map);
}

function changeTypeInscription(value){
    let title = document.getElementById('titre-form');
    if(value==="2")
        title.innerText = "Inscription Client";
    else if (value==="3")
        title.innerText = "Inscription Responsable de Magasin";
    let inputType = document.getElementById('type');
    inputType.value = value;

}

function toggle() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        let dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
};

function searchCategories(){
    let type = document.getElementById('selectType').value;
    if(type !== ""){
        axios.post('/categories_search', {
            'idType': type
        })
            .then(addCategories)
            .catch(error);
    }
    else{
        document.getElementById('selectCategorie').disabled = true;
    }
}

function addCategories(r){
    let res = r.data;
    let cat = document.getElementById('selectCategorie');
    cat.innerHTML="";
    if(res.length === 0){
        let option = document.createElement("option");
        option.setAttribute("value", "");
        option.appendChild(document.createTextNode('Aucune catégorie pour ce type de magasin'));
        cat.disabled = true;
        cat.appendChild(option);
    }
    else{
        let option = document.createElement("option");
        option.setAttribute("value", "");
        option.appendChild(document.createTextNode('--Choisir une categorie--'));
        cat.appendChild(option);
        for(let i = 0; i < res.length ; i++){
            let option = document.createElement("option");
            option.setAttribute("value", res[i].idCategorie);
            option.appendChild(document.createTextNode(res[i].libCategorie));
            cat.disabled = false;
            cat.appendChild(option);
        }
    }

}

