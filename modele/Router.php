<?php

require_once 'Data.php';
require_once 'Chapters.php';
require_once 'CustomException.php';

class Router extends Data{ 
    
    //Recupere url
    public function setUrl($url) {
        return $this->route($url);
    }

    //Nettoyeur de tableau
    public function cleanArray($array) {

        return isset($array) ? filter_var_array($array, FILTER_SANITIZE_STRING) : null;
    }

    //Retourne le chemin de la page souhaitee
    private function route($page) {
  
        //Redirection vers les controllers
        if (strpos($page, 'Controller') && is_file('../controller/' . $page . '.php') && (!empty($_POST) || $page === "DeconnexionController")) {
            return '../controller/' . $page . '.php';
        //Redirection vers les templates
        } elseif (is_file('../View/' . $page . '.php')) {    
            if ($page === 'chapitre' || $page === 'administrateur') {
                if (array_key_exists('id', $_GET)) {
                    $getClean = $this->cleanArray($_GET);
                    $chapter = new Chapters($this->_db);
                    if ($chapter->checkId($getClean['id']) === true) {
                        return '../View/' . $page . '.php';
                    } else {
                        throw new CustomException("Chapitre introuvable", 404); 
                    }
                } elseif ($page === 'administrateur') {
                    return '../View/' . $page . '.php';
                }
            } else {
                return '../View/' . $page . '.php';
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

        return 2;
    }
}