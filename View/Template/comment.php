<div class="display_comment_content">
    <p>Publié le <?=  $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1']  ?></p>
    <a href="chapitre?id=<?= $this->getChapter(); ?>" class="comment_title_link"><?= $title; ?></a>
    <p>Par <?= $name; ?></p>
    <p class="display_comment_details"><?= $this->getContent(); ?></p>
    <?php if (!empty($_SESSION['name']))
    {
    ?>
        <form action="CommentReportsController" method="post">
        <label for="name"></label>
        <input type="text" name="id" class="reports_comment" value="<?= $this->getId(); ?>" />
        <input type="submit" class="button_report_comment" value="Signalez" alt="signalez" />
        </form>
    <?php
    }
    echo $contentReport;
    ?>
</div>
