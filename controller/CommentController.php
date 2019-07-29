<?php

require_once '../modele/Comment.php';


//Recupere la page precedente
$chapter = explode('/', $_SERVER['HTTP_REFERER']);
$idChapter = explode('=', $chapter[$router->checkServer()]);
//Ajout commentaire dans la base de données
$comment = new Comment($db);
$comment->add($_SESSION['id_user'], $postClean['comment'], $idChapter[1]);

//Redirection
header('location: chapitre?id=' . $idChapter[1]);