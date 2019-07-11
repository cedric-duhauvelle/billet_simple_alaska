<?php
require_once '../modele/User.php';

$updateUser = new User($this->_db);
if (array_key_exists('updateName', $_POST)) {
	//Modifie le nom utilisateur
	$updateUser->checkUpdateName($_SESSION['id_user'], filter_var($_POST['updateName'], FILTER_SANITIZE_STRING));

} elseif (array_key_exists('updateEmail', $_POST)) {
	//Modifie email utilisateur
	$updateUser->checkEmailUpdate($_SESSION['id_user'], filter_var($_POST['updateEmail'], FILTER_SANITIZE_STRING));

} elseif (array_key_exists('updatePassword', $_POST)) {
	//Modifie password utilisateur
	$updateUser->checkPasswordUpdate($_SESSION['id_user'], filter_var($_POST['updatePassword'], FILTER_SANITIZE_STRING), filter_var($_POST['updatePasswordCheck'], FILTER_SANITIZE_STRING));
}