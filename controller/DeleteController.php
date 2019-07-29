<?php

require_once '../modele/Comment.php';
require_once '../modele/CommentReports.php';

$deleteReports = new CommentReports($db);
$deleteComment = new Comment($db);
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