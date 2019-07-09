<?php
require_once 'Data.php';
require_once 'Chapters.php';
require_once 'CustomException.php';

class Router extends Data{ 
    
    //Recupere url
    public function setUrl($url) {
        $this->route($url);
    }

    //Redection vers la page souhaitee
    private function route($page){  
        //Redirection vers les controllers
        if (strpos($page, 'Controller') && is_file('../Controller/' . $page . '.php')) {
            require_once '../Controller/' . $page . '.php';
        //Redirection vers les templates
        } elseif (is_file('../Template/' . $page . '.php')) {            
            if ($page === 'chapitre' || $page === 'administrateur') {
                if (array_key_exists('id', $_GET)) {
                    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                    $chapter = new Chapters($this->_db);
                    if ($chapter->returnId($id) === true) {
                        require_once '../Template/' . $page . '.php';
                    } else {
                        throw new CustomException("Page introuvable", 404); 
                    }
                } elseif ($page === 'administrateur') {
                    require_once '../Template/' . $page . '.php';
                }
            } else {
                require_once '../Template/' . $page . '.php';
            }
        } else {
            throw new CustomException("Page introuvable", 404);  
        }
    }
}