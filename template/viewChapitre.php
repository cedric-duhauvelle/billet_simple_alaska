<?php

require_once '../modele/Chapters.php';
require_once '../modele/Comment.php';
require_once '../modele/private/adressDataBase.php';

$chapter = new Chapters($db);
$comment = new Comment($db);
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
    <div>
    	<?php
    	$comment->displayCommentChapter();
    	?>
    </div>
	<div id="content_form_comment">
		<form action="commentController" method="POST" id="form_comment">
			<label class="comment_content" for="comment" placeholder="Commentaires...">
				<p>Laisser un commentaire</p>
				<textarea id="comment_content" name="comment">
					
				</textarea>
			</label>
			<input type="submit" name="buttonSave" value="Envoyez" id="save_comment" />
		</form>
	</div>    
</div>
<?php include("footer.php"); ?>