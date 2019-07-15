<?php

require_once '../modele/private/adressDataBase.php';
require_once '../modele/Router.php';

//Appel du routeur
$router = new Router($db);
$getClean = $router->cleanGet();

$url = 'accueil';
if(array_key_exists('url', $_GET)) {    
    $url = $getClean['url'];
} else {
	header('Location: accueil');
}

//Gestion des erreurs
set_exception_handler('exception');

function exception($e) {
    $errorController = new CustomException($e);
}

$router->setUrl($url);
var_dump($router->checkServer());