<?php

include('../config.php');

$bdd = getDB();
$query = $bdd->prepare("SELECT * FROM villes WHERE nomVille LIKE :nom ORDER BY popVille DESC LIMIT 10");
$query->bindValue('nom', $_POST['ville'].'%', PDO::PARAM_STR);
$query->execute();
$villes = array();
while ($ville = $query->fetch())
    array_push($villes, array("code_insee" => $ville["codeINSEEVille"],
        "nom_ville" => $ville["nomVille"],
        "cp_ville" => $ville["cpVille"],
        "longitude" => $ville["longVille"],
        "latitude" => $ville["latVille"],
        "departement" => $ville["idDepartement"]));
echo(json_encode($villes));
