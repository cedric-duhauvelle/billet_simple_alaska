<?php

namespace Controller;

use Controller\AdministrateurController;
use Controller\ConnexionController;
use Controller\CommentController;
use Controller\CommentReportsController;
use Controller\DeconnexionController;
use Controller\DeleteController;
use Controller\InscriptionController;
use Controller\UpdateProfilController;

class Controller
{
	public function __construct($page, $db)
	{
		$this->callController($page, $db);
	}

	//Appel controller
	public function callController($page, $db)
	{
		$class = 'Controller\\' . $page;
		new $class($db);
		if ('DeconnexionController' === $page) {
			return new $class();
		}
	}
}