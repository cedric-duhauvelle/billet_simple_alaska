<?php

namespace Model;

use Manager\ChapterManager;
use Model\CustomException;
use Controller\Controller;
use Controller\PageController;

class Router
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
        return $this->_db;
    }

    public function setDb($db)
    {
        $this->_db = $db;
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
        if (strpos($page, 'Controller') && is_file('../Controller/' . $page . '.php') && (!empty($_POST) || $page === "DeconnexionController")) {
            new Controller($page, $this->_db);
        //Redirection vers les templates
        } else {
            new PageController($this->_db, $page);
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