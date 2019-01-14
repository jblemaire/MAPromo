<?php

include('config.php');

$bdd = getDB();
$query = $bdd->prepare("SELECT * FROM magasin");
$query->execute();
$magasins = array();
while ($magasin = $query->fetch())
    array_push($magasins, array("id_mag" => $magasin["idMag"],
        "nom_mag" => $magasin["nomMag"],
        "longitude" => $magasin["longitudeMag"],
        "latitude" => $magasin["latitudeMag"]));
echo(json_encode($magasins));