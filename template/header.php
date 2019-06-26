<?php
require_once '../modele/Session.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <title><?= $title; ?></title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <header>
            <h1 id="title">Billet simple pour l'Alaska</h1>
            <img src="images/glacier.jpg" id="image_header" alt="glacier" />
            <nav id="connexion">
                <?php 
                if (empty($_SESSION['name'])) {
                ?>
                    <a class="header_connexion" href="connexion">Connexion</a>
                <?php
                }else{
                ?>
                    <a class="header_connexion" href="profil"><?= ucwords($_SESSION['name']); ?></a>
                <?php
                }
                ?>    
            </nav>
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
        </header>