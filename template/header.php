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
            <h1 id="titre">Billet simple pour l'Alaska</h1>
            <img src="images/image_header.jpg" id="image_header" alt="image header" />
            <nav id="connexion">
                <p>
                    <?php 
                    if (empty($_SESSION['name'])) {
                    ?>
                        <a class="header_connexion" href="connexion">Connexion</a> | <a class="header_connexion" href="inscription">Inscription</a>
                    <?php
                    }else{
                    ?>
                        <a class="header_connexion" href="profil"><?= $_SESSION['name']; ?></a>
                    <?php
                    }
                    ?>
                    
                </p>
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