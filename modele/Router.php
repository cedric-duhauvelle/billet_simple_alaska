<?php

require_once 'Data.php';
require_once 'Chapters.php';
require_once 'CustomException.php';

class Router extends Data{ 
    
    //Recupere url
    public function setUrl($url) {
        $this->route($url);
    }

    //Nettoie $_POST
    public function cleanPost() {
        if (isset($_POST)) {
            $postClean = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            return $postClean;
        }

        return $postClean =  null;
    }

    //Nettoie $_GET
    public function cleanGet() {
        if (isset($_GET)) {
            $getClean = filter_var_array($_GET, FILTER_SANITIZE_STRING);
            return $getClean;
        }

        return $getClean =  null;
    }

    //Redection vers la page souhaitee
    private function route($page) {  
        //Redirection vers les controllers
        if (strpos($page, 'Controller') && is_file('../controller/' . $page . '.php') && !empty($_POST)) {
            require_once '../controller/' . $page . '.php';
        //Redirection vers les templates
        } elseif (is_file('../template/' . $page . '.php')) {    
            if ($page === 'chapitre' || $page === 'administrateur') {
                if (array_key_exists('id', $_GET)) {
                    $getClean = $this->cleanGet();
                    $chapter = new Chapters($this->_db);
                    if ($chapter->checkId($getClean['id']) === true) {
                        require_once '../template/' . $page . '.php';
                    } else {
                        throw new CustomException("Chapitre introuvable", 404); 
                    }
                } elseif ($page === 'administrateur') {
                    require_once '../template/' . $page . '.php';
                }
            } else {
                require_once '../template/' . $page . '.php';
            }
        } else {
            throw new CustomException("Page introuvable", 404);  
        }
    }

    //Verifie si le projet est en local ou en ligne
    public function checkServer() {
        if (strpos($_SERVER['HTTP_REFERER'], 'localhost')) {
            return 8;
        }

        return 3;
    }
}