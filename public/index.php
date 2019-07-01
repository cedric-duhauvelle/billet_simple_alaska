<?php
require '../modele/Router.php';

$url = 'accueil';
if(array_key_exists('url', $_GET)) {
    $url = htmlspecialchars($_GET['url']);
}

//Appel du routeur
$router = new Router();
$router->setUrl($url);
