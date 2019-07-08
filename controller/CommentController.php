<?php
require_once '../modele/Session.php';
require_once '../modele/Comment.php';

//Recupere la page precedente
$chapter = explode('/', $_SERVER['HTTP_REFERER']);
$idChapter = explode('=', $chapter[8]);
//Ajout commentaire dans la base de données
$comment = new Comment($this->_db);
$comment->add($_SESSION['id_user'], filter_var($_POST['comment'], FILTER_SANITIZE_STRING), $idChapter[1]);

//Redirection
header('location: chapitre?id=' . $idChapter[1]);