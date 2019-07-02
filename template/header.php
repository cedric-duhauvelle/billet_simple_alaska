<?php
require_once '../modele/Session.php';
function menuActive($page, $url) {
    if (strtolower($page) === strtolower($url)) {
        echo 'class="nav_items active"';
    } else {
        echo 'class="nav_items"';
    }
}
if (array_key_exists('url', $_GET)) {
    $getUrl = htmlspecialchars($_GET['url']);
} else {
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
        <title><?= $title; ?></title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <header>
            <h1 id="title">Billet simple pour l'Alaska</h1>
            <p id="author">Jean Forteroche</p>
            <img src="images/glacier.jpg" id="image_header" alt="glacier" />
            <nav id="connexion">
                <?php
                if (empty($_SESSION['name'])) {
                ?>
                <a class="header_connexion" href="connexion">Connexion</a>
                <?php
                } else {
                ?>
                <a class="header_connexion" href="profil"><i class="fa fa-user-circle" aria-hidden="true"></i> <?= ucwords($_SESSION['name']); ?></a>
                <?php
                }
                ?>    
            </nav>
            <div id="content_menu">
                <nav id="menu">
                    <a <?php menuActive($accueilHead, $getUrl); ?> href="accueil"><i class="fa fa-home" aria-hidden="true"></i><span class="nav_items_title">Accueil</span></a>
                    <a <?php menuActive($chaptersHead, $getUrl); ?> href="chapitres"><i class="fa fa-book" aria-hidden="true"></i><span class="nav_items_title">Chapitres</span></a>
                    <a <?php menuActive($contactHead, $getUrl); ?> href="contact"><i class="fa fa-envelope" aria-hidden="true"></i><span class="nav_items_title">Contact</span></a>
                    <a <?php menuActive($commentHead, $getUrl); ?> href="commentaires"><i class="fa fa-comment" aria-hidden="true"></i><span class="nav_items_title">Commentaires</a>
                    <?php
                    if (array_key_exists('admin', $_SESSION)) {
                    ?>
                    <a <?php menuActive($adminHead, $getUrl); ?> href="administrateur"><i class="fa fa-cog" aria-hidden="true"></i><span class="nav_items_title">Administrateur</span></a>
                    <?php
                    }                    
                    ?>
                </nav>
            </div>
        </header>