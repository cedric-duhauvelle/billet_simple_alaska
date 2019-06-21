<?php
require_once 'Session.php';
require_once 'Data.php';

class Comment extends Data{

    //Ajoute commentaire a la base de donnes
    public function add($name, $comment, $chapter) {
        $req = $this->_db->prepare('INSERT INTO commentaires(user_commentaire, content_commentaire, chapitre_commentaire, date_commentaire) VALUES (:user, :commentaire, :chapitre, CURDATE())');
        $req->bindValue(':user', $name);
        $req->bindValue(':commentaire', $comment);
        $req->bindValue(':chapitre', $chapter);
        $req->execute();
    }

    //Affiche les commentaires
    public function display() {
        $this->callDisplay('commentaires');
        foreach ($this->_responses as $response) {
            if ($response) {
                echo '<div class="display_comment_content">';
                echo '<p>Publié le ' . $response['date_commentaire'] . '</p>';
                echo '<p>Par ' . $response['user_commentaire'] . '</p>';
                echo '<p class="display_comment_details">' . $response['content_commentaire'] . '</p>';
                if (!empty($_SESSION['name'])) {
                    echo '<form action="commentReportsController" method="post">';
                    echo '<label for="name">';
                    echo '<input type="text" name="id" class="reports_comment" value="' . $response['id_commentaire'] . '" />';
                    echo '</label>';
                    echo '<input type="submit" class="button_report_comment" value="Signalez" />';
                    echo '</form>';
                }
                echo '</div>';
            }
        }
    }

    //Affiche les commentaires associés au chapitre 
    public function displayCommentChapter() {
        $this->callDisplay('commentaires');
        foreach ($this->_responses as $response) {
            if ($response['chapitre_commentaire'] === $_GET['url']) {
                echo '<div class="display_comment_content">';
                echo '<p>Publié le ' . $response['date_commentaire'] . '</p>';
                echo '<p>Par ' . $response['user_commentaire'] . '</p>';
                echo '<p class="display_comment_details">' . $response['content_commentaire'] . '</p>';
                if (!empty($_SESSION['name'])) {
                    echo '<form action="commentReportsController" method="post">';
                    echo '<label for="name">';
                    echo '<input type="text" name="id" class="reports_comment" value="' . $response['id_commentaire'] . '" />';
                    echo '</label>';
                    echo '<input type="submit" class="button_report_comment" value="Signalez" />';
                    echo '</form>';
                }
                echo '</div>';
            }
        }
    }

    //Efface un commentaire
    public function deleteComment($id) {
        $del = $this->_db->prepare('DELETE FROM commentaires WHERE id_commentaire=:id LIMIT 1');
        $del->bindValue(':id', $id);
        $delSucces = $del->execute();
    }
}