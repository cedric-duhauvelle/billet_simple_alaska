<?php

require_once 'CommentReports.php';
require_once 'Chapters.php';
require_once 'Session.php';
require_once 'DataRecover.php';
require_once 'User.php';

class Comment extends DataRecover
{

    //Affiche les commentaires
    public function display()
    {
        $report = new CommentReports($this->_db);
        $chapter = new Chapters($this->_db);
        $name = new User($this->_db);
        $this->callDisplay('comments');
        foreach ($this->_responses as $response)
        {
            if ($response)
            {
                $date = explode(' ', $response['published']);
                $dateFr = explode('-', $date[0]);
                require '../View/Template/comment.php';
            }
        }
    }

    //Affiche les commentaires associés au chapitre 
    public function displayCommentChapter($id)
    {
        $this->callDisplay('comments');
        $name = new User($this->_db);
        $report = new CommentReports($this->_db);
        foreach ($this->_responses as $response)
        {
            if ($response['chapter'] === $id)
            {
                $date = explode(' ', $response['published']);
                $dateFr = explode('-', $date[0]);
                require '../View/Template/commentChapter.php';               
            }
        }
    }
}