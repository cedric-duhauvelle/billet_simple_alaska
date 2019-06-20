<?php
require_once '../modele/Comment.php';
require_once '../modele/CommentReports.php';
require_once '../modele/private/adressDataBase.php';
var_dump($_POST);
$deleteReports = new CommentReports($db);
$deleteComment = new Comment($db);
if (array_key_exists('idReports', $_POST)) {
	
	$deleteReports->deleteReports($_POST['idReports']);
} elseif (array_key_exists('idComment', $_POST)) {
	
	$deleteComment->deleteComment($_POST['idComment']);
	$deleteReports->deleteReports($_POST['idComment']);
}
header('location: administrateur');