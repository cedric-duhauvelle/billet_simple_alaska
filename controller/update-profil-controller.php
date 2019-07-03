<?php
require_once '../modele/User.php';
require_once '../modele/private/adressDataBase.php';
$updateUser = new User($db);
if (array_key_exists('updateName', $_POST)) {
	$updateUser->checkUpdateName($_SESSION['id_user'], htmlspecialchars($_POST['updateName']));

} elseif (array_key_exists('updateEmail', $_POST)) {
	$updateUser->checkEmailUpdate($_SESSION['id_user'], htmlspecialchars($_POST['updateEmail']));

} elseif (array_key_exists('updatePassword', $_POST)) {
	$updateUser->checkPasswordUpdate($_SESSION['id_user'], htmlspecialchars($_POST['updatePassword']), htmlspecialchars($_POST['updatePasswordCheck']));
}

