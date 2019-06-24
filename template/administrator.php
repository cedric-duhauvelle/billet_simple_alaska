<?php 
$title = "Administrateur";
require_once '../modele/Chapters.php';
require_once '../modele/DataRecover.php';
require_once '../modele/CommentReports.php';
require_once '../modele/private/adressDataBase.php';

if(!$_SESSION['admin']) {
    header('location: acceuil');
}

include("header.php");
?>
<div id="content_admin">
    <div id="content_chapter_admin">
    <?php
    $chaptersUpdate = new Chapters($db);
    $chaptersUpdate->linkDisplayChapter();
    ?>  
    </div>
    <div id="content_form_admin">
        <form action="adminController" method="POST">
            <label class="chapitre_admin" for="title">Titre chapitre</label>
            <?php  
            if (array_key_exists('title', $_SESSION)) {
                echo '<input id="chapitre_titre" type="text" name="title" value="' . $_SESSION['title'] . '" placeholder="Titre" />';
                unset($_SESSION['title']);           
            } else {
                echo '<input id="chapitre_titre" type="text" name="title" placeholder="Titre" />';
                unset($_SESSION['id_chapter']); 
            } 
            ?>
            <label class="chapitre_admin" for="chapter">Contenu chapitre</label>
            <?php  
            if (array_key_exists('content', $_SESSION)) {
                echo '<textarea id="chapitre_content" name="chapter" placeholder="Ecrivez ici ...">' . $_SESSION['content'] . '</textarea>';
                unset($_SESSION['content']);           
            } else {
                echo '<textarea id="chapitre_content" name="chapter" placeholder="Ecrivez ici ..."></textarea>';
            } 
            ?>
            
            <input type="submit" name="buttonSave" value="Enregistrer" id="save_chapitre_admin" />
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