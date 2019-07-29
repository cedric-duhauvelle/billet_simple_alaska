<?php

require_once '../modele/User.php';
require_once '../modele/Router.php';

$router = new Router($this->_db);
$postClean = $router->cleanArray($_POST);

$updateUser = new User($this->_db);
if (array_key_exists('updateName', $_POST)) {
	//Modifie le nom utilisateur
	$updateUser->checkUpdateName($_SESSION['id_user'], $postClean['updateName']);

} elseif (array_key_exists('updateEmail', $_POST)) {
	//Modifie email utilisateur
	$updateUser->checkEmailUpdate($_SESSION['id_user'], $postClean['updateEmail']);

} elseif (array_key_exists('updatePassword', $_POST)) {
	//Modifie password utilisateur
	$updateUser->checkPasswordUpdate($_SESSION['id_user'], $postClean['updatePassword'], $postClean['updatePasswordCheck']);
}

//Redirection page
header('Location: profil');