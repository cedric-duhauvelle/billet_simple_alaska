<?php

require_once '../modele/class/DataRecover.php';
require_once '../modele/class/User.php';
require_once '../modele/private/adressDataBase.php';
require_once '../modele/class/Session.php';

$dataCall = new DataRecover($db);
$dataCall->dataCheck(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']));



header('Location: ../public/profil');
exit();
