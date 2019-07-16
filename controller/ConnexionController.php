<?php

require_once '../modele/DataRecover.php';
require_once '../modele/Session.php';
require_once '../modele/Router.php';

$router = new Router($this->_db);
$postClean = $router->cleanPost();

//Verifie et recupere un utilisateur a la base de donnees
$dataCall = new DataRecover($this->_db);
$dataCall->connectUser($postClean['pseudo'], $postClean['password']);