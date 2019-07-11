<?php
require_once '../modele/private/adressDataBase.php';
require '../modele/Router.php';

if(array_key_exists('url', $_GET)) {
    $url = filter_var($_GET['url'], FILTER_SANITIZE_STRING);
} else {
	$url = 'accueil';
}  

//Gestion des erreurs
set_exception_handler('exception');
function exception($e)
{
    $errorController = new CustomException($e);
}

//Appel du routeur
$router = new Router($db);
$router->setUrl($url);
