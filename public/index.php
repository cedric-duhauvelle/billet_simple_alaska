<?php

require_once '../modele/private/adressDataBase.php';
use modele\Router;

session_start();

spl_autoload_register(function ($class) {
    $class = '../' . str_replace("\\", '/', $class) . '.php';
    if (is_file($class)) {
        require_once($class);
    } else {
        new Exception('Erreur interne de chargement');
    }
});

//Gestion des erreurs
set_exception_handler('exception');

function exception($e, $c)
{
    new CustomException($e, $c);
}

$router = new Router($db);

$getClean = $router->cleanArray($_GET);

if(is_array($getClean) && array_key_exists('url', $getClean))
{
	$router->route($getClean['url']);
}
else
{
	header('Location: accueil');
}