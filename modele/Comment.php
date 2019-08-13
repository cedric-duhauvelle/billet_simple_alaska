<?php

namespace modele;

use modele\CommentReports;
use modele\ChapterManager;
use modele\DataRecover;
use modele\User;

class Comment
{
    private $_id;
    private $_user;
    private $_content;
    private $_chapter;
    private $_published;

    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setUser($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_user = $id;
        }
    }

    public function setContent($content)
    {
        if (is_string($content)) {
            return $this->_content = $content;
        }
    }

    public function setChapter($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_chapter = $id;
        }
    }

    public function setPublished($date)
    {
        $this->_published = $date;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getChapter()
    {
        return $this->_chapter;
    }

    public function getPublished()
    {
        return $this->_published;
    }
    
    //Affiche les commentaires
    public function display($db)
    {
        $chapter = new ChapterManager($db);
        $date = explode(' ', $this->_published);
        $dateFr = explode('-', $date[0]);
        require '../View/Template/comment.php';
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}