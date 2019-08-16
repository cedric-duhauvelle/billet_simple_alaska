<div class="content_admin_reports_comment">
    <div class="content_admin_reports_details">
        <p>Signalé le: <?= $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1']; ?>.</p>
        <p>Signalé par : <?= $name; ?></p>
        <p>Sur le chapitre : <?= $title; ?></p>
        <p class="content_admin_reports_comment_details"><?= $content[0]; ?></p>
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