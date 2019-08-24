<div class="chapter">
	<h3><a class="title_chapter" href="chapitre?id=<?= $chapter->getId(); ?>"><?= $chapter->getTitle(); ?></a></h3>
	<p><?= date_format(date_create($chapter->getPublished()), 'd/m/Y à H:i:s'); ?></p>
	<p class="content_text_chapter"><?= substr($chapter->getContent(), 0, 400); ?>...</p>
	<a class="after_chapter" href="chapitre?id=<?= $chapter->getId(); ?>">Lire la suite...</a>
</div>  