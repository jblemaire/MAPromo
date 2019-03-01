<?php

use Faker\Generator as Faker;

$factory->define(App\Magasin::class, function (Faker $faker) {
    $type = App\Type::inRandomOrder()->value('idType');
    $categorie = App\Categorie::inRandomOrder()->where('idType',$type)->value('idCategorie');
    $ville = App\Ville::inRandomOrder()->value('codeINSEEVille');
    $latitudeVille = App\Ville::where('codeINSEEVille', $ville)->value('latVille');
    $longitudeVille = App\Ville::where('codeINSEEVille', $ville)->value('longVille');

    return [
        'nomMagasin' => $faker->company,
        'adresse1Magasin' => $faker->buildingNumber,
        'adresse2Magasin' => $faker->streetName,
        'longMagasin' => $faker->longitude($min = $longitudeVille-0.05, $max = $longitudeVille+0.05),
        'latMagasin' => $faker->latitude($min = $latitudeVille-0.01, $max = $latitudeVille+0.01),
        'mailMagasin' => $faker->unique()->companyEmail,
        'telMagasin' => $faker->phoneNumber,
        'siretMagasin' => $faker->swiftBicNumber,
        'codeINSEEVille' => $ville,
        'idResponsable' => App\User::inRandomOrder()->where('idRole',3)->value('idUser'),
        'idType' => $type,
        'idCategorie' => $categorie
    ];
});

