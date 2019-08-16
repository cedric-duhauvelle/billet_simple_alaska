<?php

namespace Model;

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

    //SETTEUR
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

    //GETTEUR
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