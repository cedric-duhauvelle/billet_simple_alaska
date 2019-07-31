<?php

require_once '../modele/DataUpdate.php';
require_once '../modele/DataRecover.php';
require_once '../modele/Router.php';
require_once '../modele/Session.php';

$router = new Router($this->_db);
$update = new DataUpdate($this->_db);
$check = new DataRecover($this->_db);
$session = new Session();

$postClean = $router->cleanArray($_POST);


if (array_key_exists('updateName', $_POST))
{
	//Modifie le nom utilisateur
	if ($check->recover('users', 'name', $postClean['updateName'], 'name') === null)
	{
		$update->name($_SESSION['id_user'], $postClean['updateName']);
		header('Location: profil');
	}
	else
	{
		$session->addSession('errorName', 'Nom déjà utilisé!!');
		header('Location: update-profil');
	}
}
elseif (array_key_exists('updateEmail', $_POST))
{
	//Modifie email utilisateur
	if ($check->recover('users', 'email', $postClean['updateEmail'], 'email') === null)
	{
		$update->email($_SESSION['id_user'], $postClean['updateEmail']);
		header('Location: profil');
	}
	else
	{
		$session->addSession('errorEmail', 'Email déjà utilisé!!');
		header('Location: update-profil');
	}	
}
elseif (array_key_exists('updatePassword', $_POST))
{
	//Modifie password utilisateur
	if ($postClean['updatePassword'] === $postClean['updatePasswordCheck'])
	{
		$password = password_hash($postClean['updatePassword'], PASSWORD_DEFAULT);
		$update->password($_SESSION['id_user'], $password);
		header('Location: profil');
	}
	else
	{
		$session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques!!');
		header('Location: update-profil');
	}	
}