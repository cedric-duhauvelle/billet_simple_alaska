<?php
include_once '../modele/class/DataRecover.php';
require_once '../modele/class/User.php';
require_once '../modele/private/adressDataBase.php';



$user = new User();
$user->setPseudo($_POST['pseudoInscription']);
$user->setEmail($_POST['emailInscription']);

$user->setPassword($_POST['passwordInscription'], $_POST['confirmationPasswordInscription']);

$user->addDb($db);

header('Location: ../public/profil');
exit();
