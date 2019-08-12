<div id="content">
    <h2 id="title_Chapters" class="title_section">Chapitre</h2>
    <div id="content_chapter">
        <div id="content_book">
            <?php $chapter->getChapter($getClean['id']); ?>
        </div>
        <div id="link_chapters">
            <h3>Chapitres</h3>
            <?php $chapter->getLinkChapters(); ?>
        </div>
    </div>
    <div id="comment_content">
        <?php $comment->displayCommentChapter($_GET['id']); ?>
    </div>
    <?php
    var_dump($getClean);
    if (!empty($_SESSION['name'])) {
    ?>
    <div id="content_form_comment">
        <form action="CommentController" method="POST" id="form_comment">
            <label class="comment_content" for="comment_content_print">Laisser un commentaire</label>
            <textarea id="comment_content_print" name="comment" placeholder="Commentaires..." alt="commentaires" required></textarea>
            <input type="submit" name="buttonSave" value="Envoyez" id="save_comment" alt="enregistrer commentaires" />
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
