<?php
require_once '../Modele/Chapters.php';

$chapters = new Chapters($this->_db);
$urlChapter = explode('/', $_SERVER['HTTP_REFERER']);
$idChapter = explode('=', $urlChapter[8]);

if (array_key_exists(1, $idChapter)) {
	if (array_key_exists('buttonDelete', $_POST)) {
		$chapters->deleteChapter($idChapter[1]);
	} elseif (array_key_exists('buttonSave', $_POST)) {
		//update chapitre (Admin)
		$chapters->updateChapter($idChapter[1], filter_var($_POST['title'], FILTER_SANITIZE_STRING), filter_var($_POST['chapter'], FILTER_SANITIZE_STRING));
	}
} elseif (array_key_exists('buttonSave', $_POST)) {
	//Ajout de chapitre (Admin)
	$chapters->addChapter(filter_var($_POST['title'], FILTER_SANITIZE_STRING), filter_var($_POST['chapter'], FILTER_SANITIZE_STRING));
	$chapters->addChapterDb();
}

//redirection 
header('Location: administrateur');