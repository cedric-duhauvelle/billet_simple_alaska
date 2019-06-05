<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/DataRecover.php';
require_once '../modele/User.php';
require_once '../modele/Session.php';

$dataCall = new DataRecover($db);
$dataCall->dataCheck(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']));



