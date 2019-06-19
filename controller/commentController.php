<?php
require_once '../modele/Session.php';
require_once '../modele/Comment.php';
require_once '../modele/private/adressDataBase.php';
var_dump($_POST);
var_dump($_SESSION['name']);

$chapter = explode('/',$_SERVER['HTTP_REFERER']);
var_dump($chapter[8]);
$comment = new Comment($db);
$comment->add($_SESSION['name'], htmlspecialchars($_POST['comment']), $chapter[8]);

header('location: ' . $chapter[8]);