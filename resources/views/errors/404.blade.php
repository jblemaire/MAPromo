<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>
<body>
<div id="app">
    <div style="display: flex; flex-direction: row; align-items: center">
        <div id="map" style="width:50%; height:100%;">
            <script>
                L.mapbox.accessToken = 'pk.eyJ1IjoibmFuaWUzMyIsImEiOiJjanNvc3ZjZmMwcTdzNDVsanJwbXFxOGF6In0.APE2fly8QeEl8YNvA53CWQ';
                map = L.map('map');
                osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
                osmAttrib='Map data © OpenStreetMap contributors';
                osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
                map.setView([25.0, -71.0], 5).addLayer(osm);
                L.mapbox.styleLayer('mapbox://styles/nanie33/cjsosw5k31cxf1fl3wdth7qs4').addTo(map);
                L.polygon([
                    [25.775278, -80.208889],
                    [18.406389, -66.063889],
                    [32.3, -64.783333]
                ]).addTo(map);
            </script>
        </div>
        <div style="width:50%; height:100%; display: flex; flex-direction: column; justify-content: center; align-items: center">
            <h1 style="font-size: 100px">404</h1>
            <h2>Vous pouvez observer ici le fameux Triangle des Bermudes.</h2>
            <h4>Mais vu que c'est dangereux, vous feriez mieux de partir !</h4>
            <button><a href="{{url('/')}}">Retourner à l'accueil</a></button>
        </div>
    </div>
</div>
