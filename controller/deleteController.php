<?php
require_once '../modele/Comment.php';
require_once '../modele/CommentReports.php';
require_once '../modele/private/adressDataBase.php';

$deleteReports = new CommentReports($db);
$deleteComment = new Comment($db);
if (array_key_exists('idReports', $_POST)) {
	//Efface le signalement
	$deleteReports->deleteReports($_POST['idReports']);
} elseif (array_key_exists('idComment', $_POST)) {
	//Efface le signalement et le commentaire
	$deleteComment->deleteComment($_POST['idComment']);
	$deleteReports->deleteReports($_POST['idComment']);
}

//Redirection
header('location: administrateur');