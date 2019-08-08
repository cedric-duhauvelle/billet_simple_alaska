<?php

namespace controller;

use controller\AdministrateurController;
use controller\ConnexionController;
use controller\CommentController;
use controller\CommentReportsController;
use controller\DeconnexionController;
use controller\DeleteController;
use controller\InscriptionController;
use controller\UpdateProfilController;

class Controller
{
	public function __construct($page, $db)
	{
		$this->callController($page, $db);
	}

	//Appel controller
	public function callController($page, $db)
	{
		switch ($page) {
		    case 'AdministrateurController':
		        new AdministrateurController($db);
		        break;
		    case 'ConnexionController':
		        new ConnexionController($db);
		        break;
		    case 'CommentController':
		        new CommentController($db);
		        break;
		    case 'CommentReportsController':
		        new CommentReportsController($db);
		        break;
		    case 'DeconnexionController':
		    	new DeconnexionController();
		    	break;
		    case 'DeleteController':
		    	new DeleteController($db);
		    	break;
		    case 'InscriptionController':
		    	new InscriptionController($db);
		    	break;
		    case 'UpdateProfilController':
		    	new UpdateProfilController($db);
		    	break;
		}
	}
}