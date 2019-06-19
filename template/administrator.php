<?php 
$title = "Administrateur";
require_once '../modele/DataRecover.php';
require_once '../modele/private/adressDataBase.php';

if(!$_SESSION['admin']) {
    header('location: acceuil');
}

include("header.php");
?>
<div id="content_admin">
    <div id="content_form_admin">
        <form action="adminController" method="POST">
            <label class="chapitre_admin" for="title">
                <p>Titre chapitre</p>
                <input id="chapitre_titre" type="text" name="title" />
            </label>
            <label class="chapitre_admin" for="chapter">
                <p>Contenu chapitre</p>
                <textarea id="chapitre_content" name="chapter">
                    
                </textarea>
            </label>
            <input type="submit" name="buttonSave" value="Enregistrer" id="save_chapitre_admin" />
        </form>
    </div>    
</div>

<?php include("footer.php"); ?>