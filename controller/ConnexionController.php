<?php
require_once '../Modele/DataRecover.php';
require_once '../Modele/Session.php';

//Verifie et recupere un utilisateur a la base de donnees
$dataCall = new DataRecover($this->_db);
$dataCall->connectUser(filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING), filter_var($_POST['password'], FILTER_SANITIZE_STRING));