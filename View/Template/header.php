<?php

use Model\Router;

$router = new Router($db);
$getClean = $router->cleanArray($_GET);
$postClean = $router->cleanArray($_POST);

function menuActive($page, $url)
{
    if (strtolower($page) === strtolower($url))
    {
        echo 'class="nav_items active"';
    }
    else
    {
        echo 'class="nav_items"';
    }
}
if (array_key_exists('url', $getClean))
{
    $getUrl = $getClean['url'];
}
else
{
    $getUrl = 'accueil';
}
$accueilHead = 'accueil';
$chaptersHead = 'chapitres';
$commentHead = 'commentaires';
$contactHead = 'contact';
$adminHead = 'administrateur';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <meta property="og:title" content="Billet simple pour l'Alaska" />
        <meta property="og:description" content="Blog de Jean Forteroche sur son nouveau livre" />
        <title><?= ucwords($getClean['url']); ?></title>
        <script src="https://kit.fontawesome.com/71336045e0.js"></script>
        <script src="https://cdn.tiny.cloud/1/cdl5yejcddutvpia84eb19urvhaz2da2k91f5wqn3t1ezwgw/tinymce/5/tinymce.min.js"></script>
        <script>tinymce.init({mode:'specific_textareas', editor_selector: 'wysiwyg'});</script>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <header>
            <h1 id="title"><a href="accueil">Billet simple pour l'Alaska</a></h1>
            <p id="author">Jean Forteroche</p>
            <img src="images/glacier.jpg" id="image_header" alt="glacier" />
            <nav id="connexion">
            <?php if (empty($_SESSION['name'])): ?>
            <a class="header_connexion" href="connexion">Connexion</a>
            <?php else: ?>
            <a class="header_connexion" href="profil"><span class="fa fa-user-circle" aria-hidden="true"></span> <?= ucwords($_SESSION['name']); ?></a>
            <?php endif; ?>   
            </nav>
            <div id="content_menu">
                <nav id="menu">
                    <a <?php menuActive($accueilHead, $getUrl); ?> href="accueil"><span class="fa fa-home" aria-hidden="true"></span><strong class="nav_items_title">Accueil</strong></a>
                    <a <?php menuActive($chaptersHead, $getUrl); ?> href="chapitres"><span class="fa fa-book" aria-hidden="true"></span><strong class="nav_items_title">Chapitres</strong></a>
                    <a <?php menuActive($contactHead, $getUrl); ?> href="contact"><span class="fa fa-envelope" aria-hidden="true"></span><strong class="nav_items_title">Contact</strong></a>
                    <a <?php menuActive($commentHead, $getUrl); ?> href="commentaires"><span class="fa fa-comment" aria-hidden="true"></span><strong class="nav_items_title">Commentaires</strong></a>
                <?php
                if (array_key_exists('admin', $_SESSION)) {
                ?>
                <a <?php menuActive($adminHead, $getUrl); ?> href="administrateur"><span class="fa fa-cog" aria-hidden="true"></span><strong class="nav_items_title">Administrateur</strong></a>
                <?php
                }                    
                ?>
                </nav>
            </div>
        </header>