<?php
use RedBeanPHP\R as R;

require "vendor/autoload.php";

// Connexion à la base de données
R::setup(
    "mysql:host=127.0.0.1;dbname=test",
    "root",
    ""
);

//Liste des données
$data = [
    ["Guinness", 4, "Ireland"],
    ["Kilkenny", 5, "Ireland"],
    ["Belhaven", 6, "Scotland"],
    ["Kriek", 8, "Belgian"]
];

R::wipe("beers");

foreach ($data as $beerData){
    $beer = R::dispense("beers");
    $beer->name = $beerData[0];
    $beer->strength = $beerData[1];
    $beer->origin = $beerData[2];

    R::store($beer);
}


$beer = R::dispense("beers");
$beer->name = "Pelforth";
$beer->strength = 6;
$beer->origin = "French";

R::store($beer);

$sculptures = R::findAll("sculptures");
var_dump($sculptures);


