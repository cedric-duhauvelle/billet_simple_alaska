<?php

namespace controller;

use modele\DataInsert;
use modele\Router;

class CommentReportsController
{
	public function __construct($db)
	{
		$this->report($db);
	}

	public function report($db)
	{
		$router = new Router($db);
		$postClean = $router->cleanArray($_POST);

		//Ajout Signalement 
		$insert = new DataInsert($db);
		$insert->report($postClean['id'], $_SESSION['id_user']);

		//Redirection vers la page precedente
		$route = explode('/',$_SERVER['HTTP_REFERER']);
		header('Location: ' . $route[$router->checkServer()]);
	}
}