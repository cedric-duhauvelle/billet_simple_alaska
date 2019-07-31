<?php

namespace modele;

use modele\CommentReports;
use modele\Chapters;
use modele\DataRecover;
use modele\User;

class Comment extends DataRecover
{
    public function __construct($db)
    {
        return $this->_db = $db;
    }
    
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