<?php

namespace Manager;

use PDO;
use Model\Chapters;

class ChapterManager
{
    private $_db;

    public function __construct($db)
    {
        return $this->setDb($db);
    }

    //SETTER
    public function setDb($db)
    {
        $this->_db = $db;
    }

    //Retourne un chapitre
    public function getChapter($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM chapters WHERE id = '.$id);
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $chapter = new Chapters($data);

        return $chapter;
    }

    //Retourne les chapitres
    public function getChapters()
    {
        $chapters = [];
        $q = $this->_db->query('SELECT * FROM chapters');
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $chapters[] = new Chapters($data);
        }

        return $chapters;
    }

    //Retourne les 3 dernier chapitre paru
    public function getLastChapters()
    {
        $chapters = [];
        $q = $this->_db->query('SELECT * FROM chapters ORDER BY id DESC LIMIT 0,3');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
            $chapters[] = new Chapters($data);
        }

        return $chapters;
    }

    //Retourne une valeur de la base de donnees
    public function checkChapterData($champ, $search, $value)
    {
        $resp = $this->_db->prepare('SELECT * FROM chapters');
        $resp->execute();
        $responses = $resp->fetchAll();

        foreach ($responses as $response) {
            if ($response[$champ] === $search) {
                return $response[$value];
            }
        }
    }

    //Ajoute un chapitre
    public function add($title, $content)
    {
        $req = $this->_db->prepare('INSERT INTO chapters(title, content) VALUES (:title, :chapter)');
        $req->bindValue(':title', $title);
        $req->bindValue(':chapter', $content);
        $req->execute();
    }

    //Modifie un chapitre
    public function update($id, $title, $content)
    {
        $update = $this->_db->prepare('UPDATE chapters SET title=:title, content=:content WHERE id=:id');
        $update->bindValue(':title', $title);
        $update->bindValue(':content', $content);
        $update->bindValue(':id', $id);
        $update->execute();
    }

    //Efface un chapitre
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM chapters WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    //Retourne le titre d'un chapitre
    public function displayTitleAdmin($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM chapters WHERE id = '.$id);
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $chapter = new Chapters($data);
        return $chapter->getTitle();
    }

    //Retourne le contenu d'un chapitre
    public function displayContentAdmin($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM chapters WHERE id = '.$id);
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $chapter = new Chapters($data);
        return $content = $chapter->getContent();
    }
}