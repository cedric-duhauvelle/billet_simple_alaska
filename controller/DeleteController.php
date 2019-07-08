<?php
require_once '../modele/Comment.php';
require_once '../modele/CommentReports.php';

$deleteReports = new CommentReports($this->_db);
$deleteComment = new Comment($this->_db);
if (array_key_exists('idReports', $_POST)) {
	//Efface le signalement
	$deleteReports->deleteReports(filter_var($_POST['idReports'], FILTER_SANITIZE_STRING));
} elseif (array_key_exists('idComment', $_POST)) {
	//Efface le signalement et le commentaire
	$deleteComment->deleteComment(filter_var($_POST['idComment'], FILTER_SANITIZE_STRING));
	$deleteReports->deleteReports(filter_var($_POST['idComment'], FILTER_SANITIZE_STRING));
}

//Redirection
header('location: administrateur');