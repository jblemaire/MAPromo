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
        marker.onclick(afficheMagasin(res[i]));
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

function supprComm(idPromo, idUser){
    axios.post('/admin/delete_com', {
        'idPromo': idPromo,
        'idUser': idUser
    })
        .then(window.location.reload())
        .catch(error);
}

function getVilleByCp(codePostal){
    if(codePostal.length === 5){
        axios.post('/magasins/city_search_by_cp', {
            'cpVille': codePostal
        })
            .then(addSelectVille)
            .catch(error);
    }
    else{
        let selectVille = document.getElementById('villeMag');
        selectVille.innerHTML="";
        let option = document.createElement("option");
        option.appendChild(document.createTextNode('Le code Postal n\'est pas valide'));
        selectVille.disabled = true;
        selectVille.appendChild(option);
        document.getElementById('longMag').value = '';
        document.getElementById('latMag').value = '';
    }
}

function addSelectVille(r){
    let res = r.data;
    let selectVille = document.getElementById('villeMag');
    selectVille.innerHTML="";
    if(res.length === 0 ){
        let option = document.createElement("option");
        option.appendChild(document.createTextNode('Aucune villes trouvée'));
        selectVille.disabled = true;
        selectVille.appendChild(option);
    }
    else {
        for (let i = 0 ; i < res.length ; i++){
            let option = document.createElement("option");
            option.setAttribute("value", res[i].codeINSEEVille);
            option.appendChild(document.createTextNode(res[i].nomVille));
            selectVille.disabled = false;
            selectVille.appendChild(option);
            document.getElementById('longMag').value = '';
            document.getElementById('latMag').value = '';
        }
    }
}

function getCoordonnes(){
    let codeINSEE = document.getElementById('villeMag').value;
    let numRue = document.getElementById('adresse1Mag').value;
    let adresse = document.getElementById('adresse2Mag').value;

    let queryAdresse = numRue + ' ' + adresse;
    queryAdresse = queryAdresse.split(' ').join('+');

    axios.get('https://api-adresse.data.gouv.fr/search/?q='+queryAdresse+'&citycode='+codeINSEE, null)
        .then(addCoordonnes)
        .catch(error);
}

function addCoordonnes(r){
    let res = r.data;
    let longitude = res.features[0].geometry.coordinates[0];
    let latitude = res.features[0].geometry.coordinates[1];

    document.getElementById('longMag').value = longitude;
    document.getElementById('latMag').value = latitude;
}

function getCodes(){
    let codePromo = "";
    let codeAvis = "";
    let char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (let i = 0; i < 3; i++) {
        codePromo += char.charAt(Math.floor(Math.random() * char.length));
        codeAvis += char.charAt(Math.floor(Math.random() * char.length));
    }

    document.getElementById('codePromo').value = codePromo;
    document.getElementById('codeAvis').value = codeAvis;

    getToday();

}

function getToday(){
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth()+1; //January is 0!
    let yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById('dateDebutPromo').min = today;
}

function getMinMaxFinPromo(dateDebutPromo){
    let dateDebut = new Date(dateDebutPromo);
    let dateFin = new Date();
    let numberOfDaysToAdd = 15;
    dateFin.setDate(dateDebut.getDate() + numberOfDaysToAdd);

    let dd = dateFin.getDate();
    let mm = dateFin.getMonth()+1; //January is 0!
    let yyyy = dateFin.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    dateFin = yyyy + '-' + mm + '-' + dd;

    document.getElementById('dateFinPromo').min = dateDebutPromo;
    document.getElementById('dateFinPromo').max = dateFin;
}

function updateEtat(idPromo, etat){
    if(etat === 0){
        etat = 1;
    }
    else{
        etat = 0;
    }

    document.getElementById(`checkboxEtat${idPromo}`).value = etat;

    axios.post('/promotions/update_etat', {
        'promo': idPromo,
        'etat': etat
    })
        .then()
        .catch(error);
}

function afficheMagasin(magasin){
    console.log(magasin);
}

