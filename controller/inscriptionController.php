<?php

include_once '../modele/class/DataRecover.php';
require_once '../modele/class/User.php';
require_once '../modele/private/adressDataBase.php';

$user = new User();
$user->setPseudo(htmlspecialchars($_POST['pseudoInscription']));
$user->setEmail(htmlspecialchars($_POST['emailInscription']));
$user->setPassword(htmlspecialchars($_POST['passwordInscription']), htmlspecialchars($_POST['confirmationPasswordInscription']));
$user->addDb($db);
$user->addUserDb();

var_dump($user);
