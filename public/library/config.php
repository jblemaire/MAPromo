<?php

define('HOST', 'localhost');
define('DB_NAME', 'mapromo');
define('USER', 'root');
define('PASS', '');

function getDB(){
    $bdd = false;
    try{
        $bdd = new PDO(
            'mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8',
            USER,
            PASS
        );
    }catch(Exception $e){
        var_dump($e);
    }
    return $bdd;
}

function p($data=null){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function d($data= null){
    p($data);
    die();
}

//Transforme une date YYYY-MM-DD au format DD/MM/YYYY
function getDateFr($date_eng){
    $date_fr = new DateTime($date_eng);
    echo $date_fr->format('d/m/Y H:i:s');
}