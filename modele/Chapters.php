<?php

namespace modele;

use modele\DataRecover;

class Chapters extends DataRecover
{
    public function __construct($db)
    {
        return $this->_db = $db;
    }

    //Affiche les chapitres
    public function displayChapters()
    {
        $this->callDisplay('chapters');
        foreach ($this->_responses as $response)
        {
            if ($response['id'])
            {
                echo '<div class="chapter">';
                echo '<h3><a class="title_chapter" href="chapitre?id=' . $response['id'] . '">' . $response['title'] . '</a></h3>';
                echo '<p class="content_text_chapter">' . substr($response['content'], 0, 400) . '...</p>';
                echo '<a class="after_chapter" href="chapitre?id=' . $response['id'] . '">Lire la suite...</a>';
                echo '</div>';
            }   
        }
    }

    //Affiche les trois derniers chapitres parus
    public function displayChaptersLast()
    {
        $resp = $this->_db->prepare('SELECT * FROM chapters ORDER BY id DESC LIMIT 0,3');
        $resp->execute();
        $responses = $resp->fetchAll();
        foreach ($responses as $response)
        {
            if ($response['id'])
            {
                echo '<div class="chapter">';
                $date = explode(' ', $response['published']);
                $dateFr = explode('-', $date[0]);
                echo '<h3><a class="title_chapter" href="chapitre?id=' . $response['id'] . '">' . $response['title'] . '</a></h3><p>' . $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1'] . '</p>';
                echo '<p class="content_text_chapter">' . substr($response['content'], 0, 200) . '...</p>';
                echo '<a class="after_chapter" href="chapitre?id=' . $response['id'] . '">Lire la suite...</a>';
                echo '</div>';
            }   
        }
    }

    //Recherche et affiche un chapitre
    public function recoverChapter($id)
    {
        $this->callDisplay('chapters');
        if ($this->checkId($id) === true)
        {
            foreach ($this->_responses as $response)
            {
                if ($id === $response['id'])
                { 
                    echo '<div class="chapter">';
                    $date = explode(' ', $response['published']);
                    $dateFr = explode('-', $date[0]);
                    echo '<h3>' . $response['title'] . '</h3><p>' . $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date['1'] . '</p>';
                    echo '<p class="content_text_chapter">' . $response['content'] . '</p>';
                    echo '</div>'; 
                }  
            }
        } 
    }

    //Retourne le titre du chapitre
    public function displayTitle($id)
    {
        $this->callDisplay('chapters');
        foreach ($this->_responses as $response)
        {
            if ($id === $response['id'])
            {
                return $response['title'];
            }
        }
    }

    //Retourne le contenu du chapitre
    public function displayContent($id)
    {
        $this->callDisplay('chapters');
        foreach ($this->_responses as $response)
        {
            if ($id === $response['id'])
            {
                return $response['content'];
            }
        }
    }

    //Affiche les liens des chapitres pour les modifier
    public function linkDisplayChapterAdmin()
    {
        $this->callDisplay('chapters');
        echo '<p><a href="administrateur">Nouveau chapitre</a></p>';
        foreach ($this->_responses as $response)
        {
            if ($response['id'])
            {
                echo '<p><a href="administrateur?id=' . $response['id'] . '">' . $response['title'] . '</a></p>';
            }
        }
    }

    public function linkDisplayChapter()
    {
        $this->callDisplay('chapters');
        foreach ($this->_responses as $response)
        {
            if ($response['id'])
            {
                echo '<p>- <a href="chapitre?id=' . $response['id'] . '">' . $response['title'] . '</a></p>';
            }
        }
    }

    //Retourne 'true' si id du chapitre existe
    public function checkId($id)
    {
        $this->callDisplay('chapters');
        foreach ($this->_responses as $response)
        {
            if ($id === $response['id'])
            {
                return true;
            } 
        }
        return false;
    }
}