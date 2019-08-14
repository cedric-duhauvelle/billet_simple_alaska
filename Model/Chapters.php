<?php

namespace Model;

class Chapters
{
    private $_id;
    private $_title;
    private $_content;
    private $_published;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->_title = $title;
        }
    }

    public function setContent($content)
    {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

    public function setPublished($date)
    {
        $this->_published = $date;
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

    public function getId()
    {
        return $this->_id;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getPublished()
    {
        return $this->_published;
    }

    //Affiche le resume d'un chapitre
    public function displayChapters()
    { 
        $date = explode(' ', $this->_published);
        $dateFr = explode('-', $date[0]);
        require '../View/Template/chapterAbstract.php';
    }

    //Affiche un chapitre
    public function recoverChapter()
    {
        $date = explode(' ', $this->getPublished());
        $dateFr = explode('-', $date[0]);
         require_once '../View/Template/chapter.php';      
    }

    //Affiche les liens des chapitres (admin)
    public function linkDisplayChapterAdmin()
    {
        echo '<p><a href="administrateur?id=' . $this->getId() . '">' . $this->getTitle() . '</a></p>';
    }

    //Affiche les liens des chapitres
    public function linkDisplayChapter()
    {
        echo '<p>- <a href="chapitre?id=' . $this->getId() . '">' . $this->getTitle() . '</a></p>';
    }

    //Retourne 'true' si id du chapitre existe
    public function checkId($id)
    {
        $this->callDisplay('chapters');
        foreach ($this->_responses as $response) {
            if ($id === $response['id']) {
                return true;
            } 
        }
        return false;
    }
}