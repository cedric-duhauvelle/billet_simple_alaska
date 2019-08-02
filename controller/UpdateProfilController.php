<?php

namespace controller;

use modele\DataRecover;
use modele\DataUpdate;
use modele\Router;
use modele\Session;

class UpdateProfilController
{
	public function __construct($db)
	{
		$this->update($db);
	}

	public function update($db)
	{
		$router = new Router($this->_db);
		$update = new DataUpdate($this->_db);
		$check = new DataRecover($this->_db);
		$session = new Session();

		$postClean = $router->cleanArray($_POST);


		if (array_key_exists('updateName', $_POST)) {
			//Modifie le nom utilisateur
			if ($check->recover('users', 'name', $postClean['updateName'], 'name') === null) {
				$update->name($_SESSION['id_user'], $postClean['updateName']);
				header('Location: profil');
			} else {
				$session->addSession('errorName', 'Nom déjà utilisé!!');
				header('Location: update-profil');
			}
		} elseif (array_key_exists('updateEmail', $_POST)) {
			//Modifie email utilisateur
			if ($check->recover('users', 'email', $postClean['updateEmail'], 'email') === null) {
				$update->email($_SESSION['id_user'], $postClean['updateEmail']);
				header('Location: profil');
			} else {
				$session->addSession('errorEmail', 'Email déjà utilisé!!');
				header('Location: update-profil');
			}	
		} elseif (array_key_exists('updatePassword', $_POST)) {
			//Modifie password utilisateur
			if ($postClean['updatePassword'] === $postClean['updatePasswordCheck']) {
				$password = password_hash($postClean['updatePassword'], PASSWORD_DEFAULT);
				$update->password($_SESSION['id_user'], $password);
				header('Location: profil');
			} else {
				$session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques!!');
				header('Location: update-profil');
			}	
		}
	}
}