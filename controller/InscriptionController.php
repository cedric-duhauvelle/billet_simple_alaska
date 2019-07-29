<?php

require_once '../modele/DataRecover.php';
require_once '../modele/User.php';

$router = new Router($db);
$postClean = $router->cleanArray($_POST);

//Ajoute un utilisateur a la base de donnees
$user = new User($db);
$user->addUser($postClean['pseudoInscription'], $postClean['emailInscription'], $postClean['passwordInscription'], $postClean['confirmationPasswordInscription']); 
