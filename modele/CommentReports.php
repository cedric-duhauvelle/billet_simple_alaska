<?php
require_once 'Data.php';

class CommentReports extends Data {

    private $_id;
    private $_user;

    //Recherche dans la base de donnees et retourne $id $user
    public function checkReports() {
        $this->callDisplay('comment_reporting');
        
        foreach ($this->_responses as $report) {
            if ($report['id_comment_reports']) {
               
               $this->_id = $report['id_comment_reports'];
               $this->_user = $report['user_comment_reports'];
               $this->displayReports($this->_id, $this->_user);
            }
        }
    }

    //Affiche les signalements et les boutons de gestion
    public function displayReports($id, $user) {
        $this->callDisplay('commentaires');
        foreach ($this->_responses as $comment) {
            if ($comment['id_commentaire'] == $id) {
                echo '<div class="content_admin_reports_comment">';
                echo '<div class="content_admin_reports_details">';
                echo '<p>Signalé le: ' . $comment['date_commentaire'] . '.</p>';
                echo '<p>Ecrit par : ' . $comment['user_commentaire'] . ' // Signalé par : ' . $user . '.</p>';
                echo '<p>Sur le ' . $comment['chapitre_commentaire'] . '</p>';
                echo '<p class="content_admin_reports_comment_details">' . $comment['content_commentaire'] . '</p>';
                echo '</div>';
                echo '<div class="content_admin_reports_comment_button">';
                //formulaire pour effacer le signalement
                echo '<form action="deleteController" method="post">';
                echo '<label for="idReports">';
                echo '<input type="text "" name="idReports" value="' . $id . '" class="Content_admin_reports_comment_input_delete" />';
                echo '</label>';
                echo '<label for="buttonDeleteReports">';
                echo '<p>Effacer le signalement</p>';
                echo '<input type="submit" name="buttonDeleteReports" class="button_delete_reports" value="Effacer" />';
                echo '</label>';
                echo '</form>';
                //formulaire pour effacer formulaire
                echo '<form action="deleteController" method="post">';
                echo '<label for="idComment">';
                echo '<input type="text " name="idComment" value="' . $id . '" class="Content_admin_reports_comment_input_delete" />';
                echo '</label>';
                echo '<label for="buttonDeleteComment">';
                echo '<p>Effacer le commentaire</p>';
                echo '<input type="submit" name="buttonDeleteComment" class="button_delete_comment" value="Effacer" />';
                echo '</label>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }  
        }
    }

    //Ajoute un report a la base de donnes
    public function reportComment($id, $name) {        
        $req = $this->_db->prepare('INSERT INTO comment_reporting(id_comment_reports, user_comment_reports, date_reporting) VALUES (:id, :user, CURDATE())');
        $req->bindValue(':id', $id);
        $req->bindValue(':user', $name);
        $req->execute();   
    }

    //Efface un signalement
    public function deleteReports($id) {
        $del = $this->_db->prepare('DELETE FROM comment_reporting WHERE id_comment_reports=:id LIMIT 1');
        $del->bindValue(':id', $id);
        $delSucces = $del->execute();
    }
}