<?php

namespace Manager;

use Model\Comment;

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
        return $this->_db = $db;
    }

    //Retourne les commentaires
    public function getComments()
    {
        $comments = [];
        $q = $this->_db->query('SELECT * FROM comments');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment($data);
            $comments[] = $comment->display($this->_db);
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
            $comment = new Comment($data);
            $comments[] = $comment->display($this->_db);
        }

        return $comments;
    }

    //Retourne le contenu d'un commentaire
    public function getComment($id)
    {
        $id = (int) $id;
        $comments = [];
        $q = $this->_db->query('SELECT * FROM comments WHERE id = '. $id);
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comment = new Comment($data);
            $comments[] = $comment->getContent();
        }

        return $comments;
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

}