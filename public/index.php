<?php

require_once '../modele/private/adressDataBase.php';
require_once '../modele/Router.php';

//Gestion des erreurs
set_exception_handler('exception');

function exception($e) {
    new CustomException($e);
}

//Appel du routeur
$router = new Router($db);
$getClean = $router->cleanArray($_GET);

if(is_array($getClean) && array_key_exists('url', $getClean)) {
	$router->setUrl($getClean['url']);
} else {
	header('Location: accueil');
}

