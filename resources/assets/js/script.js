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

    map.on('moveend', function(){
        if(latitude !== "" && longitude!=="") {
            let infos = map.getBounds();
            let SW = infos['_southWest']; //Long et lat du Sud Ouest
            let NE = infos['_northEast'];//Long et lat du Nord Est
            let SW_send = SW['lat'] + '|' + SW['lng'];
            let NE_send = NE['lat'] + '|' + NE['lng'];
            axios.post('/stores_search', {
                'SW': SW_send,
                'NE': NE_send,
            })
                .then(addMarker)
                .catch(error);
        }
    });
}

function addMarker(r){
    let res = r.data;
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


function searchTypes(){
    axios.post('/types_search', null)
        .then(addTypes)
        .catch(error);
}

function addTypes(r){
    console.log(r);
}

function search(){
    let search = document.getElementById('search');
    let filters = document.getElementById('filters');
    if(search == "flex" && filters == "flex"){
        search.style.display = "none";
        filters.style.display = "none";
    }
    else{
        search.style.display = "flex";
        filters.style.display = "flex";
    }
}

// fonction menu
/*$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});*/