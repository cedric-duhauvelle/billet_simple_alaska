<?php 
$title = "Administrateur";
require_once '../modele/Chapters.php';
require_once '../modele/DataRecover.php';
require_once '../modele/CommentReports.php';
require_once '../modele/private/adressDataBase.php';

if(!$_SESSION['admin']) {
    header('location: accueil');
}

$chapter = new Chapters($db);
if (array_key_exists('id', $_GET)) {
    $id = htmlspecialchars($_GET['id']);
    if ($chapter->returnId($id)) {

        include("header.php");
?>
<div id="content_admin">
    <div id="content_chapter_admin">
    <?php
    $chapter->linkDisplayChapter();
    ?>  
    </div>
    <div id="content_form_admin">
        <form action="administrateurController" method="POST">
            <label class="chapter_admin" for="title">Titre chapitre</label>
            <input id="chapter_titre" type="text" name="title" <?= 'value="' . $chapter->displayTitle($id) . '"'; ?> placeholder="Titre" />
            <label class="chapter_admin" for="chapter">Contenu chapitre</label>
            <textarea id="chapter_content" name="chapter" placeholder="Ecrivez ici ...">'<?= $chapter->displayContent($id); ?></textarea>
    <?php
        } else {
            throw new Exception("Chapitre introuvable", 404);   
        }
    } else {
        include("header.php");
    ?>
<div id="content_admin">
    <div id="content_chapter_admin">
    <?php
    $chapter->linkDisplayChapter();
    ?>  
    </div>
    <div id="content_form_admin">
        <form action="administrateurController" method="POST">
            <label class="chapter_admin" for="title">Titre chapitre</label>
            <input id="chapter_titre" type="text" name="title" placeholder="Titre" />
            <label class="chapter_admin" for="chapter">Contenu chapitre</label>
            <textarea id="chapter_content" name="chapter" placeholder="Ecrivez ici ..."></textarea>
<?php
}
?>

            <div id="Content_button_chapter_admin">
                <input type="submit" name="buttonSave" value="Enregistrer" id="save_chapter_admin" />
                <?php 
                if (array_key_exists('id_chapter', $_SESSION)) {
                ?>
                <input type="submit" name="buttonDelete" value="Effacer" id="delete_chapter_admin" />
                <?php           
                } 
                ?>
            </div>
        </form>
    </div>    
</div>
<div id="content_admin_comment">
    <?php
    $reportComment = new CommentReports($db);
    $reportComment->checkReports();
    ?>
</div>
<?php include("footer.php"); ?>