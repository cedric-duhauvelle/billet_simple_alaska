<div id="content_admin">
    <div id="content_chapter_admin">
        <a href="administrateur">Nouveau Chapitre</a>
        <?php $chapter->getLinkChaptersAdmin(); ?>  
    </div>
    <div id="content_form_admin">
        <form action="AdministrateurController" method="POST">
            <label class="chapter_admin" for="chapter_titre">Titre chapitre</label>
            <input id="chapter_titre" type="text" name="title" placeholder="Titre" value="<?= $title; ?>" />
            <?php  ?> 
            <div id="container_chapter">
                <label class="chapter_admin" for="chapter_content">Contenu chapitre</label>
                <textarea id="chapter_content" class="wysiwyg" name="chapter" placeholder="Ecrivez ici ..." alt="contenu chapitre" cols="">
                    <?= $content; ?>
                    
                </textarea>
            </div>
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