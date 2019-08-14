<?php

namespace Controller;

use Manager\CommentManager;
use Model\Router;

class CommentController
{
	public function __construct($db)
	{
		$this->comment($db);
	}

	//Ajoute un commentaire a la base de donnees
	public function comment($db)
	{
		$router =  new Router($db);
		//Nettoye la variable '$_POST'
		$postClean = $router->cleanArray($_POST);

		//Recupere la page precedente
		$chapter = explode('/', $_SERVER['HTTP_REFERER']);
		$idChapter = explode('=', $chapter[$router->checkServer()]);

		//Ajout commentaire dans la base de données
		$comment = new CommentManager($db);
		$comment->add($_SESSION['id_user'], $postClean['comment'], $idChapter[1]);

		//Redirection
		header('location: chapitre?id=' . $idChapter[1]);
	}
}