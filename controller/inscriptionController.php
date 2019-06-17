<?php
include_once '../modele/DataRecover.php';
require_once '../modele/User.php';
require_once '../modele/private/adressDataBase.php';

$user = new User();
$user->setPseudo(htmlspecialchars($_POST['pseudoInscription']));
$user->setEmail(htmlspecialchars($_POST['emailInscription']));
$user->setPassword(htmlspecialchars($_POST['passwordInscription']), htmlspecialchars($_POST['confirmationPasswordInscription']));
$user->addDb($db);

var_dump($user);


