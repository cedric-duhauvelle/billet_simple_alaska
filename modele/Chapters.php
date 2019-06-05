<?php

class Chapters{

	private $_title;
	private $_chapter;
	private $_db;

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

	public function changeTitle($text) {
		return $this->_title = '<h2>' . $text . '</h2>';
	}

	public function addChapterDb() {
		$req = $this->_db->prepare('INSERT INTO chapitre(titre_chapitre, content_chapitre, date_chapitre) VALUES (:titre, :chapitre, CURDATE())');
		$req->bindValue(':titre', $this->_title);
		$req->bindValue(':chapitre', $this->_chapter);
		$req->execute();
	}

	 
}