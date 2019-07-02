<?php
require_once '../modele/Session.php';
require_once '../modele/Chapters.php';
require_once '../modele/Comment.php';
require_once '../modele/private/adressDataBase.php';

$chapter = new Chapters($db);
$comment = new Comment($db);
if ($chapter->returnId(htmlspecialchars($_GET['id']))) {

$title = "Chapitre";
include("header.php");
?>
<div id="content">
    <h2 id="title_Chapters" class="title_section">Chapitre</h2>
    <div id="content_book">
        <?php 
        $chapter->recoverChapter(htmlspecialchars($_GET['id']));
        ?>
    </div>
    <div id="comment_content">
        <?php
        $comment->displayCommentChapter(htmlspecialchars($_GET['id']));
        ?>
    </div>
    <?php
    if (!empty($_SESSION['name'])) {
    ?>
    <div id="content_form_comment">
        <form action="commentController" method="POST" id="form_comment">
            <label class="comment_content" for="comment">Laisser un commentaire</label>
            <textarea id="comment_content_print" name="comment" placeholder="Commentaires..."></textarea>
            <input type="submit" name="buttonSave" value="Envoyez" id="save_comment" />
        </form>
    </div> 
    <?php
    } else {
    ?>
    <div id="connexion_inscription_chapter">
        <p>Pour laisser un commentaire</p>
        <p><a href="connexion">Connectez-vous</a> ou <a href="inscription">Inscrivez-vous</a></p>
    </div>
    <?php
    }
    ?>   
</div>
<?php 
include("footer.php"); 
} else {
    throw new Exception("Page introuvable", 404);   
}
?>