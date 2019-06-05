<?php
require_once '../modele/private/adressDataBase.php';
require_once '../modele/Chapters.php';
$title = "Chapitres";
include("header.php");
?>
<div id="content">
    <div id="content_book">
    	<?php 
    	$chapters = new Chapters($db);
    	$chapters->searchChapters();
    	?>

    </div>
</div>
<?php include("footer.php"); ?>