<?php
include_once '../modele/DataRecover.php';
require_once '../modele/User.php';
require_once '../modele/private/adressDataBase.php';

//Ajoute un utilisateur a la base de donnees
$user = new User($db);
$user->addUser(htmlspecialchars($_POST['pseudoInscription']), htmlspecialchars($_POST['emailInscription']), htmlspecialchars($_POST['passwordInscription']), htmlspecialchars($_POST['confirmationPasswordInscription'])); 
