<?php 

require_once '../Modele/Chapters.php';
require_once '../Modele/DataRecover.php';
require_once '../Modele/CommentReports.php';
require_once '../Modele/Router.php';

$router = new Router($this->_db);
$getClean = $router->cleanArray($_GET);


$title = "Administrateur";
if(!array_key_exists('admin', $_SESSION)) {
    header('location: accueil');
}
$chapter = new Chapters($this->_db);
$reportComment = new CommentReports($this->_db);
?>
<div id="content_admin">
    <div id="content_chapter_admin">
    <?php $chapter->linkDisplayChapterAdmin(); ?>  
    </div>
    <div id="content_form_admin">
        <form action="AdministrateurController" method="POST">
            <label class="chapter_admin" for="chapter_titre">Titre chapitre</label>
            <input id="chapter_titre" type="text" name="title" placeholder="Titre" <?php if (array_key_exists('id', $_GET)) {echo 'value="' . $chapter->displayTitle($getClean['id']) . '"';} ?> />
            <label class="chapter_admin" for="chapter_content">Contenu chapitre</label>
            <textarea id="chapter_content" name="chapter" placeholder="Ecrivez ici ..." alt="contenu chapitre"><?php if (array_key_exists('id', $_GET)){echo $chapter->displayContent($getClean['id']);} ?></textarea>
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