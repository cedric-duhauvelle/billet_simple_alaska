<?php

require_once '../modele/DataRecover.php';

//Verifie et recupere un utilisateur a la base de donnees
$dataCall = new DataRecover($db);
$dataCall->connectUser($postClean['pseudo'], $postClean['password']);