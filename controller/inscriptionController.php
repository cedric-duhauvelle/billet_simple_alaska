<?php
include_once '../modele/DataRecover.php';
require_once '../modele/User.php';
require_once '../modele/private/adressDataBase.php';

//Ajoute un utilisateur a la base de donnees
$user = new User($db);
//Verife et ajoute nom
$user->setPseudo(htmlspecialchars($_POST['pseudoInscription']));
//Verifie et ajoute email
$user->setEmail(htmlspecialchars($_POST['emailInscription']));
//Verifie et ajoute mot de passe 
$user->setPassword(htmlspecialchars($_POST['passwordInscription']), htmlspecialchars($_POST['confirmationPasswordInscription']));
$user->addDb(); 

//redirection
header('location: connexion'); 
