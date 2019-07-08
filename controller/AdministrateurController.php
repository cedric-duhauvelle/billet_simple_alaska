<?php
require_once '../modele/Chapters.php';

$chapters = new Chapters($this->_db);

$postClean = filter_var($_POST, FILTER_SANITIZE_STRING);
if (array_key_exists('id_chapter', $_SESSION)) {
	if (array_key_exists('buttonDelete', $postClean)) {
		$chapters->deleteChapter($_SESSION['id_chapter']);
		unset($_SESSION['id_chapter']);
	} elseif (array_key_exists('buttonSave', $postClean)) {
		//update chapitre (Admin)
		$chapters->updateChapter($_SESSION['id_chapter'], $postClean['title'], $postClean['chapter']);
		unset($_SESSION['id_chapter']);
	}
} elseif (array_key_exists('buttonSave', $postClean)) {
	//Ajout de chapitre (Admin)
	$chapters->addChapter($postClean['title'], $postClean['chapter']);
	$chapters->addChapterDb();
}





//Redirection de la page
