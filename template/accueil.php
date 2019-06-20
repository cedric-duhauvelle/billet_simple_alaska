<?php 
require_once '../modele/Chapters.php';
require_once '../modele/private/adressDataBase.php';
$title = "Billet pour l'Alaska";
include("header.php");
?>
<div id="content">
    <h2 id="title_news" class="title_section">Nouveauté</h2>
    <div id="content_book">
    <?php 
    $chapter = new Chapters($db);
    $chapter->displayChaptersLast();
    ?>  
    </div>
</div>
<?php include("footer.php"); ?>