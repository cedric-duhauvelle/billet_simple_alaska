<?php
require_once '../modele/Session.php';
require_once '../modele/Comment.php';
require_once '../modele/private/adressDataBase.php';

//Recupere la page precedente
$chapter = explode('/',$_SERVER['HTTP_REFERER']);

//Ajout commentaire dans la base de données
$comment = new Comment($db);
$comment->add($_SESSION['name'], htmlspecialchars($_POST['comment']), $chapter[8]);

//Redirection
header('location: ' . $chapter[8]);