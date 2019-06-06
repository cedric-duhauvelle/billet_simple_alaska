<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/Chapters.php';
$title = "Chapitres";
include("header.php");
?>
<h1 id="title_Chapters">Chapitres</h1>
<div id="content">
    <div id="content_book">
    	<?php 
    	$chapters = new Chapters($db);
    	$chapters->displayChapters();
    	?>

    </div>
</div>
<?php include("footer.php"); ?>