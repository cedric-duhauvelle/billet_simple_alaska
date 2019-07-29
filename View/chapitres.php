<?php require_once '../modele/Chapters.php'; ?>

<div id="content">
    <h2 class="title_section">Chapitres</h2>
    <div id="content_book">
        <?php 
        $chapters = new Chapters($db);
        $chapters->displayChapters();
        ?>
    </div>
</div>