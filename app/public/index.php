<?php

die("test");

use DI\Container;
use M2i\monProjet\Model\PublisherDAO;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Factory\AppFactory;
use M2i\monProjet\Controller\PublisherController;

define("ROOT_PATH", dirname(__DIR__));

require ROOT_PATH . "/vendor/autoload.php";

//Création du conteneur de dépendances
$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();


$container->set("pdo", function (){
    //Définition de la connexion
    $pdo = new \PDO("mysql:host=127.0.0.1;dbname=bibliotheque",
        "root", "", [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    return $pdo;
});

$container->set("dao.publisher", function () use ($container){
    //Instanciation du DAO
    $publisherDAO = new PublisherDAO($container->get("pdo"));
    return $publisherDAO;
});



$app->get("/hello/{name}", function (RequestInterface $request, ResponseInterface $response, $args){
    $name =  $args["name"];
    $response->getBody()->write("Hello $name");
    return $response;
});

$app->get("/publisher/{id}", PublisherController::class. ":showOne");

$app->get("/publishers", PublisherController::class. ":showAll");

$app->delete("/publisher/{id}", PublisherController::class. ":deleteOne");

$app->run();
