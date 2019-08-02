<?php

namespace controller;

use modele\DataInsert;
use modele\Router;

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
		$insert = new DataInsert($db);
		$insert->comment($_SESSION['id_user'], $postClean['comment'], $idChapter[1]);

		//Redirection
		header('location: chapitre?id=' . $idChapter[1]);
	}
}