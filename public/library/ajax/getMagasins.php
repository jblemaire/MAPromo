<?php

include('../config.php');

$bdd = getDB();

$NE = $_POST['NE'];
$SW = $_POST['SW'];
$NE = explode('|',$NE);
$SW= explode('|',$SW);

$query = $bdd->prepare("SELECT * FROM magasins NATURAL JOIN villes WHERE (longMagasin BETWEEN :SW_lng AND :NE_lng) AND (latMagasin BETWEEN :SW_lat AND :NE_lat)");
$query->bindParam(':NE_lng', $NE[1], PDO::PARAM_INT);
$query->bindParam(':NE_lat', $NE[0], PDO::PARAM_INT);
$query->bindParam(':SW_lng', $SW[1], PDO::PARAM_INT);
$query->bindParam(':SW_lat', $SW[0], PDO::PARAM_INT);
$query->execute();
$magasins = array();
while ($magasin = $query->fetch())
    array_push($magasins, array("id_mag" => $magasin["idMagasin"],
        "nom_mag" => $magasin["nomMagasin"],
        "longitude" => $magasin["longMagasin"],
        "latitude" => $magasin["latMagasin"],
        "adresse1" => $magasin["adresse1Magasin"],
        "adresse2" => $magasin["adresse2Magasin"],
        "cpVille" => $magasin["cpVille"],
        "nomVille" => $magasin["nomVille"]));
echo (json_encode($magasins));