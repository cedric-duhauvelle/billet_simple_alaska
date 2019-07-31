<div class="display_comment_content_chapter">
    <p>Publié le <?=  $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1']  ?></p>
    <p>Par <?= $name->displayName($response['user']) ?></p>
    <p class="display_comment_details"><?= $response['content'] ?></p>
    <?php
    if (!empty($_SESSION['name'])) 
    {
    ?>
    <form action="CommentReportsController" method="post">
        <label for="name">
        <input type="text" name="id" class="reports_comment" value="<?= $response['id'] ?>" />
        </label>
        <input type="submit" class="button_report_comment" value="Signalez" />
    </form>
    <?php
    }
    echo $report->checkReport($response['id']);
    ?>
</div>