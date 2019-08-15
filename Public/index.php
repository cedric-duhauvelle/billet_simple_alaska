<?php

require_once '../Model/private/adressDataBase.php';
require_once '../Model/CustomException.php';

use Model\Router;

session_start();

//Charge les classe
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

function exception($e)
{
    new CustomException($e);
}

//Appelle du Router
$router = new Router($db);
//Nettoye la variable '$_GET'
$getClean = $router->cleanArray($_GET);
//Recherche la page
if(is_array($getClean) && array_key_exists('url', $getClean)) {
	$router->route($getClean['url']);
} else {
	header('Location: accueil');
}