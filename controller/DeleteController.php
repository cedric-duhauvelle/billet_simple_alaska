<?php

namespace controller;

use modele\DataDelete;
use modele\Router;

class DeleteController
{
	public function __construct($db)
	{
		$this->delete($db);
	}

	public function delete($db)
	{
		$router = new Router($db);
		$postClean = $router->cleanArray($_POST);

		$delete = new DataDelete($db);

		if (array_key_exists('idReports', $postClean))
		{
			//Efface le signalement
			$delete->report($postClean['idReports']);
		}
		elseif (array_key_exists('idComment', $postClean))
		{
			//Efface le signalement et le commentaire
			$delete->comment($postClean['idComment']);
			$delete->report($postClean['idComment']);
		}

		//Redirection page
		header('Location: administrateur');
	}
}