<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/Chapters.php';

$chapters = new Chapters($db);
if (array_key_exists('id_chapter', $_SESSION)) {
	//update chapitre (Admin)
	$chapters->updateChapter($_SESSION['id_chapter'], htmlspecialchars($_POST['title']), htmlspecialchars($_POST['chapter']));
	unset($_SESSION['id_chapter']);
} else {
	//Ajout de chapitre (Admin)
	$chapters->addChapter(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['chapter']));
	$chapters->addChapterDb();
}

//Redirection de la page
header('location: chapitres');