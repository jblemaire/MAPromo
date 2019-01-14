<?php

include('config.php');

$bdd = getDB();
$query = $bdd->prepare("SELECT * FROM ville WHERE nomVille LIKE :nom ORDER BY populationVille DESC LIMIT 10");
$query->bindValue('nom', $_GET["ville"].'%', PDO::PARAM_STR);
$query->execute();
$villes = array();
while ($ville = $query->fetch())
    array_push($villes, array("code_insee" => $ville["codeInsee"],
        "nom_ville" => $ville["nomVille"],
        "cp_ville" => $ville["cpVille"],
        "longitude" => $ville["longitudeVille"],
        "latitude" => $ville["latitudeVille"],
        "departement" => $ville["numDep"]));
echo(json_encode($villes));
