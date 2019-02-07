let map, osmUrl, osmAttrib, osm, marker, markersLayer;

/*let $ajax=(param,url,data,done,error) => {
    let Xhr=()=>{
        let xhr = null;
        if (window.XDomainRequest) {
            xhr = new XDomainRequest();
        } else if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            alert("Votre navigateur ne gère pas l'AJAX cross-domain !");
        }
        return xhr;
    };

    let xhttp = Xhr();  // xhttp objet de type XMLHttpRequest

    xhttp.onload=function(){
        if (this.status===200) done(this);
        else error(this);
    };

    if ( param === "get" ) {
        url += data+"&cache="+new Date().getTime();
        xhttp.open("get", url, true);
        xhttp.send();
    } else if ( param === "post" ) {
        if(data===null){
            data = "cache="+new Date().getTime();
        }
        else {
            data = data+"&cache="+new Date().getTime();
        }
        xhttp.open("post", url, true);
        xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhttp.send(data);
    }
};*/

function error(e){
    alert(e.statusText);
}

function createList(){
    let input = document.createElement("input");
    input.setAttribute("list", "villes");
    let datalist = document.createElement("datalist");
    datalist.id = "villes";
    input.onkeyup = () => {
        if(input.value.length >= 3)
            axios.post('/city_search', {
                ville: input.value
            })
                .then(addDatalist)
                .catch(error);
    };
    input.onchange = () => {
        let latitude, longitude;
        for (let i=0 ; i<villes.options.length ; i++) {
            if (villes.options[i].value === input.value) {
                latitude = villes.options[i].getAttribute("data-latitude");
                longitude = villes.options[i].getAttribute("data-longitude");
                break;
            }
        }
        setVille(latitude, longitude);
    };

    content.appendChild(input);
    content.appendChild(datalist);
    let div = document.createElement("div");
    div.id = "map";
    div.style.height = "500px";
    div.style.width = "500px";
    content.appendChild(div);

    /***InitMap***/
    map = L.map('map');
    osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    osmAttrib='Map data © OpenStreetMap contributors';
    osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
    map.setView([47.0, 3.0], 6).addLayer(osm);
    markersLayer = new L.LayerGroup();
    /***-------***/

    map.on('moveend', function(){
        let infos = map.getBounds();
        let SW = infos['_southWest']; //Long et lat du Sud Ouest
        let NE =  infos['_northEast'];//Long et lat du Nord Est
        let SW_send = SW['lat']+'|'+SW['lng'];
        let NE_send = NE['lat']+'|'+NE['lng'];
        axios.post('/stores_search', {
            'SW': SW_send,
            'NE': NE_send,
        })
            .then(addMarker)
            .catch(error);
    });

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
}

function setVille(latitude, longitude){
    map.setView([latitude, longitude], 13).addLayer(osm);
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