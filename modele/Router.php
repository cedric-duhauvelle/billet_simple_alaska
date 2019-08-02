<?php

namespace modele;

use modele\Data;
use modele\Chapters;
use modele\CustomException;
use controller\Controller;
use controller\PageController;

class Router extends Data
{ 
    public function __construct($db)
    {
        return $this->_db = $db;
    }

    //Nettoyeur de tableau
    public function cleanArray($array)
    {

        return isset($array) ? filter_var_array($array, FILTER_SANITIZE_STRING) : null;
    }

    //Retourne le chemin de la page souhaitee
    public function route($page)
    {
        //Redirection vers les controllers
        if (strpos($page, 'Controller') && is_file('../controller/' . $page . '.php') && (!empty($_POST) || $page === "DeconnexionController")) {
            new Controller($page, $this->_db);
        //Redirection vers les templates
        } elseif (is_file('../View/' . $page . '.php')) {
            if ($page === 'chapitre' || $page === 'administrateur') {
                if (array_key_exists('id', $_GET)) {
                    $getClean = $this->cleanArray($_GET);
                    $chapter = new Chapters($this->_db);
                    if (!$chapter->checkId($getClean['id'])) {
                        throw new CustomException("Chapitre introuvable", 404); 
                    }
                }
            }
            new PageController($this->_db, $page);
        } else {
            throw new CustomException("Page introuvable", 404);  
        }
    }

    //Verifie si le projet est en local ou en ligne
    public function checkServer()
    {
        if (strpos($_SERVER['HTTP_REFERER'], 'localhost')) {
            return 8;
        }

        return 3;
    }
}