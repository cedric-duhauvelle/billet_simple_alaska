<?php
require_once '../modele/Chapters.php';
require_once '../modele/Router.php';

$router = new Router($this->_db);
$postClean = $router->cleanPost();

$chapters = new Chapters($this->_db);
$urlChapter = explode('/', $_SERVER['HTTP_REFERER']);
$idChapter = explode('=', $urlChapter[$router->checkServer()]);

if (array_key_exists(1, $idChapter)) {
	if (array_key_exists('buttonDelete', $_POST)) {
		//Supprime un chapitre (Admin)
		$chapters->deleteChapter($idChapter[1]);
	} elseif (array_key_exists('buttonSave', $_POST)) {
		//update chapitre (Admin)
		$chapters->updateChapter($idChapter[1], $postClean['title'], $postClean['chapter']);
	}
} elseif (array_key_exists('buttonSave', $_POST)) {
	//Ajout de chapitre (Admin)
	$chapters->addChapter($postClean['title'], $postClean['chapter']);
	$chapters->addChapterDb();
}

//redirection 
header('Location: administrateur');