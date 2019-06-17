<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/Chapters.php';
$title = "Chapitres";
include("header.php");
?>

<div id="content">
	<h2 id="title_Chapters" class="title_section">Chapitres</h2>
    <div id="content_book">
    	<?php 
    	$chapters = new Chapters($db);
    	$chapters->displayChapters();
    	?>
    </div>
</div>
<?php include("footer.php"); ?>