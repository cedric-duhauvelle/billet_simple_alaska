<?php

require_once '../Modele/private/adressDataBase.php';
require_once '../Modele/Router.php';
require_once '../Modele/Session.php';

//Gestion des erreurs
set_exception_handler('exception');

function exception($e) {
    new CustomException($e);
}

$session = new Session();
$router = new Router($db);

require_once '../Controller/ViewController.php';