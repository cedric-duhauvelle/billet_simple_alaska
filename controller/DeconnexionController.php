<?php

//Detruit la session en cours
$_SESSION = array();
session_destroy();

//Redirection page
header('Location: accueil');