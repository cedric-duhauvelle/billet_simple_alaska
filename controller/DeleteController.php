<?php

namespace controller;

use modele\CommentReportsManager;
use modele\CommentManager;
use modele\Router;

class DeleteController
{
	public function __construct($db)
	{
		$this->delete($db);
	}

	//Supprime un signalement ou un commentaire (Admin)
	public function delete($db)
	{
		$router = new Router($db);
		$postClean = $router->cleanArray($_POST);

		$report = new CommentReportsManager($db);
		$comment = new CommentManager($db);


		if (array_key_exists('idReports', $postClean)) {
			//Efface le signalement
			$report->delete($postClean['idReports']);
		} elseif (array_key_exists('idComment', $postClean)) {
			//Efface le signalement et le commentaire
			$comment->delete($postClean['idComment']);
			$report->delete($postClean['idComment']);
		}

		//Redirection page
		header('Location: administrateur');
	}
}