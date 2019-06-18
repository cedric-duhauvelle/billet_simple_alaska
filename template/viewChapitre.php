<?php
require_once '../modele/Chapters.php';
require_once '../modele/private/adressDataBase.php';

$chapter = new Chapters($db);
$title = "Chapitre";
include("header.php");
?>

<div id="content">
	<h2 id="title_Chapters" class="title_section">Chapitre</h2>
    <div id="content_book">
    	<?php 
    	
    	$chapter->recoverChapter($_GET);
    	?>
    </div>
</div>
<?php include("footer.php"); ?>