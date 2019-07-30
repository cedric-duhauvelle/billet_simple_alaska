<?php

require_once 'User.php';
require_once 'DataRecover.php';

class CommentReports extends DataRecover
{

    private $_id;
    private $_user;
    private $_responseReport;

    //Recherche dans la base de donnees et retourne $id $user
    public function checkReports()
    {
        $this->callDisplay('reporting');
        foreach ($this->_responses as $report)
        {
            if ($report['id_comment'])
            {
               $this->_id = $report['id_comment'];
               $this->_user = $report['id_user'];
               $this->displayReports($this->_id, $this->_user);
            }
        }
    }

    public function checkReport($id)
    {
        $this->callDisplay('reporting');
        foreach ($this->_responses as $report)
        {
            if($report['id_comment'] === $id)
            {
                return '<p class="comment_chapter_error error_message">Signalé <span class="fa fa-flag" aria-hidden="true"></span></p>';
            }
        }
    }

    //Affiche les signalements et les boutons de gestion
    public function displayReports($id, $user)
    {
        $this->callDisplay('comments');
        $name = new User($this->_db);
        $chapter = new Chapters($this->_db);
        foreach ($this->_responses as $comment)
        {
            if ($comment['id'] == $id)
            {
                $date = explode(' ', $comment['published']);
                $dateFr = explode('-', $date[0]);
                include("../View/Template/report.php");
            }  
        }
    }

    //Ajoute un report a la base de donnes
    public function reportComment($id, $name)
    {        
        $req = $this->_db->prepare('INSERT INTO reporting(id_comment, id_user) VALUES (:id, :user)');
        $req->bindValue(':id', $id);
        $req->bindValue(':user', $name);
        $req->execute();   
    }

    //Efface un signalement
    public function deleteReports($id)
    {
        $del = $this->_db->prepare('DELETE FROM reporting WHERE id_comment=:id LIMIT 1');
        $del->bindValue(':id', $id);
        $delSucces = $del->execute();
    }
}