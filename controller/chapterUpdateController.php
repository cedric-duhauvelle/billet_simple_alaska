<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/Chapters.php';

//Recupere le chapitre pour modification
$chaptersUpdate = new Chapters($db);
$chaptersUpdate->returnChapter(htmlspecialchars($_GET['id']));
