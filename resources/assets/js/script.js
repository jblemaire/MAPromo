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
    L.mapbox.accessToken = 'pk.eyJ1IjoibmFuaWUzMyIsImEiOiJjanNvc3ZjZmMwcTdzNDVsanJwbXFxOGF6In0.APE2fly8QeEl8YNvA53CWQ';
    map = L.map('map');
    osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    osmAttrib='MAPromo, personnalisé avec MapBox';
    osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
    map.setView([47.0, 3.0], 6).addLayer(osm);
    L.mapbox.styleLayer('mapbox://styles/nanie33/cjsosw5k31cxf1fl3wdth7qs4').addTo(map);
    markersLayer = new L.featureGroup();
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

function addMarker(r) {
    let mag = r.data[0];
    let nb_magasin = r.data[1];
    markersLayer.clearLayers();
    let myIconRed = L.icon({
        iconUrl: "\\img\\markers\\marker_rouge.png",
        iconSize:     [20, 30], // size of the icons
        iconAnchor:   [10, 30]
    });
    let myIconGrey = L.icon({
        iconUrl: "\\img\\markers\\marker_gris.png",
        iconSize:     [20, 30], // size of the icons
        iconAnchor:   [10, 30]
    });
    let icon;

    for (let i = 0; i < mag.length; i++) {
        for ( let j=0 ; j < nb_magasin.length ; j++){
            if(mag[i].idMagasin === nb_magasin[j].idMagasin){
                icon = {icon: myIconRed};
                break;
            }
            else{
                icon = {icon: myIconGrey};
            }
        }

        marker = L.marker([mag[i].latMagasin, mag[i].longMagasin], icon);
        marker.object = mag[i];
        markersLayer.addLayer(marker);
    }
    markersLayer.addTo(map).on('click', afficheMagasin);
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

function afficheMagasin(e){
    let magasin = e.layer.object;

    axios.post('/search_promos', {
        'magasin': magasin.idMagasin
    })
        .then(affichePromo)
        .catch(error);

    let divMagasin = document.getElementById('magasin');
    let carousel = document.createElement('div');
    carousel.className = 'carousel-inner';

    if(magasin.photo1Magasin){
        let div = document.createElement('div');
        div.className = 'carousel-item active';
        div.style.height = '125px';

        let img = document.createElement('img');
        img.className = 'd-block w-100 h-100';
        img.src = '\\img\\' + magasin.photo1Magasin;
        img.alt = 'Image 1';
        img.style.objectFit = 'cover';

        div.appendChild(img);
        carousel.appendChild(div);
    }
    if(magasin.photo2Magasin){
        let div = document.createElement('div');
        div.className = 'carousel-item';
        div.style.height = '125px';

        let img = document.createElement('img');
        img.className = 'd-block w-100 h-100';
        img.src = '\\img\\' + magasin.photo2Magasin;
        img.alt = 'Image 2';
        img.style.objectFit = 'cover';

        div.appendChild(img);
        carousel.appendChild(div);
    }

    let carouselStore = document.getElementById('carouselStore');
    carouselStore.replaceChild(carousel, document.getElementsByClassName('carousel-inner')[0]);

    let magasinInfos = document.createElement('div');
    magasinInfos.className = "card-body";

    let title = document.createElement('h4');
    title.className="card-title";
    title.appendChild(document.createTextNode(magasin.nomMagasin));
    magasinInfos.appendChild(title);

    let adresse1 = document.createElement('h5');
    adresse1.className="card-subtitle";
    adresse1.appendChild(document.createTextNode(magasin.adresse1Magasin + ' ' + magasin.adresse2Magasin));
    magasinInfos.appendChild(adresse1);

    let adresse2 = document.createElement('h5');
    adresse2.className="card-subtitle";
    adresse2.appendChild(document.createTextNode(magasin.cpVille + ' ' + magasin.nomVille));
    magasinInfos.appendChild(adresse2);

    let type = document.createElement('h6');
    type.className="card-subtitle";
    type.style.marginTop='5px;';
    let textType;
    if(magasin.idCategorie)
        textType = document.createTextNode(magasin.libType + ' | ' + magasin.libCategorie);
    else
        textType = document.createTextNode(magasin.libType);
    type.appendChild(textType);
    magasinInfos.appendChild(type);

    let coor = document.createElement('p');
    coor.className="card-text";
    let textCoor;
    if(magasin.telMagasin)
        textCoor = document.createTextNode(magasin.mailMagasin + ' | ' + magasin.telMagasin);
    else
        textCoor = document.createTextNode(magasin.mailMagasin);
    coor.appendChild(textCoor);
    magasinInfos.appendChild(coor);

    let cardBody = document.getElementById('cardBody');
    cardBody.replaceChild(magasinInfos, document.getElementsByClassName('card-body')[0]);

    divMagasin.style.display = 'flex';

    $("html, body").animate({
        scrollTop : $('#magasin').offset().top
    },'slow');

}

function affichePromo(r){
    let res = r.data;

    let ul=document.createElement('ul');
    ul.id = 'listPromo';
    ul.className = 'list-group';

    if(res.length === 0 ){
        let li = document.createElement('li');
        li.className='list-group-item';
        li.appendChild(document.createTextNode('Aucune Promotion pour ce magasin'));
        ul.appendChild(li);
    }

    for(let i=0; i<res.length ; i++){
        let li = document.createElement('li');
        li.className='list-group-item';
        li.appendChild(document.createTextNode(res[i].libPromo));

        let buttonDetails = document.createElement('a');
        buttonDetails.className="btn btn-primary";
        buttonDetails.href = document.location.href + 'details_promotion/'+res[i].idPromo;
        buttonDetails.appendChild(document.createTextNode('Voir la promo'));
        buttonDetails.style.float= "right";
        li.appendChild(buttonDetails);

        let buttonAdhesion = document.createElement('button');
        buttonAdhesion.id = 'btnGetCode';
        buttonAdhesion.className="btn btn-primary";
        buttonAdhesion.type="button";
        buttonAdhesion.appendChild(document.createTextNode('Obtenir le code'));
        buttonAdhesion.style.float= "right";
        buttonAdhesion.disabled = true;
        if(document.getElementById('userInfos')) {
            let userInfos = JSON.parse(document.getElementById('userInfos').value);
            if (userInfos.idRole === 2) {
                buttonAdhesion.disabled = false;
                buttonAdhesion.onclick = function () {
                    getCodePromo(res[i].idPromo, res[i].codePromo);
                    $("html, body").animate({
                        scrollTop: $('#codePromo').offset().top
                    }, 'slow');
                };
            }
        }

        li.appendChild(buttonAdhesion);

        ul.appendChild(li);

    }

    document.getElementById('promotions').replaceChild(ul, document.getElementById('listPromo'));
}

function getCodePromo(idPromo, code){
    axios.post('/add_adhesion', {
        'promo': idPromo
    })
        .then((r) => {
            let divCodePromo = document.createElement('div');
            divCodePromo.id="textCodePromo";

            if (r.data === 'done'){
                document.getElementById('messagePromo').className = "alert alert-success";
                afficheMessage('messagePromo', 'Bravo, vous avez accès à la promotion !');

                let codePromo = document.createElement('h1');
                codePromo.className = 'text-center';
                codePromo.appendChild(document.createTextNode('Profitez-en avec le code ' + code));

                divCodePromo.appendChild(codePromo);

            }
            else
            {
                document.getElementById('messagePromo').className = "alert alert-danger";
                afficheMessage('messagePromo', 'Vous avez déjà accès à la promotion !');
            }

            let div = document.getElementById('codePromo');
            div.replaceChild(divCodePromo, document.getElementById('textCodePromo'));
            div.style.display='block';
            }
        )
        .catch(error);
}

function checkCodeAvis(){
    let value = document.getElementById('inputCodeAvis').value;
    let codeAvis = document.getElementById('codeAvisPromo').value;

    if(value === codeAvis){
        document.getElementById('formAddComment').style.display = "block";
    }
    else{
        afficheMessage('messageCodeAvis', 'Le code Avis n\'est pas correct');
    }
}

function afficheMessage(id, msg){
    // On affiche le message
    document.getElementById(id).innerHTML = msg;
    document.getElementById(id).style.display = "block";


// On l'efface 8 secondes plus tard
    setTimeout(function() {
        document.getElementById(id).innerHTML = "";
        document.getElementById(id).style.display = "none";
    },5000);
}

function ratingStarMouseOver(n){
    for(let i = 0 ; i <= n ; i++){
        document.getElementById('formRatingStar'+i).className='glyphicon glyphicon-star';
        document.getElementById('note').value = n+1;
    }
    for (let i = n+1 ; i <= 5 ; i++){
        document.getElementById('formRatingStar'+i).className='glyphicon glyphicon-star-empty';
    }
    document.getElementById('note').value = n;
}

