<?php

namespace modele;

use modele\Comment;

class CommentManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb($db)
    {
        return $this->_db = $db;
    }

    public function getComment()
    {
        $comments = [];
        $q = $this->_db->query('SELECT * FROM comments');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment($data);
            $comments[] = $comment->display();
        }

        return $comments;
    }

    public function getCommentChapter($id)
    {
        $id = (int) $id;
        $comments = [];
        $q = $this->_db->query('SELECT * FROM comments WHERE chapter = '. $id);
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comment = new Comment($data);
            $comments[] = $comment->display();
        }

        return $comments;
    }
}