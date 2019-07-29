<?php

//Detruit la session en cours
$_SESSION = array();
session_destroy();

//Redirection page
require_once '../view/accueil.php';