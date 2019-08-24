<div id="content">
	<h2 class="title_section">Commentaires</h2>
    <div id="content_book">
        <?php
        foreach ($comments as $comment) {
        	include 'Template/comment.php';
        }
        ?>
    </div>
</div>