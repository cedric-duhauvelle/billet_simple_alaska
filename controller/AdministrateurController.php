<?php

require_once '../modele/Chapters.php';
require_once '../modele/Router.php';
require_once '../modele/DataInsert.php';
require_once '../modele/DataUpdate.php';
require_once '../modele/DataDelete.php';

$router =  new Router($this->_db);
$insert = new DataInsert($this->_db);
$update = new DataUpdate($this->_db);
$delete = new DataDelete($this->_db);

$postClean = $router->cleanArray($_POST);


$urlChapter = explode('/', $_SERVER['HTTP_REFERER']);
$idChapter = explode('=', $urlChapter[$router->checkServer()]);

if (array_key_exists(1, $idChapter)) {
	if (array_key_exists('buttonDelete', $postClean)) {
		//Supprime un chapitre (Admin)
		$delete->chapter($idChapter[1]);
	} elseif (array_key_exists('buttonSave', $postClean)) {
		//update chapitre (Admin)
		$update->chapter($idChapter[1], $postClean['title'], $postClean['chapter']);
	}
} elseif (array_key_exists('buttonSave', $postClean)) {
	//Ajout de chapitre (Admin)
	$insert->chapter($postClean['title'], $postClean['chapter']);
}

//Redirection page
header('Location: administrateur');