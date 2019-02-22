<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>
<body>
<div id="app">
    <div class="container">
        <div id="map" style="width:500px; height:500px;">
            <script>
                map = L.map('map');
                osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
                osmAttrib='Map data © OpenStreetMap contributors';
                osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
                map.setView([25.0, -71.0], 5).addLayer(osm);
                L.polygon([
                    [25.775278, -80.208889],
                    [18.406389, -66.063889],
                    [32.3, -64.783333]
                ]).addTo(map);
            </script>
        </div>
    </div>
</div>
