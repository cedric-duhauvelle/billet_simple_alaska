<?php 
$title = "Administrateur";
require_once '../modele/Chapters.php';
require_once '../modele/DataRecover.php';
require_once '../modele/CommentReports.php';
if(!array_key_exists('admin', $_SESSION)) {
    header('location: accueil');
}
include("header.php");
$chapter = new Chapters($this->_db);
$reportComment = new CommentReports($this->_db);
?>
<div id="content_admin">

    <div id="content_chapter_admin">
    <?php $chapter->linkDisplayChapterAdmin(); ?>  
    </div>

    <div id="content_form_admin">
        <form action="AdministrateurController" method="POST">

            <label class="chapter_admin" for="title">Titre chapitre</label>

            <input id="chapter_titre" type="text" name="title" placeholder="Titre" <?php if (array_key_exists('id', $_GET)) {echo 'value="' . $chapter->displayTitle($_GET['id']) . '"';} ?> />

            <label class="chapter_admin" for="chapter">Contenu chapitre</label>

            <textarea id="chapter_content" name="chapter" placeholder="Ecrivez ici ..."><?php if (array_key_exists('id', $_GET)){echo $chapter->displayContent($_GET['id']);} ?></textarea>

            <div id="Content_button_chapter_admin">

                <input type="submit" name="buttonSave" value="Enregistrer" id="save_chapter_admin" />

                <?php if (array_key_exists('id', $_GET)): ?>
                <input type="submit" name="buttonDelete" value="Effacer" id="delete_chapter_admin" />
                <?php endif; ?>

            </div>
        </form>
    </div>    
</div>
<div id="content_admin_comment">
    <?php $reportComment->checkReports(); ?>
</div>
<?php include("footer.php"); ?>