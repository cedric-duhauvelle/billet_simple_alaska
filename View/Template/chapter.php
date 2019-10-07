<?php
$date = date_create($chapter->getPublished());
?>
<div class="chapter">
	<h3><?= $chapter->getTitle() ?></h3><p><?= date_format($date, 'd/m/Y à H:i:s'); ?></p>
    <p class="content_text_chapter"><?= $chapter->getContent() ?></p>
</div>