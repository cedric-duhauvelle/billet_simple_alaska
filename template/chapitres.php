<?php
require_once '../Modele/Chapters.php';

$title = "Chapitres";
include("header.php");
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
<?php include("footer.php"); ?>