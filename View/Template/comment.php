
<div class="display_comment_content">
    <p>Publié le <?=  $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1']  ?></p>
    <a href="chapitre?id=<?= $response['chapter'] ?>" class="comment_title_link"><?= $chapter->displayTitle($response['chapter']) ?></a>
    <p>Par <?= $name->displayName($response['user']) ?></p>
    <p class="display_comment_details"><?= $response['content'] ?></p>
    <?php if (!empty($_SESSION['name']))
    {
    ?>
        <form action="CommentReportsController" method="post">
        <label for="name"></label>
        <input type="text" name="id" class="reports_comment" value="<?= $response['id'] ?>" />
        <input type="submit" class="button_report_comment" value="Signalez" alt="signalez" />
        </form>
    <?php
    }
    echo $report->checkReport($response['id']);
    ?>
</div>
