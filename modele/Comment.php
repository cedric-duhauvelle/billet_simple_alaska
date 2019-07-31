<?php

require_once 'CommentReports.php';
require_once 'Chapters.php';
require_once 'Session.php';
require_once 'DataRecover.php';
require_once 'User.php';

class Comment extends DataRecover
{

    //Ajoute commentaire a la base de donnes
    public function add($name, $comment, $chapter)
    {
        $req = $this->_db->prepare('INSERT INTO comments(user, content, chapter) VALUES (:user, :comment, :chapter)');
        $req->bindValue(':user', $name);
        $req->bindValue(':comment', $comment);
        $req->bindValue(':chapter', $chapter);
        $req->execute();
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
    public function displayCommentChapter($id) {
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

    //Efface un commentaire
    public function deleteComment($id)
    {
        $del = $this->_db->prepare('DELETE FROM comments WHERE id=:id LIMIT 1');
        $del->bindValue(':id', $id);
        $delSucces = $del->execute();
    }
}