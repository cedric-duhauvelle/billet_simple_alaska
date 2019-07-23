<?php

require_once '../modele/Comment.php';
require_once '../modele/CommentReports.php';
require_once '../modele/Router.php';

$router = new Router($this->_db);
$postClean = $router->cleanArray($_POST);

$deleteReports = new CommentReports($this->_db);
$deleteComment = new Comment($this->_db);
if (array_key_exists('idReports', $_POST)) {
	//Efface le signalement
	$deleteReports->deleteReports($postClean['idReports']);
} elseif (array_key_exists('idComment', $_POST)) {
	//Efface le signalement et le commentaire
	$deleteComment->deleteComment($postClean['idComment']);
	$deleteReports->deleteReports($postClean['idComment']);
}

//Redirection
header('location: administrateur');