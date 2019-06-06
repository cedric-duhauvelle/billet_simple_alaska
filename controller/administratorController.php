<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/Chapters.php';
var_dump($_POST);

$chapters = new Chapters($db);
$chapters->addChapter(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['chapter']));
$chapters->addChapterDb();