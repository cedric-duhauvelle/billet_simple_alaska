<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/Chapters.php';

//Ajout de chapitre (Admin)
$chapters = new Chapters($db);
$chapters->addChapter(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['chapter']));
$chapters->addChapterDb();

//Redirection de la page
header('location: chapitres');