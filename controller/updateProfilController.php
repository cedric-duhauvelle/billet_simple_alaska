<?php
require_once '../modele/User.php';
require_once '../modele/private/adressDataBase.php';
var_dump($_POST);
$updateUser = new User($db);
if (array_key_exists('updateName', $_POST)) {
	$updateUser->checkNameUpdate($_SESSION['id_user'], htmlspecialchars($_POST['updateName']));

} elseif (array_key_exists('updateEmail', $_POST)) {
	$updateUser->checkEmailUpdate($_SESSION['id_user'], htmlspecialchars($_POST['updateEmail']));

} elseif (array_key_exists('updatePassword', $_POST)) {
	$updateUser->updatePassword($_SESSION['id_user'], htmlspecialchars($_POST['updatePassword']), htmlspecialchars($_POST['updatePasswordCheck']));
}

