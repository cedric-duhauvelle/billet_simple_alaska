<?php
require_once 'User.php';
require_once 'Data.php';

class CommentReports extends Data {

    private $_id;
    private $_user;

    //Recherche dans la base de donnees et retourne $id $user
    public function checkReports() {
        $this->callDisplay('reporting');
        foreach ($this->_responses as $report) {
            if ($report['id_comment']) {
               $this->_id = $report['id_comment'];
               $this->_user = $report['id_user'];
               $this->displayReports($this->_id, $this->_user);
            }
        }
    }

    //Affiche les signalements et les boutons de gestion
    public function displayReports($id, $user) {
        $this->callDisplay('comments');
        $name = new User($this->_db);
        foreach ($this->_responses as $comment) {
            if ($comment['id'] == $id) {
                $date = explode(' ', $comment['published']);
                $dateFr = explode('-', $date[0]);
                echo '<div class="content_admin_reports_comment">';
                echo '<div class="content_admin_reports_details">';
                echo '<p>Signalé le: ' . $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1'] . '.</p>';
                echo '<p>Ecrit par : ' . $name->diplayName($comment['user']) . ' // Signalé par : ' . $name->diplayName($user) . '.</p>';
                echo '<p>Sur le ' . $comment['chapter'] . '</p>';
                echo '<p class="content_admin_reports_comment_details">' . $comment['content'] . '</p>';
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
        $req = $this->_db->prepare('INSERT INTO reporting(id_comment, id_user) VALUES (:id, :user)');
        $req->bindValue(':id', $id);
        $req->bindValue(':user', $name);
        $req->execute();   
    }

    //Efface un signalement
    public function deleteReports($id) {
        $del = $this->_db->prepare('DELETE FROM reporting WHERE id_comment=:id LIMIT 1');
        $del->bindValue(':id', $id);
        $delSucces = $del->execute();
    }
}