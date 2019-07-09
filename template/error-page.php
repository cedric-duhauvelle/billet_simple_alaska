<?php
$title = 'Page erreur';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <meta property="og:title" content="Billet simple pour l'Alaska" />
        <meta property="og:description" content="Blog de Jean Forteroche sur son nouveau livre" />
        <title><?= $title; ?></title>
        <script src="https://kit.fontawesome.com/71336045e0.js"></script>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
    <header>
        <h1 id="title"><a href="accueil">Billet simple pour l'Alaska</a></h1>
        <p id="author">Jean Forteroche</p>
        <img src="images/glacier.jpg" id="image_header" alt="glacier" />
    </header>
	<div id="content">
		<div id="error_page_content">
			<h2 class="error_message">Page introuvable !!</h2>
            <a href="accueil">Retour à l'accueil</a>
		</div>
	</div>

<?php include("footer.php"); ?>