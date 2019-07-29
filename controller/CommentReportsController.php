<?php

require_once '../modele/CommentReports.php';

//Ajout Signalement 
$commentReport = new CommentReports($db);
$commentReport->reportComment($postClean['id'], $_SESSION['id_user']);

//Redirection vers la page precedente
$route = explode('/',$_SERVER['HTTP_REFERER']);
header('Location: ' . $route[$router->checkServer()]);