<?php

namespace controller;

use modele\Chapters;
use modele\Router;
use modele\DataInsert;
use modele\DataUpdate;
use modele\DataDelete;

class AdministrateurController
{
	public function __construct($db)
	{
		$this->chapter($db);
	}
	
	public function chapter($db)
	{
		$router =  new Router($db);
		$insert = new DataInsert($db);
		$update = new DataUpdate($db);
		$delete = new DataDelete($db);

		$postClean = $router->cleanArray($_POST);


		$urlChapter = explode('/', $_SERVER['HTTP_REFERER']);
		$idChapter = explode('=', $urlChapter[$router->checkServer()]);

		if (array_key_exists(1, $idChapter))
		{
			if (array_key_exists('buttonDelete', $postClean))
			{
				//Supprime un chapitre (Admin)
				$delete->chapter($idChapter[1]);
			}
			elseif (array_key_exists('buttonSave', $postClean))
			{
				//update chapitre (Admin)
				$update->chapter($idChapter[1], $postClean['title'], $postClean['chapter']);
			}
		}
		elseif (array_key_exists('buttonSave', $postClean))
		{
			//Ajout de chapitre (Admin)
			$insert->chapter($postClean['title'], $postClean['chapter']);
		}
		//Redirection page
		header('Location: administrateur');
	}
}