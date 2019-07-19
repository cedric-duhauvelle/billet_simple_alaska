<?php

require_once '../modele/Session.php';
require_once '../modele/CommentReports.php';
require_once '../modele/Router.php';

$router = new Router($this->_db);
$postClean = $router->cleanArray($_POST);

//Ajout Signalement 
$commentReport = new CommentReports($this->_db);
$commentReport->reportComment($postClean['id'], $_SESSION['id_user']);

//Redirection vers la page precedente
$route = explode('/',$_SERVER['HTTP_REFERER']);
header('Location: ' . $route[$router->checkServer()]);