<?php

namespace Controller;

use Manager\UserManager;
use Model\Router;
use Model\Session;

class UpdateProfilController
{
	public function __construct($db)
	{
		$this->update($db);
	}

	//Modifie les informations utilisateur
	public function update($db)
	{
		$router = new Router($db);
		$user = new UserManager($db);
		$session = new Session();

		//Nettoye la variable '$_POST'
		$postClean = $router->cleanArray($_POST);

		if (array_key_exists('updateName', $_POST)) {
			//Modifie le nom utilisateur
			if ($user->checkUserData('name', $postClean['updateName'], 'name') === null) {
				$user->nameUpdate($_SESSION['id_user'], $postClean['updateName']);
				$session->addSession('name', $postClean['updateName']);
				return header('Location: profil');
			} else {
				$session->addSession('errorName', 'Nom déjà utilisé!!');
			}
		} elseif (array_key_exists('updateEmail', $_POST)) {
			//Modifie email utilisateur
			if ($user->checkUserData('email', $postClean['updateEmail'], 'email') === null) {
				$user->emailUpdate($_SESSION['id_user'], $postClean['updateEmail']);
				return header('Location: profil');
			} else {
				$session->addSession('errorEmail', 'Email déjà utilisé!!');
			}
		} elseif (array_key_exists('updatePassword', $_POST)) {
			//Modifie password utilisateur
			if ($postClean['updatePassword'] === $postClean['updatePasswordCheck']) {
				$password = password_hash($postClean['updatePassword'], PASSWORD_DEFAULT);
				$user->passwordUpdate($_SESSION['id_user'], $password);
				return header('Location: profil');
			} else {
				$session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques!!');
			}
		}
		header('Location: update-profil');
	}
}