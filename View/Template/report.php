<div class="content_admin_reports_comment">
    <div class="content_admin_reports_details">
        <p>Signalé le: <?= date_format(date_create($report->getReports()), 'd/m/Y à H:i:s'); ?>.</p>
        <p>Signalé par : <?= $user->getName(); ?></p>
        <p>Sur le chapitre : <?= $chapter->getTitle(); ?></p>
        <p class="content_admin_reports_comment_details"><?= $comment->getContent(); ?></p>
    </div>
    <div class="content_admin_reports_comment_button">
        <form action="DeleteController" method="post">
            <label for="idReports"></label>
            <input type="text " name="idReports" value="<?= $report->getId(); ?>" class="Content_admin_reports_comment_input_delete" />
            <label for="buttonDeleteReports">Effacer le signalement</label>
            <input type="submit" name="buttonDeleteReports" class="button_delete_reports" value="Effacer" />
        </form>
        <form action="DeleteController" method="post">
            <label for="idComment"></label>
            <input type="text " name="idComment" value="<?= $report->getId(); ?>" class="Content_admin_reports_comment_input_delete" />
            <label for="buttonDeleteComment">Effacer le commentaire</label>
            <input type="submit" name="buttonDeleteComment" class="button_delete_comment" value="Effacer" />
        </form>
    </div>
</div>