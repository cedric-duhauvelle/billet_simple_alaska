<div id="content">
    <h2 class="title_section">Chapitres</h2>
    <div id="content_book">
        <?php
        foreach ($chapters as $chapter) {
	    	if ($chapter) {
	    		include 'Template/chapterAbstract.php';
	    	}
	    }
	    ?>
    </div>
</div>