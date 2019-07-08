<?php
require_once '../modele/DataRecover.php';
require_once '../modele/Session.php';

//Verifie et recupere un utilisateur a la base de donnees
$dataCall = new DataRecover($this->_db);
$dataCall->connectUser(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']));