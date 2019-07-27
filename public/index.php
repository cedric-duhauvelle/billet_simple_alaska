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

require_once '../Controller/ViewController.php';