<?php
require_once '../modele/Session.php';
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
            <img src="images/image_header.jpg" id="image_header" alt="glacier" />
            <nav id="connexion">
                <?php 
                if (empty($_SESSION['name'])) {
                ?>
                <a class="header_connexion" href="connexion">Connexion</a>
                <?php
                } else {
                ?>
                <a class="header_connexion" href="profil"><?= ucwords($_SESSION['name']); ?></a>
                <?php
                }
                ?>    
            </nav>
            <div id="content_menu">
                <nav id="menu">
                    <a class="nav_items" href="accueil">Accueil</a>
                    <a class="nav_items" href="chapitres">Chapitres</a>
                    <a class="nav_items" href="commentaires">Commentaires</a>
                    <a class="nav_items" href="contact">Contact</a>
                    <?php
                    if (array_key_exists('admin', $_SESSION)) {
                    ?>
                    <a class="nav_items" href="administrateur">Administrateur</a>
                    <?php
                    }
                    ?>
                </nav>
            </div>
        </header>