<?php
require_once 'CommentReports.php';
require_once 'Session.php';
require_once 'Data.php';
require_once 'User.php';

class Comment extends Data{

    //Ajoute commentaire a la base de donnes
    public function add($name, $comment, $chapter) {
        $req = $this->_db->prepare('INSERT INTO comments(user, content, chapter) VALUES (:user, :comment, :chapter)');
        $req->bindValue(':user', $name);
        $req->bindValue(':comment', $comment);
        $req->bindValue(':chapter', $chapter);
        $req->execute();
    }

    //Affiche les commentaires
    public function display() {
        $this->callDisplay('comments');
        $name = new User($this->_db);
        foreach ($this->_responses as $response) {
            if ($response) {
                echo '<div class="display_comment_content">';
                echo '<p>Publié le ' . $response['published'] . '</p>';
                echo '<p>Par ' . $name->displayName($response['user']) . '</p>';
                echo '<p class="display_comment_details">' . $response['content'] . '</p>';
                if (!empty($_SESSION['name'])) {
                    echo '<form action="commentReportsController" method="post">';
                    echo '<label for="name">';
                    echo '<input type="text" name="id" class="reports_comment" value="' . $response['id'] . '" />';
                    echo '</label>';
                    echo '<input type="submit" class="button_report_comment" value="Signalez" />';
                    echo '</form>';
                }
                $report = new CommentReports($this->_db);
                echo $report->checkReport($response['id']);
                echo '</div>';
            }
        }
    }

    //Affiche les commentaires associés au chapitre 
    public function displayCommentChapter() {
        $this->callDisplay('comments');
        $name = new User($this->_db);
        foreach ($this->_responses as $response) {
            if ($response['chapter'] === $_GET['url']) {
                $date = explode(' ', $response['published']);
                $dateFr = explode('-', $date[0]);
                echo '<div class="display_comment_content">';
                echo '<p>Publié le ' .  $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1']  . '</p>';
                echo '<p>Par ' . $name->displayName($response['user']) . '</p>';
                echo '<p class="display_comment_details">' . $response['content'] . '</p>';
                if (!empty($_SESSION['name'])) {
                    echo '<form action="commentReportsController" method="post">';
                    echo '<label for="name">';
                    echo '<input type="text" name="id" class="reports_comment" value="' . $response['id'] . '" />';
                    echo '</label>';
                    echo '<input type="submit" class="button_report_comment" value="Signalez" />';
                    echo '</form>';
                }
                $report = new CommentReports($this->_db);
                echo $report->checkReport($response['id']);
                echo '</div>';
            }
        }
    }

    //Efface un commentaire
    public function deleteComment($id) {
        $del = $this->_db->prepare('DELETE FROM comments WHERE id=:id LIMIT 1');
        $del->bindValue(':id', $id);
        $delSucces = $del->execute();
    }
}