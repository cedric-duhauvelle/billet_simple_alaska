<?php

require_once '../modele/private/adressDataBase.php';
require_once '../modele/Router.php';
require_once '../modele/Session.php';


session_start();
//Gestion des erreurs
//set_exception_handler('exception');

function exception($e, $c)
{
    new CustomException($e, $c);
}

$session = new Session();
$router = new Router($db);

$getClean = $router->cleanArray($_GET);

if(is_array($getClean) && array_key_exists('url', $getClean))
{
	$router->setUrl($getClean['url']);
}
else
{
	header('Location: accueil');
}