<?php

require_once '../Modele/Comment.php';

$comment = new Comment($this->_db);
$title = "Commentaires";
?>
<div id="content">
	<h2 class="title_section">Commentaires</h2>
    <div id="content_book">
        <?php
        $comment->display();
        ?>
    </div>
</div>