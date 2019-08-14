<?php

namespace Controller;

use Manager\CommentReportsManager;
use Model\Router;

class CommentReportsController
{
	public function __construct($db)
	{
		$this->report($db);
	}

	//Ajoute un signalement a la base de donnees
	public function report($db)
	{
		$router = new Router($db);
		//Nettoye la variable '$_POST'
		$postClean = $router->cleanArray($_POST);

		//Ajout Signalement 
		$report = new CommentReportsManager($db);
		$report->add($postClean['id'], $_SESSION['id_user']);

		//Redirection vers la page precedente
		$route = explode('/',$_SERVER['HTTP_REFERER']);
		header('Location: ' . $route[$router->checkServer()]);
	}
}