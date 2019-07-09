M<?php
require_once '../Modele/Session.php';
require_once '../Modele/Chapters.php';
require_once '../Modele/Comment.php';

$chapter = new Chapters($this->_db);
$comment = new Comment($this->_db);

$title = "Chapitre";
include("header.php");
?>
<div id="content">
    <h2 id="title_Chapters" class="title_section">Chapitre</h2>
    <div id="content_chapter">
        <div id="content_book">
            <?php 
            $chapter->recoverChapter(htmlspecialchars($_GET['id']));
            ?>
        </div>
        <div id="link_chapters">
            <h5>Chapitres</h5>
            <?php
            $chapter->linkDisplayChapter();
            ?>
        </div>
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
        <form action="CommentController" method="POST" id="form_comment">
            <label class="comment_content" for="comment">Laisser un commentaire</label>
            <textarea id="comment_content_print" name="comment" placeholder="Commentaires..." required></textarea>
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