<div class="display_comment_content">
    <p>Publié le <?=  date_format(date_create($comment->getPublished()), 'd/m/Y à H:i:s'); ?></p>
    <a href="chapitre?id=<?= $comment->getChapter(); ?>" class="comment_title_link"><?php //$chapter->getTitle($comment->getChapter()); ?></a>
    <p>Par <?= $userManager->getName($comment->getUser()); ?></p>
    <p class="display_comment_details"><?= $comment->getContent(); ?></p>
    <?php if (!empty($_SESSION['name']))
    {
    ?>
        <form action="CommentReportsController" method="post">
        <label for="name"></label>
        <input type="text" name="id" class="reports_comment" value="<?= $comment->getId(); ?>" />
        <input type="submit" class="button_report_comment" value="Signalez" alt="signalez" />
        </form>
    <?php
    }
    foreach ($reports as $report) {
        if ($report->getId() === $comment->getId()) {
    ?>
    <p class="comment_chapter_error error_message">Signalé <span class="fa fa-flag" aria-hidden="true"></span></p>
    <?php
        }
    }
    ?>
</div>
