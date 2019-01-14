"use strict";

let map, osmUrl, osmAttrib, osm, marker;

let $ajax=(param,url,data,done,error) => {
    let getUrl=(objet)=>{
        let result = new Array();
        for(let i in objet){
            result.push(i+"="+encodeURIComponent(objet[i]));
        }
        return result.join('&');
    };

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
        url += "?ville="+data+"&cache="+new Date().getTime();
        xhttp.open("get", url, true);
        xhttp.send();
    } else if ( param === "post" ) {
        data = data+"&cache="+new Date().getTime();
        xhttp.open("post", url, true);
        xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhttp.send(data);
    }
};

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
            $ajax("get", 'getVilles.php', input.value, addDatalist, error);
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
    /***-------***/
}

function addDatalist(r){
    let res = r.responseText;
    res = JSON.parse(res);
    let datalist = document.getElementById('villes');
    datalist.innerHTML="";
    for(let i = 0; i < res.length ; i++){
        let option = document.createElement("option");
        option.setAttribute("value", res[i].nom_ville);
        option.setAttribute("data-latitude", res[i].latitude);
        option.setAttribute("data-longitude", res[i].longitude);
        datalist.appendChild(option);
    }
}

function setVille(latitude, longitude){
    map.setView([latitude, longitude], 13).addLayer(osm);
    $ajax("get", 'getMagasins.php', null, addMarker, error);
}

function addMarker(r){
    if(marker!=undefined)
        map.removeLayer(marker);
    let res = r.responseText;
    res = JSON.parse(res);
    for(let i = 0; i < res.length ; i++){
        marker = L.marker([res[i].latitude, res[i].longitude]).addTo(map);
        marker.bindPopup(`<b>${res[i].nom_mag}</b>`).openPopup();
    }
}