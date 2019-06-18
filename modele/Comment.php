<?php
require_once 'Session.php';
require_once 'Data.php';

class Comment extends Data{

	public function displayFormComment() {
		echo '<form class="content_form_comment" method="POST" action="commentController">';
		echo '<imput type="text" name="comment" class="content_comment" placeholder="Commentaires..." />';
		echo '<imput type="submit" name="saveComment" class="save_comment" />';
		echo '</form>';
	}

	public function add($name, $comment, $chapter) {
		$req = $this->_db->prepare('INSERT INTO commentaires(user_commentaire, content_commentaire, chapitre_commentaire, date_commentaire) VALUES (:user, :commentaire, :chapitre, CURDATE())');
		$req->bindValue(':user', $name);
		$req->bindValue(':commentaire', $comment);
		$req->bindValue(':chapitre', $chapter);
		$req->execute();
	}

	public function display() {
		$resp = $this->_db->prepare('SELECT * FROM commentaires');
		$resp->execute();
		$responses = $resp->fetchAll();

		foreach ($responses as $response) {
			if ($response) {

				echo '<div class="display_comment_content">';
				echo '<p>Publié le ' . $response['date_commentaire'] . '</p>';
				echo '<p>Par ' . $response['user_commentaire'] . '</p>';
				echo '<p>' . $response['content_commentaire'] . '</p>';
				echo '</div>';
			}
		}
	}

	public function displayCommentChapter() {
		$respComment = $this->_db->prepare('SELECT * FROM commentaires');
		$respComment->execute();
		$responsesComment = $respComment->fetchAll();

		foreach ($responsesComment as $responseComment) {
			if ($responseComment['chapitre_commentaire'] === $_GET['url']) {
				echo '<div class="display_comment_content">';
				echo '<p>Publié le ' . $responseComment['date_commentaire'] . '</p>';
				echo '<p>Par ' . $responseComment['user_commentaire'] . '</p>';
				echo '<p>' . $responseComment['content_commentaire'] . '</p>';
				echo '</div>';
			}
		}
	}
}