<?php

require_once '../modele/Chapters.php';

$title = "Billet pour l'Alaska";
include("Template/header.php");
?>
<div id="content">
    <h2 class="title_section">Nouveauté</h2>
    <div id="content_book">
    <?php 
    $chapter = new Chapters($this->_db);
    $chapter->displayChaptersLast();
    ?>  
    </div>
</div>
<?php include("Template/footer.php"); ?>