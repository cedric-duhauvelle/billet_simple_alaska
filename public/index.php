<?php

require_once '../modele/private/adressDataBase.php';
require_once '../modele/Router.php';
require_once '../modele/Session.php';

//Gestion des erreurs
set_exception_handler('exception');

function exception($e) {
    new CustomException($e);
}

$session = new Session();
$router = new Router($db);

$getClean = $router->cleanArray($_GET);

if(is_array($getClean) && array_key_exists('url', $getClean))  {
	$router->setUrl($getClean['url']);
} else {
	header('Location: accueil');
}

//require_once '../controller/ViewController.php';
