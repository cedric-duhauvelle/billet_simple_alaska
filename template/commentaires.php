<?php 
require_once '../modele/Comment.php';

$comment = new Comment($this->_db);
$title = "Commentaires";
include("header.php"); 
?>
<div id="content">
	<h2 class="title_section">Commentaires</h2>
    <div id="content_book">
        <?php
        $comment->display();
        ?>
    </div>
</div>
<?php include("footer.php"); ?>