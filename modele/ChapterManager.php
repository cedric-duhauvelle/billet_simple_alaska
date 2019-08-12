<?php

namespace modele;

use modele\Chapters;

class ChapterManager 
{
    private $_db;
    
    public function __construct($db)
    {
        return $this->setDb($db);
    }

    public function setDb($db)
    {
        $this->_db = $db;
    }

    //retourne un chapitre
    public function getChapter($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM chapters WHERE id = '.$id); 
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $chapter = new Chapters($data);
        return $chapter->recoverChapter();      
    }

    //retourne les chapitres
    public function getChapters()
    {
        $chapters = [];
        $q = $this->_db->query('SELECT * FROM chapters');
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $chapter = new Chapters($data);
            $chapters[] = $chapter->displayChapters();
        }

        return $chapters;
    }

    //retourne les 3 dernier chapitre paru
    public function getLastChapters()
    {
        $chapters = [];
        $q = $this->_db->query('SELECT * FROM chapters ORDER BY id DESC LIMIT 0,3');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
            $chapter = new Chapters($data);
            $chapters[] = $chapter->displayChapters();
        }

        return $chapters;
    }

    public function getLinkChapters()
    {
        $chapters = [];
        $q = $this->_db->query('SELECT * FROM chapters');
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $chapter = new Chapters($data);
            $chapters[] = $chapter->linkDisplayChapter();
        }

        return $chapters;
    }

    public function getLinkChaptersAdmin()
    {
        $chapters = [];
        $q = $this->_db->query('SELECT * FROM chapters');
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $chapter = new Chapters($data);
            $chapters[] = $chapter->linkDisplayChapterAdmin();
        }

        return $chapters; 
    }

    public function add($title, $content)
    {
        $req = $this->_db->prepare('INSERT INTO chapters(title, content) VALUES (:title, :chapter)');
        $req->bindValue(':title', $title);
        $req->bindValue(':chapter', $content);
        $req->execute(); 
    }

    public function update($id, $title, $content)
    {
        $update = $this->_db->prepare('UPDATE chapters SET title=:title, content=:content WHERE id=:id');
        $update->bindValue(':title', $title);
        $update->bindValue(':content', $content);
        $update->bindValue(':id', $id);
        $update->execute();
    }

    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM chapters WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    public function displayTitleAdmin($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM chapters WHERE id = '.$id); 
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $chapter = new Chapters($data);
        return $chapter->getTitle();
    }

    public function displayContentAdmin($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM chapters WHERE id = '.$id); 
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $chapter = new Chapters($data);
        return $content = $chapter->getContent(); 
    }
}