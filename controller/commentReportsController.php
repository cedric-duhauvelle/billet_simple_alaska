<?php
require_once '../modele/Session.php';
require_once '../modele/CommentReports.php';
require_once '../modele/private/adressDataBase.php';
var_dump($_POST);
var_dump($_GET);
var_dump($_SESSION);

$commentReport = new CommentReports($db);
$commentReport->reportComment($_POST['id'], $_SESSION['name']);

$route = explode('/',$_SERVER['HTTP_REFERER']);
header('Location: ' . $route[8]);