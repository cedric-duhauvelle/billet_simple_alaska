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

	public function searchChapters() {
		$resp = $this->_db->prepare('SELECT * FROM chapitre');

		$resp->execute();

		$responses = $resp->fetchAll();

		foreach ($responses as $response) {
			if ($response['id_chapitre']) {
				echo '<a id="titre_chapitre" href="connexion ' . $response['id_chapitre'] . '">' . $response['titre_chapitre'] . '</a></br>';
				echo '<p id="content_chapitre">' . $response['content_chapitre'] . '</p>';
			}
			
		}


	}
}