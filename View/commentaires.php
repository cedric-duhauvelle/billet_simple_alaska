<?php

require_once '../modele/Comment.php';

$comment = new Comment($db);
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