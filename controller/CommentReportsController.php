<?php
require_once '../Modele/Session.php';
require_once '../Modele/CommentReports.php';

//Ajout Signalement 
$commentReport = new CommentReports($this->_db);
$commentReport->reportComment(htmlspecialchars($_POST['id']), $_SESSION['id_user']);

//Redirection vers la page precedente
$route = explode('/',$_SERVER['HTTP_REFERER']);
header('Location: ' . $route[8]);