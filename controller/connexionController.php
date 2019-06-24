<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/DataRecover.php';
require_once '../modele/Session.php';

//Verifie et recupere un utilisateur a la base de donnees
$dataCall = new DataRecover($db);
$dataCall->nameCheck(htmlspecialchars($_POST['pseudo']));
$dataCall->passwordCheck(htmlspecialchars($_POST['password']));




