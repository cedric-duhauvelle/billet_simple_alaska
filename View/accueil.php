<?php require_once '../modele/Chapters.php'; ?>

<div id="content">
    <h2 class="title_section">Nouveauté</h2>
    <div id="content_book">
    <?php 
    $chapter = new Chapters($db);
    $chapter->displayChaptersLast();
    ?>  
    </div>
</div>