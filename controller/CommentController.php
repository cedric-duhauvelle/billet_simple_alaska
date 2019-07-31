<?php

require_once '../modele/DataInsert.php';
require_once '../modele/Router.php';

$router =  new Router($this->_db);
$postClean = $router->cleanArray($_POST);

//Recupere la page precedente
$chapter = explode('/', $_SERVER['HTTP_REFERER']);
$idChapter = explode('=', $chapter[$router->checkServer()]);
//Ajout commentaire dans la base de données
$comment = new DataInsert($this->_db);
$comment->comment($_SESSION['id_user'], $postClean['comment'], $idChapter[1]);

//Redirection
header('location: chapitre?id=' . $idChapter[1]);