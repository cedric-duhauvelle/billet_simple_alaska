<?php
require_once '../modele/Session.php';
require_once '../modele/CommentReports.php';
require_once '../modele/private/adressDataBase.php';

//Ajout Signalement 
$commentReport = new CommentReports($db);
$commentReport->reportComment($_POST['id'], $_SESSION['name']);

//Redirection vers la page precedente
$route = explode('/',$_SERVER['HTTP_REFERER']);
header('Location: ' . $route[8]);