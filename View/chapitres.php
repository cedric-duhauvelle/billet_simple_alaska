<?php

require_once '../Modele/Chapters.php';

$title = "Chapitres";
?>
<div id="content">
    <h2 class="title_section">Chapitres</h2>
    <div id="content_book">
        <?php 
        $chapters = new Chapters($this->_db);
        $chapters->displayChapters();
        ?>
    </div>
</div>