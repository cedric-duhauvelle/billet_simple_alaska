<?php

class Chapters{

	private $_title;
	private $_chapter;
	private $_db;
	private $_responses;

	public function __construct($db) {
		$this->setDb($db);
	}

	public function setDb($db) {
		return $this->_db = $db;
	}

	public function setChapter($text) {
		return $this->_chapter = $text;
	}

	public function setTitle ($text) {
		return $this->_title = $text;
	}

	public function addChapter($title, $chapter) {
		$this->setTitle($title);
		$this->setChapter($chapter);
	}

	public function addChapterDb() {
		$req = $this->_db->prepare('INSERT INTO chapters(title_chapter, content_chapter, date_chapter) VALUES (:title, :chapter, CURDATE())');
		$req->bindValue(':title', $this->_title);
		$req->bindValue(':chapter', $this->_chapter);
		$req->execute();
	}

	private function searchData(){
		$resp = $this->_db->prepare('SELECT * FROM chapters');

		$resp->execute();

		$this->_responses = $resp->fetchAll();

		return $this->_responses;
	}

	public function displayChapters() {
		$this->searchData();
		foreach ($this->_responses as $response) {
			if ($response['id_chapter']) {
				echo '<div class="chapter">';
				echo '<h2><a class="title_chapter" href="chapter_' . $response['id_chapter'] . '">' . $response['title_chapter'] . '</a></h2>';
				echo '<p class="content_chapter">' . $response['content_chapter'] . '</p>';
				echo '</div>';
			}	
		}


	}
}