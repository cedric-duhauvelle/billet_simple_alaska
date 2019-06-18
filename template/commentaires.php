<?php 
require_once '../modele/Comment.php';
require_once '../modele/private/adressDataBase.php';
$comment = new Comment($db);
$title = "Commentaires";
include("header.php"); 
?>
<div id="content">
    <div id="content_book">
    	<?php
    	$comment->display();
    	?>
    </div>
</div>
<?php include("footer.php"); ?>