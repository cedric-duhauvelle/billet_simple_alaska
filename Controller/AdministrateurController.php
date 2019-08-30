<?php

namespace Controller;

use Manager\ChapterManager;
use Model\Router;

class AdministrateurController
{
	public function __construct($db)
	{
		$this->chapter($db);
	}

	//Gere ajout modification supression chapitre (Admin)
	public function chapter($db)
	{
		$router = new Router($db);
		$chapter = new ChapterManager($db);

		//Nettoye la variable '$_POST'
		$postClean = $router->cleanArray($_POST);

		//Recherche l'id dans l'url
		$urlChapter = explode('/', $_SERVER['HTTP_REFERER']);
		$idChapter = explode('=', $urlChapter[$router->checkServer()]);

		if (array_key_exists(1, $idChapter)) {
			if (array_key_exists('buttonDelete', $postClean)) {
				//Supprime un chapitre (Admin)
				$chapter->delete($idChapter[1]);
			} elseif (array_key_exists('buttonSave', $postClean)) {
				//update chapitre (Admin)
				$chapter->update($idChapter[1], $postClean['title'], $postClean['chapter']);
			}
		} elseif (array_key_exists('buttonSave', $postClean)) {
			//Ajout de chapitre (Admin)
			$chapter->add($postClean['title'], $postClean['chapter']);
		}
		//Redirection page
		header('Location: administrateur');
	}
}