<?php
require_once '../modele/Comment.php';
require_once '../modele/private/adressDataBase.php';
var_dump($_SERVER);
var_dump($_POST);
var_dump($_GET);

$commentReport = new Comment($db);
$commentReport->reportComment($_POST['id']);