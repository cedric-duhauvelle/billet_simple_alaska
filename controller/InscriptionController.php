<?php
require_once '../Modele/DataRecover.php';
require_once '../Modele/User.php';

//Ajoute un utilisateur a la base de donnees
$user = new User($this->_db);
$user->addUser(filter_var($_POST['pseudoInscription'], FILTER_SANITIZE_STRING), filter_var($_POST['emailInscription'], FILTER_SANITIZE_STRING), filter_var($_POST['passwordInscription'], FILTER_SANITIZE_STRING), filter_var($_POST['confirmationPasswordInscription'], FILTER_SANITIZE_STRING)); 
