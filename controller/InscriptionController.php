<?php

require_once '../modele/DataRecover.php';
require_once '../modele/User.php';
require_once '../modele/Router.php';

$router = new Router($this->_db);
$postClean = $router->cleanPost();

//Ajoute un utilisateur a la base de donnees
$user = new User($this->_db);
$user->addUser($postClean['pseudoInscription'], $postClean['emailInscription'], $postClean['passwordInscription'], $postClean['confirmationPasswordInscription']); 
