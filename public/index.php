<?php
require_once '../modele/private/adressDataBase.php';
require '../modele/Router.php';

$url = 'accueil';
if(array_key_exists('url', $_GET)) {
    $url = htmlspecialchars($_GET['url']);
}

set_exception_handler('exception');
function exception($e)
{
    $errorController = new CustomException($e);
}
//Appel du routeur
$router = new Router($db);
$router->setUrl($url);
