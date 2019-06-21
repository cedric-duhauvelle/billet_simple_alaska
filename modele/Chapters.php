<?php

class Chapters {

    private $_title;
    private $_chapter;
    private $_db;
    private $_responses;

    public function __construct($db) {
        $this->setDb($db);
    }

    public function setDb($db) {
        return $this->_db = $db;
    }

    public function setChapter($text) {
        return $this->_chapter = $text;
    }

    public function setTitle ($text) {
        return $this->_title = $text;
    }

    public function addChapter($title, $chapter) {
        $this->setTitle($title);
        $this->setChapter($chapter);
    }

    //Ajoute chapitre dans la base de donnees
    public function addChapterDb() {
        $req = $this->_db->prepare('INSERT INTO chapters(title, content) VALUES (:title, :chapter)');
        $req->bindValue(':title', $this->_title);
        $req->bindValue(':chapter', $this->_chapter);
        $req->execute();
    }

    //Connexion a la base de donnees pour affichage
    private function searchData() {
        $resp = $this->_db->prepare('SELECT * FROM chapters');
        $resp->execute();
        $this->_responses = $resp->fetchAll();
        return $this->_responses;
    }

    //Affiche les chapitres
    public function displayChapters() {
        $this->searchData();
        foreach ($this->_responses as $response) {
            if ($response['id']) {
                echo '<div class="chapter">';
                echo '<h2><a class="title_chapter" href="chapter_' . $response['id'] . '">' . $response['title'] . '</a></h2>';
                echo '<p class="content_chapter">' . substr($response['content'], 0, 400) . '</p>';
                echo '<a class="after_chapter" href="chapter_' . $response['id'] . '">Lire la suite...</a>';
                echo '</div>';
            }   
        }
    }

    //Affiche les 3 derniers chapitres paru
    public function displayChaptersLast() {
        $resp = $this->_db->prepare('SELECT * FROM chapters ORDER BY id DESC LIMIT 0,3');
        $resp->execute();
        $responses = $resp->fetchAll();
        foreach ($responses as $response) {
            if ($response['id']) {
                echo '<div class="chapter">';
                $date = explode(' ', $response['published']);
                $dateFr = explode('-', $date[0]);
                echo '<h2><a class="title_chapter" href="chapter_' . $response['id'] . '">' . $response['title'] . '</a></h2><p>' . $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1'] . '</p>';
                echo '<p class="content_chapter">' . substr($response['content'], 0, 200) . '</p>';
                echo '<a class="after_chapter" href="chapter_' . $response['id'] . '">Lire la suite...</a>';
                echo '</div>';
            }   
        }
    }

    //Recherche et affiche un chapitre
    public function recoverChapter($title) {
        $ContentArray = explode('_', $title['url']);
        $this->searchData();
        foreach ($this->_responses as $response) {
            if ($ContentArray[1] === $response['id']) { 
                echo '<div class="chapter">';
                $date = explode(' ', $response['published']);
                $dateFr = explode('-', $date[0]);
                echo '<h2>' . $response['title'] . '</a></h2><p>' . $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1'] . '</p>';
                echo '<p class="content_chapter">' . $response['content'] . '</p>';
                echo '</div>'; 
            }
        }
    }
}