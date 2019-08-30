<?php

namespace Manager;

use PDO;
use Model\Comment;
use Manager\CommentReports;
use Manager\ChapterManager;
use Manager\UserManager;

class CommentManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    //SETTEUR
    public function setDb($db)
    {
        $this->_db = $db;
    }

    //Retourne les commentaires
    public function getComments()
    {
        $comments = [];
        $q = $this->_db->query('SELECT * FROM comments');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    //Retourne les commentaires lies a un chapitre
    public function getCommentChapter($id)
    {
        $id = (int) $id;
        $comments = [];
        $q = $this->_db->query('SELECT * FROM comments WHERE chapter = '. $id);
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }

        return $comments;
    }

    //Retourne le contenu d'un commentaire
    public function getComment($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM comments WHERE id = '. $id);
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
           return $comments = new Comment($data);
        }
    }

    //Efface un commentaire
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM comments WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    //Ajoute un commentaire a la base de donnees
    public function add($id, $comment, $idChapter)
    {
        $req = $this->_db->prepare('INSERT INTO comments(user, content, chapter) VALUES (:user, :comment, :chapter)');
        $req->bindValue(':user', $id);
        $req->bindValue(':comment', $comment);
        $req->bindValue(':chapter', $idChapter);
        $req->execute();
    }

    //Retourne une valeur de la base de donnees
    public function checkCommentData($id)
    {
        $id = (int) $id;
        $comments = [];
        $q = $this->_db->query('SELECT * FROM comments WHERE id = '. $id);
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comment = new Comment($data);
            return $comment->getChapter();
        }
    }
}